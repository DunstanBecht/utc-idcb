<?php
/**
 * This file defines global parameters.
 * @author Dunstan Becht <dunstan@becht.network>
 * @package settings
 */

/* */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/* Use the above lines for debugging. */

/**
 * Controller to use for each incoming URL.
 */
define('ROUTES',
  array(
    'home'=>'controllers\Home',
    'guide'=>'controllers\Guide',
    'account'=>'controllers\Account',
    'admin'=>'controllers\Admin',
    'cron'=>'controllers\Cron',
  )
);

/**
 * Controllers hidden from the navigation bar.
 */
define('HIDDEN',
  array(
    'admin',
    'cron',
  )
);

/**
 * Available languages and associated countries.
 */
define('LANGUAGES',
  array(
    'fr'=>array(
      'FR',
    ),
    'en'=>array(
      'US',
    ),
  )
);

/**
 * Session variables that can not be modified via HTTP POST method.
 */
define('PROTECTED_VARIABLES',
  array(
    "admin",
    "user",
    "path",
    "answers",
  )
);

/**
 * Path to Unity resources.
 */
define('UNITY', 'https://dunstan.becht.network/unity');

/**
 * Database hostname.
 */
define('DB_DSN', 'mysql:host=localhost; dbname=sandbox; charset=utf8');

/**
 * Database user.
 */
define('DB_USR', 'sandbox_admin');

/**
 * Database password.
 */
define('DB_PWD', '###');

/**
 * Administrators and their credentials.
 * Use password_hash("<password>", PASSWORD_DEFAULT) to generate the hash.
 */
define('ADMINS',
  array(
    "root"=>'$2y$10$Ki1fKc9k9WW3er6LtgHkHuXHqRyRLv2hAr9BX/QAsNjTyvmJPvrBW',
  )
);

/**
 * Style constants.
 */
define('STYLE',
  array(
    "width"=>3,
    "height"=>4,
  )
);
