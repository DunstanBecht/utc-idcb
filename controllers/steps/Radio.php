<?php
/**
 * This file defines the class controllers\steps\Radio.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\guide
 */

namespace controllers\steps;

/**
 * This class represents a form with radio type entries.
 */
class Radio extends Step {

  /**
   * Next step according to the answer.
   * @var array
   */
  protected $rules;

  /**
   * Instantiate the class.
   * @param string $id Identifier of the step.
   * @param array $rules Next step according to the answer.
   * @return self
   */
  public function __construct($id, $rules) {
    parent::__construct($id);
    $this->visible = True;
    $this->rules = $rules;
  }

}
