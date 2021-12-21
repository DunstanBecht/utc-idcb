<?php
/**
 * This file defines the class views\Toggle.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tools
 */

namespace views;

/**
 * This class facilitate the creation of articles that can be extended.
 */
class Toggle {

  /**
   * Identifier of the last created extandable block.
   * @var int
   */
  private static $id = 0;

  /**
   * Get the identifier of the last created extandable block.
   * @return int
   */
  public static function getId() {
    return Toggle::$id;
  }

  /**
   * Create a division that can be extended.
   * @param string $up Displayed content.
   * @param string $down Hidden content.
   * @return void
   */
  public static function message($up, $down) {
    Toggle::$id = Toggle::$id + 1;
    ?>
    <div onclick="toggle('toggle<?= Toggle::$id ?>');"
         style="cursor: pointer; width: 100%;"
         class="message">
      <?= $up ?>
    </div>
    <div id="toggle<?= Toggle::$id ?>" class="transition" style="display: none;">
      <?= $down ?>
    </div>
    <?php
  }

  /**
   * Create an article that can be extended.
   * @param string $up Displayed content.
   * @param string $down Hidden content.
   * @return void
   */
  public static function article($up, $down) {
    ?>
    <article>
      <?= static::message($up, $down) ?>
    </article>
    <?php
  }

}
