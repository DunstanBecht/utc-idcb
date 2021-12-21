<?php
/**
 * This file defines the class controllers\Controller.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tools
 */

namespace controllers;

/**
 * This class is the mother class of controllers.
 */
abstract class Controller {

  /**
   * This method corresponds to the home action.
   * @return void
   */
  abstract public function home();

  /**
   * This method allows to redirect to another path.
   * @param string $path Redirection path.
   * @return void
   */
  protected function redirect($path) {
    header($_SERVER["SERVER_PROTOCOL"] . ' 303 See Other');
    header('Location: ' . $path);
    die();
  }

}
