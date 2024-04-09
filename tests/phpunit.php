<?php

$autoloader = dirname(__DIR__) . '/vendor/autoload.php';

if (! file_exists($autoloader)) {
    echo "Composer autoloader not found: $autoloader" . PHP_EOL;
    echo "Please run 'composer install' and try again." . PHP_EOL;
    exit(1);
}

require_once $autoloader;
