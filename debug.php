<?php

use PHPSkeleton\App\AppController;

require 'vendor/autoload.php'; // <-- Import of autoloader

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();


# Set Request Params:
# -----------------------------------------
$_SERVER['REQUEST_URI'] = "/Text/reverse";
// $_SERVER['REQUEST_URI'] = "/Data/load";
// $_SERVER['REQUEST_URI'] = "/Arithmetic/multiply";
// $_SERVER['REQUEST_URI'] = "/Arithmetic/add";
// $_SERVER['REQUEST_URI'] = "/Arithmetic/subtract";
$_SERVER['REQUEST_METHOD'] = "GET";
$_GET['a'] = 123;
$_GET['b'] = 210;
$_POST['flip'] = "Reverse";
# -----------------------------------------


$app = new AppController();
$app->execute();
