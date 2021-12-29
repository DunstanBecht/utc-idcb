<?php
/**
 * This file defines the class views\Toggle.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tools
 */

namespace views;

/**
 * This class facilitates the creation of content that can be extended.
 */
class Toggle {

  /**
   * Identifier of the last extendable content created.
   * @var int
   */
  private static $counter = 0;

  /**
   * Identifier of the extendable content.
   * @var string
   */
  private $id;

  /**
   * Get the number of extendable contents created.
   * @return int
   */
  public static function getCount() {
    return static::$counter;
  }

  /**
   * Instantiate an extendable content.
   * @return self
   */
  public function __construct() {
    static::$counter += 1;
    $this->id = 'toggle' . static::$counter;
  }

  /**
   * Return the HTML code corresponding to the triggering element.
   * @param string $message Content placed in the HTML tag.
   * @param string $tag HTML tag used.
   * @param string $style CSS style of the tag.
   * @return string
   */
  public function trigger($message, $tag="span", $style="cursor: pointer;") {
    ob_start(); ?>
    <<?= $tag ?> onclick="toggle('<?= $this->id ?>');"
                 style="<?= $style ?>">
      <?= $message ?>
    </<?= $tag ?>>
    <?php return ob_get_clean();
  }

  /**
   * Return the HTML code corresponding to the content to display or hide.
   * @param string $message Content placed in the HTML tag.
   * @param string $tag HTML tag used.
   * @param string $style CSS style of the tag.
   * @return string
   */
  public function content($message, $tag="div", $style="display: none;") {
    ob_start(); ?>
    <<?= $tag ?> id="<?= $this->id ?>"
                 style="<?= $style ?>">
      <?= $message ?>
    </<?= $tag ?>>
    <?php return ob_get_clean();
  }

}
