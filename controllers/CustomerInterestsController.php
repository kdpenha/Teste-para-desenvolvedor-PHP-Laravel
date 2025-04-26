<?php

require_once __DIR__ . '/../controllers/AppController.php';
require_once __DIR__ . '/../models/CustomerInterestsModel.php';
require_once __DIR__ . '/../helpers/Validator.php';

class CustomerInterestsController extends AppController
{
    public function index()
    {
        $title = 'Interesse de Clientes';
        $customerInterests = (new CustomerInterestsModel())->all();
        include __DIR__ . '/../views/CustomerInterests/index.php';
    }

    public function create()
    {
        $title = 'Novo Interesse de Cliente';
        $propertyTypes = $this->propertyTypes;
        $neighborhoods = $this->neighborhoods;
        include __DIR__ . '/../views/CustomerInterests/create.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = Validator::validateCustomerInterest($_POST, $this->neighborhoods, $this->propertyTypes);
        
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header('Location: /customer-interests/create');
                exit;
            }

            $data = array_filter($_POST, function($item) {
                if (is_array($item)) {
                    return !empty($item); // se for array, só checa se tá vazio ou não
                }
                return trim($item) !== '';
            });
            $data['desired_neighborhoods'] = json_encode($data['desired_neighborhoods']);
        
            (new CustomerInterestsModel())->save($data);
            header('Location: /customer-interests');
            exit;
        }
        
    }

    public function edit()
    {
        $title = 'Editar Interesse de Cliente';

        if (!isset($_GET['id'])) {
            header('Location: /customer-interests');
            exit;
        }

        $id = $_GET['id'];

        $propertyTypes = $this->propertyTypes;
        $neighborhoods = $this->neighborhoods;
        $customerInterest = (new CustomerInterestsModel())->find($id);
        include __DIR__ . '/../views/CustomerInterests/create.php';
    }

    public function update()
    {
        if (!isset($_POST['id'])) {
            header('Location: /customer-interests');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = Validator::validateCustomerInterest($_POST, $this->neighborhoods, $this->propertyTypes);
        
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header('Location: /customer-interests/edit?id=' . $_POST['id']);
                exit;
            }

            $data = array_filter($_POST, function($item) {
                if (is_array($item)) {
                    return !empty($item); // se for array, só checa se tá vazio ou não
                }
                return trim($item) !== '';
            });
            $data['desired_neighborhoods'] = json_encode($data['desired_neighborhoods']);
            
            (new CustomerInterestsModel())->update($data['id'], $data);
            header('Location: /customer-interests');
            exit;
        }
    }

    public function delete()
    {
        if (!isset($_GET['id'])) {
            header('Location: /customer-interests');
            exit;
        }

        $id = $_GET['id'];
        (new CustomerInterestsModel())->delete($id);
        header('Location: /customer-interests');
        exit;
    }
}
