<?php
/**
 * This file defines the class controllers\Step.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\guide
 */

namespace controllers;

/**
 * This class represents a step in the guide.
 */
abstract class Step {

  /**
   * All declared steps.
   * @var array
   */
  private static $pool = array();

  /**
   * The step requires interaction with the user.
   * @var boolean
   */
  private $visible;

  /**
   * Identifier of the step.
   * @var string
   */
  private $id;

  /**
   * Get an attribute value.
   * @param string $name Name of the attribute.
   * @param mixed
   */
  public function __get($name) {
    return $this->$name;
  }

  /**
   * This method allows to know if a step is defined.
   * @param string $id Identifier of the step.
   * @return boolean
   */
  public static function exists($id) {
    return array_key_exists($id, Step::$pool);
  }

  /**
   * Get a step from its identifier.
   * @param string $id Identifier of the step.
   * @return self
   */
  public static function get($id) {
    if (static::exists($id)) {
      return Step::$pool[$id];
    } else {
      throw new \Exception("Step '" . $id . "' not defined.");
    }
  }

  /**
   * Instantiate a step.
   * @param string $id Identifier of the step.
   * @return self
   */
  public function __construct($id) {
    $this->id = $id;
    Step::$pool[$id] = $this;
  }

}
