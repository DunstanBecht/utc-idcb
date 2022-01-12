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
<p><br><?= _('text_objective'); ?></p>
<ul style="text-align:left;">
  <li><?= _('text_objective_1'); ?></li>
  <li><?= _('text_objective_2'); ?></li>
  <li><?= _('text_objective_3'); ?></li>
</ul>
<p><?= _('welcome_paragraph'); ?></p>
<?php $content_project = ob_get_clean();

ob_start(); ?>
<ul style="text-align:left;">
  <li>Gbelay Christina (cgbelay@laposte.net)</li>
  <li>Dalla Riva Catherine (catdallariva@gmail.com)</li>
  <li>Level Charline (levelcharline@gmail.com)</li>
  <li>Bencheriff Hamza (bencherrifh@gmail.com)</li>
  <li>Ait Said Hamza (aitshamza@gmail.com)</li>
</ul>
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
