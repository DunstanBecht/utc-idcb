<?php
/**
 * This file defines the representation of information in scores tab.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\scores
 */

/**
 * This function return a radio box.
 * @param string $question_id
 * @param string $answer_value
 * @return string
 */
function radio_answer($question_id, $answer_value) {
  $answer_id = $question_id . '_' . $answer_value;
  ob_start() ?>
  <input type="radio"
         name="<?= $question_id ?>"
         id="<?= $answer_id ?>"
         value="<?= $answer_value ?>"
         <?= (isset($_SESSION["answers"][$question_id]) and $_SESSION["answers"][$question_id]==$answer_value) ? "checked" : "" ?>
  >
  <label for="<?= $answer_id ?>"><?= _($answer_value) ?></label>
  <br>
  <?php return ob_get_clean();
}

/**
 * This function generates a radio form.
 * @param array $answer_values
 * @return string
 */
function radio($question_id, $answer_values) {
  ob_start() ?>
  <form method="post">
  <p>
  <?php foreach ($answer_values as $answer_value) {
    echo radio_answer($question_id, $answer_value);
  }
  ?>
  </p>
  <input class="send" type="submit" value="<?= _('form_submit')?>">
  </form>
  <?php return ob_get_clean();
}

/**
 * This function display a step according to its nature.
 * @param Step $step
 * @return string
 */
function handle($step) {
  if (get_class($step)=='controllers\Radio') {
    return radio($step->id, array_keys($step->rules));
  }
}

ob_start(); ?>
<main>
  <?php if (count($_SESSION["path"])>1) { ?>
    <article>
      <p><a class='action' href="/guide/back"><?= _('back') ?></a></p>
    </article><br>
  <?php } ?>
  <article>
    <h1><?= _('title_' . $step->id) ?></h1>
    <p><?= _('text_' . $step->id) ?></p><br>
    <p>
    <?= handle($step); ?>
    </p>
  </article>
</main>
<?php $content = ob_get_clean();

require 'views/template.php';
