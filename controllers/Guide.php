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
   * This method corresponds to the home action.
   * @return void
   */
  public function home() {
    require 'views/pages/guide/home.php';
  }

}
