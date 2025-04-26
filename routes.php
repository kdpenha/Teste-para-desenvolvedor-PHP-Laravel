<?php 

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

switch ($uri) {
    case '/home':
    case '/':
        require 'controllers/HomeController.php';
        $controller = new HomeController();
        $controller->index();
        break;
    
    default:
        http_response_code(404);
        echo "Página não encontrada!";
        break;
}