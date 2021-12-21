<?php namespace models;

class PendingCreation extends Record {

  static $manager = PendingCreationManager::class;

  static $primary_key = array(
    'id'=>array('integer', "INT NOT NULL AUTO_INCREMENT,\nPRIMARY KEY (id)"),
  );

  static $foreign_key = array(
  );

  static $attributes = array(
    'mail'=>array('string', "VARCHAR(256)"),
    'token'=>array('string', 'VARCHAR(256)'),
  );

  public function __construct($data) {
    $this->token = md5(microtime(TRUE)*100000);
    parent::__construct($data);
  }

}
