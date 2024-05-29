<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Application;
use App\Libraries\LoadEnvironments;
use App\Libraries\LoadServices;
use Symfony\Component\HttpClient\HttpClient;

LoadEnvironments::getInstance()->load(realpath(__DIR__."\.env"));

if(!isset($_SERVER['argv'][1])) {
    echo "Please enter input file path"; exit();
}
$httpClient = HttpClient::create();
$services = LoadServices::getInstance();
$services->loadCustomDependencies();
$services->dataProvider->setClient($httpClient);
$app = Application::getInstance();
$app->setServices($services);
$app->run();


