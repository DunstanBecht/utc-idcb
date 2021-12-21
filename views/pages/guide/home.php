<?php

ob_start(); ?>
<main>
  <article>
    <h1><?= _('controller_' . CONTROLLER) ?></h1>
  </article>
</main>
<?php $content = ob_get_clean();

require 'views/template.php';
