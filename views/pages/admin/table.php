<?php

ob_start(); ?>
<main>
  <article>
    <pre><p><?= print_r($data, true) ?></p></pre>
  </article>
</main>
<?php $content = ob_get_clean();

require 'views/template.php';
