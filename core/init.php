<?php

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define('SITE_ROOT', DS . 'htdocs'. DS . 'gog_task');
defined('INCLUDE_PATH') ? null : define('INCLUDE_PATH', SITE_ROOT . DS . 'includes');
defined('CORE_PATH') ? null : define('CORE_PATH', SITE_ROOT . DS . 'core');

//load config
require_once(INCLUDE_PATH . DS . "config.php");

//core classes
//require_once(CORE_PATH . DS . "post.php");

class init
{

}