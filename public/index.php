<?php
require '../boostrap.php';
require '../vendor/autoload.php';
$db = require '../db.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$router = require '../src/Router/routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = rtrim($uri, '/');

$match = $router->match($uri);

if ($match) {
    if (is_array($match['target'])) {
        list($controllerClass, $method) = $match['target'];
    } elseif (is_string($match['target'])) {
        list($controllerClass, $method) = explode('#', $match['target']);
    } else {
        die("Error: Invalid target format");
    }

    if (class_exists($controllerClass) && method_exists($controllerClass, $method)) {
        $controller = new $controllerClass();
        call_user_func_array([$controller, $method], $match['params']);
    } else {
        header("HTTP/1.1 500 Internal Server Error");
        echo json_encode(["message" => "Internal Server Error"]);
    }
} else {
    header("HTTP/1.1 404 Not Found");
    echo json_encode(["message" => "Not Found"]);
}
