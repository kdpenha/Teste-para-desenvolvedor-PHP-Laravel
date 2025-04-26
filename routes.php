<?php 

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$routes = [
    '/' => ['controller' => 'HomeController', 'method' => 'index'],
    '/home' => ['controller' => 'HomeController', 'method' => 'index'],

    '/properties' => ['controller' => 'PropertyController', 'method' => 'index'],
    '/properties/create' => ['controller' => 'PropertyController', 'method' => 'create'],
    '/properties/save' => ['controller' => 'PropertyController', 'method' => 'save'],
    '/properties/edit' => ['controller' => 'PropertyController', 'method' => 'edit'],
    '/properties/update' => ['controller' => 'PropertyController', 'method' => 'update'],
    '/properties/delete' => ['controller' => 'PropertyController', 'method' => 'delete'],
];

// Verifica se a rota existe
if (isset($routes[$uri])) {
    $controllerName = $routes[$uri]['controller'];
    $method = $routes[$uri]['method'];

    require_once __DIR__ . "/controllers/{$controllerName}.php";

    $controller = new $controllerName();

    call_user_func([$controller, $method]);
} else {
    http_response_code(404);
    echo "Página não encontrada!";
}
