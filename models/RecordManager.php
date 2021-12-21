<?php
/**
 * This file defines the class models\RecordManager.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tools
 */

namespace models;

/**
 * This class simplifies the handling of objects of type Record.
 * @see Record
 */
abstract class RecordManager {

  /**
   * Specification of attributes of the record managers.
   * @var array
   */
  static $attributes = array(
    'dbh'=>'object',
    'table'=>'string',
  );

  /**
   * Attributes of the record manager.
   * @var array
   */
  private $data = array();

  /**
   * Set an attribute value.
   * @param string $name Name of the attribute to update.
   * @param mixed $value New value of the attribute.
   * @return void
   */
  public function __set($name, $value) {
    if (array_key_exists($name, static::$attributes)) {
      if (gettype($value)==static::$attributes[$name]) {
        $this->data[$name] = $value;
      } else {
        throw new \Exception("Attribute '" . $name . "' must be of type " . $type . ". Type '" . gettype($value) . '" was given."');
      }
    } else {
      throw new \Exception("Managers of type " . get_class($this) . " have no attribute '" . $name . "'.");
    }
  }

  /**
   * Get an attribute value.
   * @param string $name Name of the attribute.
   * @return mixed
   */
  public function __get($name) {
    if (array_key_exists($name, $this->data)) {
      return $this->data[$name];
    } else {
      return NULL;
    }
  }

  /**
   * Create a record manager.
   * @param PDO $database Interface for accessing a database.
   * @param string $table Table name. (If naming convention not applied.)
   * @return self
   */
  public function __construct(\PDO $database, string $table=NULL) {
    $this->dbh = $database;
    $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    $this->table = (is_null($table)) ? 'table_' . strtolower(explode('\\', static::$record)[1]) : $table;
  }

  /**
   * Create the table corresponding to the manipulated objects.
   * @return string The executed request.
   */
  public function create_table() {
    $columns = array();
    foreach (array(static::$record::$primary_key, static::$record::$foreign_key, static::$record::$attributes) as $attributes) {
      foreach ($attributes as $key => $value) {
        array_push($columns, $key . ' ' . $value[1]);
      }
    }
    $request = 'CREATE TABLE ' . $this->table . "\n(\n";
    $request.= implode(",\n", $columns);
    $request.= "\n);\n";
    $q = $this->dbh->prepare($request)->execute();
    return $request;
  }

  /**
   * Delete the table corresponding to the manipulated objects.
   * @return string The executed request.
   */
  public function delete_table() {
    $request = 'DROP TABLE IF EXISTS ' . $this->table . ";\n";
    $q = $this->dbh->prepare($request)->execute();
    return $request;
  }

  /**
   * Return the array of values of the attributes used as identifiers.
   * @param Record record The record object.
   * @return array
   */
  private function conditions($record) {
    $conditions = array();
    foreach (array_keys(static::$record::$primary_key) as $key) {
      $conditions[$key] = $record->$key;
    }
    return $conditions;
  }

  /**
   * Complete a request by specifying to which records it is addressed.
   * @param string $actions Part of the request before the 'WHERE'.
   * @param array $conditions Values of the attributes used as identifiers.
   * @param string The completed request.
   */
  private function targeted_sth($actions, $conditions) {
    if (gettype($conditions)!='array' and count(static::$record::$primary_key)==1) {
      $conditions = array(array_keys(static::$record::$primary_key)[0]=>$conditions);
    }
    $predicates = array();
    foreach ($conditions as $key => $value) {
      array_push($predicates, $key . ' = :' . $key);
    }
    $sql = $actions . ' WHERE ' . implode(' AND ', $predicates) . ';';
    $sth = $this->dbh->prepare($sql);
    foreach ($conditions as $key => $value) {
      $sth->bindValue(':' . $key, $value);
    }
    return $sth;
  }

  /**
   * Create the record in the database.
   * @param Record $record The record to save in the database.
   * @return void
   */
  public function add($record) {
    if (get_class($record)!=static::$record) {
      throw new \Exception("Manager of type " . get_class($this) . " can not handle records of type '" . get_class($record) ."'.");
    }
    $names1 = array();
    $names2 = array();
    foreach (array(static::$record::$primary_key, static::$record::$foreign_key, static::$record::$attributes) as $attributes) {
      foreach (array_keys($attributes) as $attribute) {
        array_push($names1, $attribute);
        array_push($names2, ':' . $attribute);
      }
    }
    $sql = 'INSERT INTO ' . $this->table . " (";
    $sql.= implode(', ', $names1);
    $sql.= ') VALUES(';
    $sql.= implode(', ', $names2) . ')';
    $q = $this->dbh->prepare($sql);
    foreach ($names1 as $name) {
      $q->bindValue(':' . $name, $record->$name);
    }
    $q->execute();
    if (array_key_exists('id', static::$record::$primary_key)) {
      $record->id = (int) $this->dbh->lastInsertId();
    }
  }

  /**
   * Load the record from database.
   * @param array $conditions Values of the attributes used as identifiers.
   * @return Record
   */
  public function get($conditions) {
    $sth = $this->targeted_sth('SELECT * FROM ' . $this->table, $conditions);
    $sth->execute();
    $data = $sth->fetch(\PDO::FETCH_ASSOC);
    if (!$data) { throw new \Exception(_("nonexistent_" . strtolower(explode('\\', static::$record)[1]))); }
    return new static::$record($data);
  }

  /**
   * Refresh the record in the database from the object's attributes.
   * @param Record $record Object with the new attribute values.
   * @return void
   */
  public function update($record) {
    $names = array();
    $modifications = array();
    foreach (array(static::$record::$foreign_key, static::$record::$attributes) as $attributes) {
      foreach (array_keys($attributes) as $attribute) {
        array_push($modifications, $attribute . ' = :' . $attribute);
        array_push($names, $attribute);
      }
    }
    $actions = 'UPDATE ' . $this->table . ' SET ' . implode(', ', $modifications);
    $conditions = $this->conditions($record);
    $sth = $this->targeted_sth($actions, $conditions);
    foreach ($names as $name) {
      $sth->bindValue(':' . $name, $record->$name);
    }
    $sth->execute();
  }

  /**
   * Delete this object in the database.
   * @param Record $record Object to delete in the database.
   * @return void
   */
  public function delete($record) {
    $conditions = $this->conditions($record);
    $sth = $this->targeted_sth('DELETE FROM ' . $this->table, $conditions);
    $sth->execute();
  }

}
