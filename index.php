<?php
/**
 * This file manages the routing to the requested resource.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package rooting
 */

// Start new or resume existing session:
session_start();

// Post-Redirect-Get:
if (count($_POST)>0) {
  foreach ($_POST as $key => $value){
    if (!in_array($key, PROTECTED_VARIABLES)) {
      $_SESSION[$key] = htmlspecialchars($value);
    }
  }
  header($_SERVER["SERVER_PROTOCOL"] . ' 303 See Other');
  header('Location: ' . $_SERVER['REQUEST_URI']);
  die();
}

// Autoloading classes:
spl_autoload_register(function ($class_name) {
  include str_replace('\\', '/', $class_name) . '.php';
});

// Import global settings:
require 'settings.php';

// Retrieve the language, the location and the parameter:
$path = explode('/', substr(strtok($_SERVER['REQUEST_URI'], '?'), 1));
if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
  $locale = explode('_', Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']));
}
// 1: try to retrieve the language from the URL:
if (in_array($path[0], array_keys(LANGUAGES))) {
  $language = $path[0];
  $location = array_slice($path, 1);
  $path_language = '/' . $language;
} else {
  // 2: if it doesn't work, try to retrieve the language from HTTP_ACCEPT_LANGUAGE:
  if (isset($locale) and array_key_exists($locale[0], LANGUAGES)) {
    $language = $locale[0];
    if (strcmp($language, array_keys(LANGUAGES)[0])!=0 and $path[0]!='unity') {
      header($_SERVER["SERVER_PROTOCOL"] . ' 303 See Other');
      header('Location: /' . $language . $_SERVER['REQUEST_URI']);
      die();
    }
  } else {
    // 3: if it doesn't work, use default settings language:
    $language = array_keys(LANGUAGES)[0];
  }
  $location = &$path;
  $path_language = '';
}

/**
 * Language of the used locale.
 */
define('LANGUAGE', $language);

/**
 * String to put at the beginning of the path when redirecting.
 * @see PATH_LOCATION
 */
define('PATH_LANGUAGE', $path_language);

/**
 * Where the resources resides. (Must be placed after the language.)
 * @see PATH_LANGUAGE
 */
define('PATH_LOCATION', '/' . implode('/', $location));

/**
 * Additional parameters in the location of the resource.
 */
define('PARAMETER', array_slice($location, 2));

// Retrieve the country:
if (isset($locale) and in_array($locale[1], LANGUAGES[LANGUAGE])) {
  $country = $locale[1];
} else {
  $country = LANGUAGES[LANGUAGE][0];
}

/**
 * Country of the used locale.
 */
define('COUNTRY', $country);

// Configure the translation to use with gettext:
$locale = LANGUAGE . '_' . COUNTRY;
setlocale(LC_MESSAGES, $locale);
bindtextdomain('messages', './views/locale');
bind_textdomain_codeset('messages', 'utf-8');

// Retrieve the controller:
if (count($location)>0 and $location[0]!='') {
  $controller = strtolower($location[0]);
  if (!array_key_exists($controller, ROUTES)) {
    $error_404 = True;
    $controller = 'home';
  }
} else {
  $controller = 'home';
}

/**
 * Level 1 of the location of the resource.
 */
define('CONTROLLER', $controller);

// Retrieve the action:
if (count($location)>1 and $location[1]!='') {
  $action = strtolower($location[1]);
  if (!in_array($action, get_class_methods(ROUTES[CONTROLLER]))) {
    $error_404 = True;
    $action = 'home';
  }
} else {
  $action = 'home';
}

/**
 * Level 2 of the location of the resource.
 */
define('ACTION', $action);

try {

  // Throw 404 error:
  if (isset($error_404)) {
    http_response_code(404);
    throw new \Exception(_('error_404'));
  }

  // Load controller and execute its action:
  $controller_class = ROUTES[CONTROLLER];
  $controller = new $controller_class;
  $controller->$action();

} catch (\Exception $e) {

  $error_message = $e->getMessage();
  require 'views/pages/error.php';

}
