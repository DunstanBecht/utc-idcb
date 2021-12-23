<?php
/**
 * This file defines the representation of information in the site main page.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\home
 */

ob_start(); ?>
<img class="wide" src="/content/pictures/utc.svg" alt="UTC">
<?php $up_project = ob_get_clean();

ob_start(); ?>
<img class="wide" src="/content/pictures/team.svg" alt="UTC">
<?php $up_team = ob_get_clean();

ob_start(); ?>
<p><br><?= _('welcome_paragraph'); ?></p>
<?php $down_project = ob_get_clean();

ob_start(); ?>
<p><br>
  Gbelay Christina <br>
  Dalla Riva Catherine <br>
  Level Charline<br>
  Bencheriff Hamza<br>
  Ait Said Hamza<br>
</p>
<?php $down_team = ob_get_clean();

ob_start(); ?>
<article>
  <h1>
    <?= _('title_project') ?>
  </h1>
  <?= views\Toggle::message($up_project, $down_project); ?>
</article>
<br>
<article>
  <h1>
    <?= _('title_team') ?>
  </h1>
  <?= views\Toggle::message($up_team, $down_team); ?>
</article>
<?php $content = ob_get_clean();

require 'views/template.php';
