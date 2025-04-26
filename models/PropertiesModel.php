<?php

require_once __DIR__ . '/../models/PdoModel.php';

class PropertiesModel extends PdoModel {
    public function __construct() {
        parent::__construct('properties');
    }
}