<?php
/**
 * This file defines the representation of information in the site main page.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\home
 */

ob_start(); ?>
<img class="wide" src="/content/pictures/utc.svg" alt="UTC">
<?php $trigger_project = ob_get_clean();

ob_start(); ?>
<img class="wide" src="/content/pictures/team.svg" alt="UTC">
<?php $trigger_team = ob_get_clean();

ob_start(); ?>
<p><br><?= _('welcome_paragraph'); ?></p>
<?php $content_project = ob_get_clean();

ob_start(); ?>
<p><br>
  Gbelay Christina <br>
  Dalla Riva Catherine <br>
  Level Charline<br>
  Bencheriff Hamza<br>
  Ait Said Hamza<br>
</p>
<?php $content_team = ob_get_clean();

$toggle_project = new views\Toggle();
$toggle_team = new views\Toggle();

ob_start(); ?>
<article>
  <h1>
    <?= _('title_project') ?>
  </h1>
  <?= $toggle_project->trigger($trigger_project) ?>
  <?= $toggle_project->content($content_project) ?>
</article>
<br>
<article>
  <h1>
    <?= _('title_team') ?>
  </h1>
  <?= $toggle_team->trigger($trigger_team) ?>
  <?= $toggle_team->content($content_team) ?>
</article>
<?php $content = ob_get_clean();

require 'views/template.php';
