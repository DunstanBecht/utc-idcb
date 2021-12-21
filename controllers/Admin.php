<?php
/**
 * This file defines the class controllers\Admin.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\admin
 */

namespace controllers;

/**
 * This class manages the interactions with the content of the admin tab.
 */
class Admin extends Controller {

  /**
   * Reset the database.
   * @return string Command executed.
   */
  private function resetDatabase() {
    $db = new \PDO(DB_DSN, DB_USR, DB_PWD);
    $user_manager = new \models\UserManager($db);
    $pending_creation_manager = new \models\PendingCreationManager($db);
    $sql = $pending_creation_manager->delete_table();
    $sql.= $user_manager->delete_table();
    $sql.= $user_manager->create_table();
    $sql.= $pending_creation_manager->create_table();
    return nl2br($sql);
  }

  /**
   * Custom test function.
   * @return mixed
   */
  private function test() {
    $db = new \PDO(DB_DSN, DB_USR, DB_PWD);
    $user = new \models\User(array("mail"=>"bob1", "name"=>"bob2", "hash"=>"bob3"));
    $user_manager = new \models\UserManager($db);
    $user_manager->add($user);
    //$user_manager->get('1');
    //$user_manager->delete($user);
    return $user->mail;
  }

  /**
   * This method corresponds to the home action.
   * @return void
   */
  public function home() {
    $functions = array('resetDatabase', 'test');
    if (isset($_SESSION['function']) && in_array($_SESSION['function'], $functions)) {
      $executed = $_SESSION['function'];
      unset($_SESSION['function']);
      $result = $this->$executed();
    }
    // Tables:
    $db = new \PDO(DB_DSN, DB_USR, DB_PWD);
    $q = $db->prepare("SHOW TABLES");
    $q->execute();
    $data = $q->fetchAll(\PDO::FETCH_ASSOC);
    $tables = array();
    foreach ($data as $array) {
      array_push($tables, $array[array_keys($array)[0]]);
    }
    // View:
    require 'views/pages/admin/' . ACTION . '.php';
  }

  /**
   * This method corresponds to the table action.
   * @return void
   */
  public function table() {
    if (count(PARAMETER)>0) {
      $dbh = new \PDO(DB_DSN, DB_USR, DB_PWD);
      $sql = 'SELECT * FROM ' . PARAMETER[0];
      $sth = $dbh->prepare($sql);
      $sth->execute();
      $data = $sth->fetchAll(\PDO::FETCH_ASSOC);
    } else {
      $data = array();
    }
    require 'views/pages/admin/table.php';
  }

  /**
   * This method corresponds to the login action.
   * @return void
   */
  public function login() {
    if (isset($_SESSION["admin"])) { unset($_SESSION["admin"]); }
    $admin_username = (isset($_SESSION["admin_username"])) ? $_SESSION["admin_username"] : "";
    if (isset($_SESSION["admin_password"]) && strlen($admin_username)>0) {
      try {
        if (!array_key_exists($admin_username, ADMINS)) {
          throw new \Exception(_('nonexistent_admin'));
        }
        if (!password_verify($_SESSION["admin_password"], ADMINS[$admin_username])) {
          throw new \Exception(_('incorrect_password'));
        };
        $_SESSION['admin'] = $admin_username;
        unset($_SESSION["admin_password"]);
        unset($_SESSION["admin_username"]);
        $this->redirect(PATH_LANGUAGE . "/" . CONTROLLER);
      } catch(\Exception $e) {
        unset($_SESSION["admin_password"]);
        $errorMessage = $e->getMessage();
      }
    }
    require 'views/pages/admin/' . ACTION . '.php';
  }

  /**
   * Instantiate the controller.
   * @return self
   */
  public function __construct() {
    if (!isset($_SESSION["admin"]) and ACTION!='login') {
      $this->redirect(PATH_LANGUAGE . "/admin/login");
    }
  }

}
