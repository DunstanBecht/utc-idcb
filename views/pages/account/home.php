<?php
/**
 * This file defines the representation of information in account tab.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\account
 */

ob_start(); ?>
<main>
  <article>
    <h1><?= _('controller_' . CONTROLLER) ?></h1>
  </article>
</main>
<?php $content = ob_get_clean();

require 'views/template.php';
