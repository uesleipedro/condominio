<?php

namespace App\Routes;

use Slim\Routing\RouteCollectorProxy;
use Slim\Factory\AppFactory;
use App\Controllers\UserController;
use App\Controllers\ClienteController;

require __DIR__ . '/../../vendor/autoload.php';

$app = AppFactory::create();
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

$app->group('/api/v1', function (RouteCollectorProxy $group) {

  $group->get('/user', UserController::class . ':home');

  $group->group('/cliente', function(RouteCollectorProxy $group){

    $group->get('', ClienteController::class . ':getClientes');

    $group->post('', ClienteController::class . ':store');
/*
        // Delete book with ID
        $app->delete('/books/:id', function ($id) {

        });
*/
    });

}); 

$app->run();
