#!/usr/bin/env php
<?php
// Define paths
defined('CONF_PATH')
    || define('CONF_PATH', realpath(dirname(__FILE__) . '/../Conf'));
defined('SOURCE_PATH')
    || define('SOURCE_PATH', realpath(dirname(__FILE__) . '/../Source'));
defined('LIBS_PATH')
    || define('LIBS_PATH', realpath(dirname(__FILE__) . '/../Libs'));

/**
 * Start Composer Loader
 */
$loader = require LIBS_PATH . '/autoload.php';
$loader->add('ZCE', SOURCE_PATH . '/Classes');

use Symfony\Component\Console\Application;
use ZCE\App\Project;
use ZCE\App\Commands\ZCE;

/**
 * Starting Symfony Console Application and Adding Commands
 */
$app = new Application(Project::PROJECT, Project::VERSION);
$app->add(new ZCE);
$app->run();

?>