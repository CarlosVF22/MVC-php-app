<?php
// Database config
require_once 'config/database.php';

$requestUri = $_SERVER['REQUEST_URI'];
$position = strpos($requestUri, '?');
if ($position !== false) {
    $requestUri = substr($requestUri, 0, $position);
}

$routes = [
    '/' => 'HomeController@index',
    '/crear-tecnico' => 'TechnicianController@save',
    '/eliminar-tecnico' => 'TechnicianController@delete',
    '/actualizar-tecnico' => 'TechnicianController@update',
    '/api/lista-sucursales' => 'ApiController@branchList',
    '/api/lista-elementos' => 'ApiController@elementList'
    
];

if (isset($routes[$requestUri])) {
    list($controller, $method) = explode('@', $routes[$requestUri]);
    $controllerPath = "controllers/" . $controller . ".php";
    if (file_exists($controllerPath)) {
        require $controllerPath;
        $controllerInstance = new $controller;
        $controllerInstance->$method();
    } else {
        // Controlador no encontrado
        header("HTTP/1.1 404 Not Found");
        echo "404 - Controlador no encontrado";
    }
} else {
    // Ruta no encontrada
    header("HTTP/1.1 404 Not Found");
    echo "404 - Página no encontrada";
}
