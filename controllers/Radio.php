<?php
/**
 * This file defines the class controllers\Radio.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\guide
 */

namespace controllers;

/**
 * This class represents a step of type radio in the guide.
 */
class Radio extends Step {

  /**
   * Next step according to the answer.
   * @var array
   */
  public $rules;

  /**
   * Instantiate the class.
   * @param string $id Identifier of the step.
   * @param array $rules Next step according to the answer.
   * @return self
   */
  public function __construct($id, $rules) {
    parent::__construct($id);
    $this->rules = $rules;
  }

}
