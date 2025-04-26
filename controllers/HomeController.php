<?php

class HomeController {
    public function index() {
        $title = 'Página Inicial';
        include __DIR__ . '/../views/Home/index.php';
    }
}
