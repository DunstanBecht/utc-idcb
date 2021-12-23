<?php
/**
 * This file defines the representation of information in admin tab.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\admin
 */

ob_start(); ?>
<main>
  <article>
    <h1><?= _('action_' . CONTROLLER . '_' . ACTION) ?></h1>

    <form id="Form1" method="post">
      <input autocomplete="off"
             maxlength="20"
             type="text"
             name="admin_username"
             placeholder="<?= _('admin') ?>"
             value="<?= $admin_username ?>">
      <br>
      <input autocomplete="off"
             type="password"
             name="admin_password"
             placeholder=<?= _('password') ?>
             value="">
      <br>
    </form>
    <input class="action"
           type="submit"
           form="Form1"
           value="<?= _('action_' . CONTROLLER . '_' . ACTION) ?>">
  </article>
  <?php if (isset($errorMessage)) { ?>
    <br>
    <article>
      <p><?= $errorMessage ?></p>
    </article>
  <?php } ?>
</main>
<?php $content = ob_get_clean();

require 'views/template.php';
