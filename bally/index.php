<?php

use app\controllers\TeamController;
use app\controllers\GameController;
use app\controllers\PlayerController;
use app\controllers\UserController;
use app\controllers\MailController;
use app\Router;
use app\Database;

require './vendor/autoload.php';

$database = new Database();
$router = new Router($database);

$router->get('/', [TeamController::class, 'index']);

$router->get('/teams', [TeamController::class, 'index']);
$router->get('/team/create', [TeamController::class, 'create']);
$router->post('/team/create', [TeamController::class, 'create']);
$router->get('/team/update', [TeamController::class, 'update']);
$router->post('/team/update', [TeamController::class, 'update']);
$router->post('/team/delete', [TeamController::class, 'delete']);


$router->get('/games', [GameController::class, 'gamesFull']);
$router->get('/game/create', [GameController::class, 'create']);
$router->post('/game/create', [GameController::class, 'create']);
$router->get('/game/update', [GameController::class, 'update']);
$router->post('/game/update', [GameController::class, 'update']);
$router->post('/game/delete', [GameController::class, 'delete']);

$router->get('/players', [PlayerController::class, 'playersFull']);
$router->get('/player/create', [PlayerController::class, 'create']);
$router->post('/player/create', [PlayerController::class, 'create']);
$router->get('/player/update', [PlayerController::class, 'update']);
$router->post('/player/update', [PlayerController::class, 'update']);
$router->post('/player/delete', [PlayerController::class, 'delete']);

$router->get('/user/create', [UserController::class, 'create']);
$router->post('/user/create', [UserController::class, 'create']);

$router->get('/register_success', [UserController::class, 'register_success']);

$router->get('/user/login', [UserController::class, 'login_user']);
$router->post('/user/login', [UserController::class, 'login_user']);

$router->get('/login_success', [UserController::class, 'login_success']);

$router->get('/mail', [MailController::class, 'mail_contact']);
$router->post('/mail', [MailController::class, 'mail_contact']);

$router->resolve();

