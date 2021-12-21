<?php
/**
 * This file defines the class models\Record.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tools
 */

namespace models;

/**
 * This class represents a row in the database.
 * @see RecordManager
 */
abstract class Record {

  /**
   * Attributes of the record.
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
    if (array_key_exists($name, static::$primary_key)) {
      if (isset($this->$name)) {
        throw new \Exception("Attribute '" . $name . "' is a primary key and is already defined.");
      }
      $type = static::$primary_key[$name][0];
    } elseif (array_key_exists($name, static::$foreign_key)) {
      $type = static::$foreign_key[$name][0];
    } elseif (array_key_exists($name, static::$attributes)) {
      $type = static::$attributes[$name][0];
    } else {
      throw new \Exception("Records of type " . get_class($this) . " have no attribute '" . $name . "'.");
    }
    if (is_null($value) or gettype($value)==$type) {
      $this->data[$name] = $value;
    } else {
      if ($type=='integer') {
        $this->data[$name] = (int) $value;
      } else {
        throw new \Exception("Attribute '" . $name . "' must be of type " . $type . ". Type '" . gettype($value) . '" was given."');
      }
    }
  }

  /**
   * Get an attribute value.
   * @param string $name Name of the attribute.
   * @param mixed
   */
  public function __get($name) {
    if (array_key_exists($name, $this->data)) {
      return $this->data[$name];
    } else {
      return NULL;
    }
  }

  /**
   * Determine if the attribute is declared and is different than null.
   * @param string $name Name of the attribute.
   * @return boolean
   */
  public function __isset($name) {
    return isset($this->data[$name]);
  }

  /**
   * Unset an attribute.
   * @param string $name Name of the attribute.
   * @return void
   */
  public function __unset($name) {
    unset($this->data[$name]);
  }

  /**
   * Update the record attributes with the data contained in the array.
   * @param array $data Data to be loaded in the record.
   * @return void
   */
  public function hydrate(array $data) {
    foreach ($data as $key => $value) {
      $this->$key = $value;
    }
  }

  /**
   * Create the object with data contained in the array.
   * @param array $data Data to be loaded in the record.
   * @return self
   */
  public function __construct(array $data) {
    $this->hydrate($data);
  }

}
