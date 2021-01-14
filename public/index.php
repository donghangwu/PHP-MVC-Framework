<?php
use app\Router;
use app\controllers\MainController;
require_once __DIR__.'/../vendor/autoload.php';
$router= new Router();

//main index page
$router->get('/',[MainController::class,'index']);

//create Route
$router->get('/products/create',[MainController::class,'create']);
$router->post('/products/create',[MainController::class,'create']);

//edit Route
$router->get('/products/edit',[MainController::class,'edit']);
$router->post('/products/edit',[MainController::class,'edit']);

//delete Route
$router->post('/products/delete',[MainController::class,'delete']);

$router->resolve();