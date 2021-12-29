<?php
/**
 * This file defines the representation of information in guide tab.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\guide
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
  <p>
    <input type="radio"
           name="<?= $question_id ?>"
           id="<?= $answer_id ?>"
           value="<?= $answer_value ?>"
           <?= (isset($_SESSION["answers"][$question_id]) and $_SESSION["answers"][$question_id]==$answer_value) ? "checked" : "" ?>
    >
    <label class="action_text" for="<?= $answer_id ?>"><?= _('answer_' . $answer_value) ?></label>
    <?php
      $extra_key = 'answer_' . $answer_value . "_information";
      if (_($extra_key) != $extra_key) {
        $toggle = new \views\Toggle();
        echo $toggle->trigger('[?]');
      }
    ?>
  </p>
  <p>
    <?= (isset($toggle) ? $toggle->content('<br>' . _($extra_key) . '<br>', 'span') : '')?>
    <br>
  </p>
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
  <input class="action" type="submit" value="<?= _('form_submit')?>">
  </p>
  </form>
  <?php return ob_get_clean();
}

/**
 * This function display a step according to its nature.
 * @param Step $step
 * @return string
 */
function handle($step) {
  if (get_class($step)=='controllers\steps\Radio') {
    return radio($step->id, array_keys($step->rules));
  }
}

ob_start(); ?>
<main>
  <?php if (count($_SESSION["path"])>1) { ?>
    <article>
      <p><a class='action' href="<?= PATH_LANGUAGE ?>/guide/back"><?= _('form_back') ?></a></p>
    </article><br>
  <?php } ?>
  <article>
    <p><?= _('text_' . $step->id) ?><br><br></p>
    <?= handle($step); ?>
  </article>
</main>
<?php $content = ob_get_clean();

require 'views/template.php';
