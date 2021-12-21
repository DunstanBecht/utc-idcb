<?php
/**
 * This file defines the class controllers\Account.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\account
 */

namespace controllers;

/**
 * This class manages the interactions with the content of the account tab.
 */
class Account extends Controller {

  /**
   * This method corresponds to the home action.
   * @return void
   */
  public function home() {
    require 'views/pages/account/home.php';
  }

  /**
   * This method corresponds to the login action.
   * @return void
   */
  public function login() {
    if (isset($_SESSION["user"])) { unset($_SESSION["user"]); }
    $mail = (isset($_SESSION["mail"])) ? $_SESSION["mail"] : "";
    if (isset($_SESSION["password"]) && strlen($mail)>0) {
      try {
        $user_manager = new \models\UserManager(new \PDO(DB_DSN, DB_USR, DB_PWD));
        $user = $user_manager->get(array('mail'=>$mail));
        if (!password_verify($_SESSION["password"], $user->hash)) {
          throw new \Exception(_("incorrect_password"));
        };
        $_SESSION['user'] = $mail;
        unset($_SESSION["password"]);
        unset($_SESSION["mail"]);
        $this->redirect(PATH_LANGUAGE . "/" . CONTROLLER);
      } catch(\Exception $e) {
        unset($_SESSION["password"]);
        $errorMessage = $e->getMessage();
      }
    }
    require 'views/pages/account/login.php';
  }

  /**
   * This method corresponds to the passwordreset action.
   * @return void
   */
  public function passwordreset() {
    $mail = (isset($_SESSION["try_mail"])) ? $_SESSION["try_mail"] : "";
    require 'views/pages/' . CONTROLLER . '/mail.php';
  }

  /**
   * This method corresponds to the creation action.
   * @return void
   */
  private function creation($mail) {
    $pending_creation = new \models\PendingCreation(array('mail'=>$mail));
    $pending_creation_manager = new \models\PendingCreationManager(new \PDO(DB_DSN, DB_USR, DB_PWD));
    $pending_creation_manager->add($pending_creation);

    $link = 'https://' . $_SERVER['HTTP_HOST'] . "/account/register/" . $pending_creation->id . '/' . $pending_creation->token;
    $message = _('message_confirm') . "<br><br>\n" . $link;
    $mail = new Mail($mail, _('subject_confirm'), $message);
    $mail->send();
  }

  /**
   * This method corresponds to the register action.
   * @return void
   */
  function register() {
    if (count(PARAMETER)==0) {
      $mail = (isset($_SESSION["try_mail"])) ? $_SESSION["try_mail"] : "";
      if (isset($_SESSION["try_mail"])) {
        unset($_SESSION["try_mail"]);
        $this->creation($mail);
        $message = "un mail a été envoyé confirmez";
      }
      require 'views/pages/' . CONTROLLER . '/mail.php';
    } else {
      $db = new \PDO(DB_DSN, DB_USR, DB_PWD);
      $pending_creation_manager = new \models\PendingCreationManager($db);
      $pending_creation = $pending_creation_manager->get(PARAMETER[0]);
      if ($pending_creation->token==PARAMETER[1]) {
        $mail = $pending_creation->mail;
        if (isset($_SESSION["password"])) {
          $user_manager = new \models\UserManager($db);
          $data = array("mail"=>$mail, "hash"=>password_hash($_SESSION["password"], PASSWORD_DEFAULT));
          $user_manager->add(new \models\User($data));
          $pending_creation_manager->delete($pending_creation);
          $_SESSION["user"] = $mail;
          unset($_SESSION["password"]);
          unset($_SESSION["mail"]);
          $this->redirect(PATH_LANGUAGE . "/" . CONTROLLER);
        }
      } else {
        throw new \Exception("Lien de validation incorect.");
      }
      require 'views/pages/' . CONTROLLER . '/password.php';
    }
  }

  /**
   * This method corresponds to the valid action.
   * @return void
   */
  function valid() {

  }

  /**
   * Instantiate the controller.
   * @return void
   */
  public function __construct() {
    if (!isset($_SESSION["user"]) and !in_array(ACTION, array('login', 'register', 'passwordreset'))) {
      $this->redirect(PATH_LANGUAGE . "/" . CONTROLLER . "/login");
    }
  }

}
