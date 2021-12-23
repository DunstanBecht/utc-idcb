<?php
/**
 * This file defines the representation of information in admin tab.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\admin
 */

ob_start(); ?>
<main>
  <article>
    <h1><?= _('controller_' . CONTROLLER . '_actions') ?></h1>
    <?php foreach ($functions as $function) { ?>
      <form method="post">
        <input type="hidden" name="function" value="<?= $function ?>">
        <input class='left, action' type="submit" value='<?= $function ?>()'>
      </form>
    <?php } ?>
  </article>
  <?php if (isset($executed)) { ?>
    <br>
    <article>
      <h1><?= $executed ?>()</h1>
      <p><?= $result ?></p>
    </article>
  <?php } ?>
  <br>
  <article>
    <h1><?= _('controller_' . CONTROLLER . '_session_variables') ?></h1>
    <pre><p><?= print_r($_SESSION) ?></p></pre>
  </article>
  <br>
  <article>
    <h1><?= _('controller_' . CONTROLLER . '_tables') ?></h1>
    <p><?= print_r($tables, true) ?></p>
  </article>
</main>
<?php $content = ob_get_clean();

require 'views/template.php';
