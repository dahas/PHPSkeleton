<?php

use PHPSkeleton\App\AppController;

require dirname(__DIR__, 1) . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$app = new AppController();
$app->execute();