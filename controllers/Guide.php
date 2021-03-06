<?php
/**
 * This file defines the class controllers\Guide.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\guide
 */

namespace controllers;

/**
 * This class manages the interactions with the content of the guide tab.
 */
class Guide extends Controller {

  /**
   * Handle a step of kind define.
   * @param Define $step Step of kind define.
   * @return void
   */
  private function define($step) {
    if (isset($_SESSION['data'][$step->name])) {
      throw new \Exception("Variable $step->name already defined.");
    }
    $_SESSION['data'][$step->name] = $step->value;
    $this->next($step->next);
    $this->home();
  }

  /**
   * Handle a step of kind match.
   * @param Match $step Step of kind match.
   * @return void
   */
  private function match($step) {
    $value = $_SESSION['data'][$step->name];
    $next = $step->rules[$value];
    $this->next($next);
    $this->home();
  }

  /**
   * Handle a step of kind radio.
   * @param Radio $step Step of kind radio.
   * @return void
   */
  private function radio($step) {
    if (isset($_SESSION[$step->id])) {
      $value = $_SESSION[$step->id];
      unset($_SESSION[$step->id]);
      $next = $step->rules[$value];
      $this->next($next);
      $_SESSION["answers"][$step->id] = $value;
      $this->home();
    } else {
      require 'views/pages/guide/home.php';
    }
  }

  /**
   * Handle a step of kind leaf.
   * @param Leaf $step Step of kind leaf.
   * @return void
   */
  private function leaf($step) {
    require $step->view;
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
   * This method allows a return to the previous visible step.
   * @return void
   */
  public function back() {
    if (count($_SESSION['path'])>1) {
      array_pop($_SESSION['path']);
    }
    $previous = steps\Step::get(end($_SESSION['path']));
    if ($previous->visible) {
      $this->redirect(PATH_LANGUAGE . '/guide');
    } else {
      if (get_class($previous)=="controllers\steps\Define") {
        unset($_SESSION['data'][$previous->name]);
      }
      $this->back();
    }
  }

  /**
   * Instantiate the controller.
   * @return self
   */
  public function __construct() {
    require 'controllers/guide_steps.php';
    if (!isset($_SESSION["path"])) {
      $_SESSION["path"] = array('medical_device');
      $_SESSION["answers"] = array();
      $_SESSION["data"] = array();
    }

  }

}
