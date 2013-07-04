#!/usr/bin/env php
<?php
// app/console
$loader = require '../Libs/autoload.php';
$loader->add('ZCE', __DIR__ . '/Classes');

use Symfony\Component\Console\Application;

$app = new Application('ZCE Study Questions', '0.0.1');
$app->add(new ZCE\Cli());
$app->run();
?>