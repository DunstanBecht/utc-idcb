<?php
/**
 * This file defines the class controllers\Home.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\home
 */

namespace controllers;

/**
 * This class manages the interactions with the content of the site main page.
 */
class Home extends Controller {

  /**
   * This method corresponds to the home action.
   * @return void
   */
  public function home() {
    require 'views/pages/home.php';
  }

}
