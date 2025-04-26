<?php

require_once __DIR__ . '/../models/PdoModel.php';

class CustomerInterestsModel extends PdoModel {
    public function __construct() {
        parent::__construct('customer_interests');
    }
}