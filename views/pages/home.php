<?php

ob_start(); ?>

<article>
  <h1>
    <?= _('title_project') ?>
  </h1>
  <img class="wide" src="/content/pictures/utc.svg" alt="UTC">
</article>

<article>
  <h1>
    <?= _('title_team') ?>
  </h1>
  <img class="wide" src="/content/pictures/utc.svg" alt="UTC">
</article>

<?php $content = ob_get_clean();

require 'views/template.php';
