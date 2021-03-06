<?php
$website = 'Website';
$description = 'Description.';
?>
<!DOCTYPE html>
<html lang="<?= LANGUAGE ?>-<?= COUNTRY ?>">
  <head>
    <meta charset="utf-8">
    <meta name="author" content="Dunstan Becht">
    <meta name="creator" content="Dunstan Becht">
    <meta name="publisher" content="Dunstan Becht">
    <meta name="theme-color" content="#000000">
    <meta name="description" content="<?= $description ?>">
    <meta name="keywords" content="Key, Word">
    <title><?= ((CONTROLLER != 'home') ? _('controller_' . CONTROLLER) . ' - ' : "") . $website ?></title>
    <link rel="stylesheet" href="<?= UNITY ?>/style/general/1?footer_height=22" type="text/css" media="all">
    <link rel="stylesheet" href="<?= UNITY ?>/style/articles/1" type="text/css" media="all">
    <link rel="stylesheet" href="<?= UNITY ?>/style/fonts/1?font_size_2=2" type="text/css" media="all">
    <link rel="stylesheet" href="<?= UNITY ?>/style/signage/1" type="text/css" media="all">
    <link rel="stylesheet" href="<?= UNITY ?>/style/colors/1?action=<?= urlencode("#fcd216ff") ?>" type="text/css" media="all">
    <link rel="stylesheet" href="/views/style.php" type="text/css" media="all">
    <link rel="icon" href="/content/pictures/favicon.svg" sizes="any" type="image/svg+xml">
    <meta property="og:title" content="<?= $website ?>">
    <meta property="og:type" content="website">
    <meta property="og:description" content="<?= $description ?>">
    <meta property="og:image" content="https://<?= $_SERVER['HTTP_HOST'] ?>/content/pictures/preview.png">
    <meta property="og:url" content="https://<?= $_SERVER['HTTP_HOST'] ?>">
    <meta name="twitter:title" content="<?= $website ?>">
    <meta name="twitter:description" content="<?= $description ?>">
    <meta name="twitter:image" content="https://<?= $_SERVER['HTTP_HOST'] ?>/content/pictures/preview.png">
  </head>
  <body>
    <header>
      <nav style="margin: auto;">
        <?php foreach (array_keys(ROUTES) as $controller) { if (!in_array($controller, HIDDEN)) { ?>
          <a class="<?= (CONTROLLER==$controller) ? 'active' : 'action';?>"
             href="<?= PATH_LANGUAGE ?>/<?= ($controller!='home') ? $controller : '' ?>">
            &nbsp;<?= _('controller_' . $controller) ?>&nbsp;
          </a>
        <?php } } ?>
      </nav>
    </header>
    <div class="page">
      <?= $content ?>
    </div>
    <footer>
      <div style="margin: auto;">
        <p style="text-align: center;">
          <?php foreach (array_keys(LANGUAGES) as $language) { ?>
            <a class="<?= (LANGUAGE==$language) ? 'active' : 'action';?>"
               href="/<?= $language . PATH_LOCATION ?>">
              &nbsp;<?= $language ?>&nbsp;
            </a>
          <?php } ?>
          <br>
          <br>
          <?= _('footer_contact') ?> <a class="action_text" href="mailto:charline.level@etu.utc.fr">charline.level@etu.utc.fr</a>
          <br>
          <br>
          <a rel="license"
             target="_blank"
             style="font-size: 0;"
             href="https://creativecommons.org/licenses/by-nc-sa/4.0/">
            <svg class="icons action" viewBox="0 0 2048 512">
              <use href="/content/pictures/license/cc.svg#main" x="0"></use>
              <use href="/content/pictures/license/by.svg#main" x="512"></use>
              <use href="/content/pictures/license/nc.svg#main" x="1024"></use>
              <use href="/content/pictures/license/sa.svg#main" x="1536"></use>
            </svg>
          </a>
        </p>
      </div>
    </footer>
    <?= (views\Toggle::getCount()>0) ? "<script src='/views/js/toggle.js'></script>" : '' ?>
  </body>
</html>
