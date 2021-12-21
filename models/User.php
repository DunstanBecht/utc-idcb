<?php
/**
 * This file defines the class models\User.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tools
 */

namespace models;

/**
 * This class represents a user.
 * @see UserManager
 */
class User extends Record {

  /**
   * Manager of the records.
   * @var string
   */
  static $manager = UserManager::class;

  /**
   * Minimal set of attributes that uniquely specify a record.
   * @var array
   */
  static $primary_key = array(
    'id'=>array('integer', "INT NOT NULL AUTO_INCREMENT,\nPRIMARY KEY (id)"),
  );

  /**
   * Attributes that provides a link with an other table.
   * @var array
   */
  static $foreign_key = array(
  );

  /**
   * Record attributes that are not primary or foreign keys.
   * @var array
   */
  static $attributes = array(
    'mail'=>array('string', "VARCHAR(256),\nUNIQUE KEY (mail)"),
    'name'=>array('string', 'VARCHAR(256)'),
    'hash'=>array('string', 'VARCHAR(256)'),
  );

}
