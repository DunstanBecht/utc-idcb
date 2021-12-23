<?php
/**
 * This file defines the representation of information in account tab.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\account
 */

ob_start(); ?>
<main>
  <article>
    <h1><?= _('action_' . CONTROLLER . '_' . ACTION) ?></h1>
    <p><?= $mail ?></p>
    <form id="Form1" method="post">
      <input autocomplete="off"
             type="password"
             name="password"
             placeholder=<?= _('password') ?>
             value="">
      <br>
    </form>
  </article>
  <?php if (isset($essage)) { ?>
    <br>
    <article>
      <p><?= $message ?></p>
    </article>
  <?php } ?>
</main>
<?php $content = ob_get_clean();

require 'views/template.php';
