<?php

ob_start(); ?>
<main>
  <article>
    <h1><?= _('action_' . CONTROLLER . '_' . ACTION) ?></h1>

    <form id="Form1" method="post">
      <input autocomplete="off"
             maxlength="256"
             type="text"
             name="mail"
             placeholder="<?= _('mail') ?>"
             value="<?= $mail ?>">
      <br>
      <input autocomplete="off"
             type="password"
             name="password"
             placeholder=<?= _('password') ?>
             value="">
      <br>
    </form>
    <a class="action"
       href="<?= PATH_LANGUAGE ?>/<?= CONTROLLER ?>/register">
      <?= _('action_' . CONTROLLER . '_register') ?>
    </a>
    <div style="width: 10%"></div>
    <input class="action"
           type="submit"
           form="Form1"
           value="<?= _('action_' . CONTROLLER . '_login') ?>">
    <br>
    <a class="action"
       href="<?= PATH_LANGUAGE ?>/<?= CONTROLLER ?>/passwordreset">
      <?= _('action_' . CONTROLLER . '_passwordreset') ?>
    </a>
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
