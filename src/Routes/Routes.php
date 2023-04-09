<?php

namespace App\Routes;

use Slim\Routing\RouteCollectorProxy;
use Slim\Factory\AppFactory;
use App\Controllers\UserController;

require __DIR__ . '/../../vendor/autoload.php';

$app = AppFactory::create();

$app->group('/api/v1', function (RouteCollectorProxy $group) {
  
  $group->get('/user', UserController::class . ':home');

}); 

$app->run();
