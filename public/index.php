<?php

use PHPSkeleton\App\App;

!defined('ROOT') && define('ROOT', dirname(__DIR__, 1));

require ROOT . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(ROOT);
$dotenv->safeLoad();

$app = new App();
$app->execute();