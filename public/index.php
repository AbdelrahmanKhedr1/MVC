<?php

define('ROOT_PATH', dirname(__FILE__));
define('ROOT_DIR', '/MVC/public/');

/**
 * Run Composer Autoloder
 */
require_once __DIR__ . '/../vendor/autoload.php';

/**
 * Run theFramework
 */
(new \Iliuminates\Application)->start();

