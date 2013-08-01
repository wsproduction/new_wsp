<?php
error_reporting(E_ALL);

define('base_path', dirname(__FILE__));
define('framework_base', '../framework');

$route = require_once(base_path . '/router.php');
require_once($route['framework']);

WSFramework::app($route['application'])->run();
?>
