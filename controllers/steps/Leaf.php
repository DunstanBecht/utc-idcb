<?php
/**
 * This file defines the class controllers\steps\Leaf.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\guide
 */

namespace controllers\steps;

/**
 * This class represents one of the ends of the the guide.
 */
class Leaf extends Step {

  /**
   * Step view.
   * @var string
   */
  private $view;

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
   * Instantiate the class.
   * @param string $id Identifier of the step.
   * @param array $rules Next step according to the answer.
   * @return self
   */
  public function __construct($id, $view) {
    parent::__construct($id);
    $this->visible = True;
    $this->view = $view;
  }

}
