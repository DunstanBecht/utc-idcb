<?php
/**
 * This file defines specific style elements for the site.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package settings
 */

header('content-type: text/css; charset: UTF-8');
ob_start('ob_gzhandler');
header('Cache-Control: max-age=3600, must-revalidate');

require_once '../settings.php';

$icons = 3; // icons height [vh]
$icons_information = 2; // icons height [vh]
$unity_bronze = file_get_contents(UNITY . "/color/bronze");

?>

body {
  background: url("/content/pictures/background.svg") no-repeat center fixed #ffffff;
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

.action_text {
  transition: all 0.2s ease-in;
}

.active_text, .action_text:hover {
  cursor: pointer;
  color: #fcd216ff;
  fill: #fcd216ff;
}

.icons {
  height: <?= $icons ?>vh;
  padding: 0.2vh;
}

.icons_information {
  height: <?= $icons_information ?>vh;
}

@media (max-aspect-ratio: <?= STYLE['width'] ?>/<?= STYLE['height'] ?>) {

  .icons {
    height: <?= $icons*$coefficient ?>vw;
    padding: <?= 0.2*$coefficient ?>vw;
  }

  .icons_information {
    height: <?= $icons_information*$coefficient ?>vw;
  }
}
