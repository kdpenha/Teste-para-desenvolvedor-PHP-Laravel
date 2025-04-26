<?php

include __DIR__ . '/../config/constants.php';

class AppController
{
    public $propertyTypes;
    public $neighborhoods;

    public function __construct() {
        global $propertyTypes;
        global $neighborhoods;

        $this->propertyTypes = $propertyTypes;
        $this->neighborhoods = $neighborhoods;
    }  
}
