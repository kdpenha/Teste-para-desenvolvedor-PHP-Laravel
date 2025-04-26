<?php

require_once __DIR__ . '/../controllers/AppController.php';
require_once __DIR__ . '/../models/PropertiesModel.php';
require_once __DIR__ . '/../helpers/Validator.php';

class PropertyController extends AppController
{
    public function index()
    {
        $title = 'Imóveis';
        $properties = (new PropertiesModel())->all();
        include __DIR__ . '/../views/Properties/index.php';
    }

    public function create()
    {
        $title = 'Novo Imóvel';
        $propertyTypes = $this->propertyTypes;
        $neighborhoods = $this->neighborhoods;
        include __DIR__ . '/../views/Properties/create.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = Validator::validateProperty($_POST, $this->neighborhoods, $this->propertyTypes);
        
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header('Location: /properties/create');
                exit;
            }
        
            (new PropertiesModel())->save($_POST);
            header('Location: /properties');
            exit;
        }
        
    }

    public function edit()
    {
        $title = 'Editar Imóvel';

        if (!isset($_GET['id'])) {
            header('Location: /properties');
            exit;
        }

        $id = $_GET['id'];

        $propertyTypes = $this->propertyTypes;
        $neighborhoods = $this->neighborhoods;
        $property = (new PropertiesModel())->find($id);
        include __DIR__ . '/../views/Properties/create.php';
    }

    public function update()
    {
        if (!isset($_POST['id'])) {
            header('Location: /properties');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = Validator::validateProperty($_POST, $this->neighborhoods, $this->propertyTypes);
        
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header('Location: /properties/edit?id=' . $_POST['id']);
                exit;
            }
        
            (new PropertiesModel())->update($_POST['id'], $_POST);
            header('Location: /properties');
            exit;
        }
    }

    public function delete()
    {
        if (!isset($_GET['id'])) {
            header('Location: /properties');
            exit;
        }

        $id = $_GET['id'];
        (new PropertiesModel())->delete($id);
        header('Location: /properties');
        exit;
    }
}
