<?php
/**
 * This file defines the class controllers\Guide.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\guide
 */

namespace controllers;

/**
 * This class manages the interactions with the content of the information tab.
 */
class Guide extends Controller {

  /**
   * Handle a step of kind radio.
   * @param Radio $step Radio step.
   * @return void
   */
  private function radio($step) {
    if (isset($_SESSION[$step->id])) {
      $next_step = $step->rules[$_SESSION[$step->id]];
      array_push($_SESSION["path"], $next_step);
      $_SESSION["answers"][$step->id] = $_SESSION[$step->id];
      unset($_SESSION[$step->id]);
      $this->home();
    } else {
      require 'views/pages/guide/home.php';
    }
  }

  /**
   * This method corresponds to the home action.
   * @return void
   */
  public function home() {
    $step = Step::get(end($_SESSION["path"]));
    $array = explode('\\', get_class($step));
    $method = strtolower(end($array));
    $this->$method($step);
  }

  /**
   * This method allows a return to the previous step.
   * @return void
   */
  public function back() {
    if (count($_SESSION['path'])>1) {
      array_pop($_SESSION['path']);
    }
    $this->redirect(PATH_LANGUAGE . '/guide');
  }

  /**
   * Instantiate the controller.
   * @return self
   */
  public function __construct() {
    require 'controllers/tree.php';
    if (!isset($_SESSION["path"])) {
      $_SESSION["path"] = array('is_a_dm');
      $_SESSION["answers"] = array();
    }

  }

}
