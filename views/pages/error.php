<?php
/**
 * This file defines the representation of information in the site error page.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package tabs\home
 */

ob_start(); ?>
<article>
  <h1 class="red"><?= _('error') ?></h1>
  <p class="center red"><?php echo $error_message; ?></p>
</article>
<?php $content = ob_get_clean();

require 'views/template.php';
