<?php
date_default_timezone_set('UTC');

require __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 'on');

define('_ROOT_PATH', realpath(__DIR__.DIRECTORY_SEPARATOR.'..'));
define('_TEST_TASKS_PATH', _ROOT_PATH.DIRECTORY_SEPARATOR.'tests'.DIRECTORY_SEPARATOR.'tasks');