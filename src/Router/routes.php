<?php
use AltoRouter;
use Src\Controller\UserController;

$router = new AltoRouter();

$router->map('GET', '/user', [UserController::class, 'getAllUsers']);
$router->map('GET', '/user/[i:id]', [UserController::class, 'getUser']);
$router->map('POST', '/user', [UserController::class, 'createUser']);
$router->map('PUT', '/user/[i:id]', [UserController::class, 'updateUser']);
$router->map('DELETE', '/user/[i:id]', [UserController::class, 'deleteUser']);

return $router;
