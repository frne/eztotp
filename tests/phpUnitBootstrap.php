<?php

define('BASE_PATH', realpath(dirname(__FILE__) . '/../../../'));
define('APPLICATION_PATH', BASE_PATH . '/extension/tests');

// Define application environment
define('APPLICATION_ENV', 'testing');
include BASE_PATH . '/autoload.php';
ezpAutoloader::updateExtensionAutoloadArray();

