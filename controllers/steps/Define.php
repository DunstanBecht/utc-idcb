<?php
/**
 * This file defines the class controllers\Define.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\guide
 */

namespace controllers\steps;

/**
 * This class represents a step that sets a value to a variable.
 */
class Define extends Step {

  /**
   * Name of the variable.
   * @var mixed
   */
  public $name;

  /**
   * Value of the declared variable.
   * @var mixed
   */
  public $value;

  /**
   * Identifier of the next step.
   * @var string
   */
  public $next;

  /**
   * Instantiate the class.
   * @param string $id Identifier of the step.
   * @param string $value Value of the variable.
   * @return self
   */
  public function __construct($id, $name, $value, $next) {
    parent::__construct($id);
    $this->name = $name;
    $this->value = $value;
    $this->next = $next;
    $this->visible = False;
  }

}
