<?php
/**
 * This file defines specific style elements for the site.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package settings
 */

header('content-type: text/css; charset: UTF-8');
ob_start('ob_gzhandler');
header('Cache-Control: max-age=3600, must-revalidate');

?>

body {
  background: url("/content/pictures/background.svg") no-repeat center fixed #000000;
  background-size: cover;
}

@font-face {
  font-family: "Text";
  src: url("/content/fonts/text.ttf") format("truetype");
}

img.wide {
  transition: all 0.2s ease-in;
}

img.wide:hover {
  transform: scale(0.98);
}
