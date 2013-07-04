#!/usr/bin/env php
<?php
// app/console
$loader = require '../Libs/autoload.php';

use Symfony\Component\Console\Application;

$loader->add('ZCE', __DIR__ . '/Classes');

$app = new Application;
$app->add(new ZCE\Cli());
$app->run();
?>