<?php
/**
 * This file defines the class models\UserManager.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tools
 */

namespace models;

/**
 * This class simplifies the handling of objects of type User.
 * @see User
 */
class UserManager extends RecordManager {

  /**
   * Records managed by this class.
   * @var string
   */
  static $record = User::class;

}
