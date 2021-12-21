<?php
/**
 * This file defines the class controllers\Cron.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\cron
 */

namespace controllers;

/**
 * This class manages the interactions with the content of the cron tab.
 */
class Cron extends Controller {

  /**
   * This method corresponds to the home action.
   * @return void
   */
  public function home() {
    echo print_r(PARAMETER, true);
    echo 'Hey!';
  }

  /**
   * Instantiate the controller.
   * @return self
   */
  public function __construct() {
    if (PARAMETER[0]!='AAA') {
      http_response_code(403);
      throw new \Exception(_('error_403'));
      require 'views/pages/error.php';
    }
  }

}
