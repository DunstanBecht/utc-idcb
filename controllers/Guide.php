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
   * Handle a step of kind declare.
   * @param Declare $step Declare step.
   * @return void
   */
  private function define($step) {
    $_SESSION['data'][$step->name] = $step->value;
    $this->next($step->next);
    unset($_SESSION[$step->id]);
    $this->home();
  }

  /**
   * Handle a step of kind match.
   * @param Radio $step Radio step.
   * @return void
   */
  private function match($step) {
    $next_step = $step->rules[$_SESSION['data'][$step->name]];
    $this->next($next_step);
    $this->home();
  }

  /**
   * Handle a step of kind radio.
   * @param Radio $step Radio step.
   * @return void
   */
  private function radio($step) {
    if (isset($_SESSION[$step->id])) {
      $next_step = $step->rules[$_SESSION[$step->id]];
      $this->next($next_step);
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
    $step = steps\Step::get(end($_SESSION["path"]));
    $array = explode('\\', get_class($step));
    $method = strtolower(end($array));
    $this->$method($step);
  }

  /**
   * This method defines the next step.
   * @param string $id Identifier of the next step.
   * @return void
   */
  public function next($id) {
    array_push($_SESSION["path"], $id);
  }

  /**
   * This method allows a return to the previous step.
   * @return void
   */
  public function back() {
    if (count($_SESSION['path'])>1) {
      array_pop($_SESSION['path']);
    }
    if (!steps\Step::get(end($_SESSION['path']))->visible) {
      $this->back();
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
      $_SESSION["data"] = array();
    }

  }

}
