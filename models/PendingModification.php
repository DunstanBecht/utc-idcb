<?php namespace models;

class PendingModification extends Record {

  static $manager = PendingModificationManager::class;

  static $primary_key = array(
    'id'=>array('integer', "INT NOT NULL AUTO_INCREMENT,\nPRIMARY KEY (id)"),
  );

  static $foreign_key = array(
  );

  static $attributes = array(
    'field'=>array('string', "VARCHAR(256)"),
    'value'=>array('string', "VARCHAR(256)"),
    'token'=>array('string', 'VARCHAR(256)'),
  );

}
