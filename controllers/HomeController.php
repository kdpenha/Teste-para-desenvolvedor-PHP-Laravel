<?php

require_once __DIR__ . '/../controllers/AppController.php';

class HomeController extends AppController
{
    public function index() {
        $title = 'Página Inicial';
        include __DIR__ . '/../views/Home/index.php';
    }
}
