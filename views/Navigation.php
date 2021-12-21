<?php
/**
 * This file defines the class views\Navigation.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tools
 */

namespace views;

/**
 * This class facilitate the creation of navigation bars.
 */
class Navigation {

  /**
   * Create a navigation bar for the actions of the controller.
   * @return void
   */
  public static function actions() {
    ?>
    <nav class="article">
      <?php foreach (get_class_methods(ROUTES[CONTROLLER]) as $action) { if ($action != 'home') { ?>
        <a class="<?= (ACTION==$action) ? 'active' : 'action';?>"
           href="<?= PATH_LANGUAGE ?>/<?= CONTROLLER ?>/<?= $action ?>">
          &nbsp;<?= _('action_' . CONTROLLER . '_' . $action) ?>&nbsp;
        </a>
      <?php } } ?>
    </nav>
    <?php
  }

}
