<?php
/**
 * This file defines the class controllers\Match.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\guide
 */

namespace controllers\steps;

/**
 * This class represents a step of type match.
 */
class Match extends Step {

  /**
   * Name of the variable to match.
   * @var string
   */
  protected $name;

  /**
   * Next step according to the variable value.
   * @var array
   */
  protected $rules;

  /**
   * Instantiate the class.
   * @param string $id Identifier of the step.
   * @param string $name Name of the variable to match.
   * @param array $rules Next step according to the answer.
   * @return self
   */
  public function __construct($id, $name, $rules) {
    parent::__construct($id);
    $this->name = $name;
    $this->rules = $rules;
    $this->visible = False;
  }

}
