<?php

require_once __DIR__ . '/../config/constants.php';

class Validator
{
    public static function validateProperty($data, $neighborhoods, $propertyTypes)
    {
        $errors = [];

        if (empty(trim($data['name'] ?? ''))) {
            $errors[] = "Nome é obrigatório.";
        }

        if (empty($data['neighborhood']) || !in_array($data['neighborhood'], $neighborhoods)) {
            $errors[] = "Bairro é obrigatório.";
        }

        if (empty($data['property_type']) || !in_array($data['property_type'], $propertyTypes)) {
            $errors[] = "Tipo de imóvel é obrigatório.";
        }

        if (!isset($data['number_of_rooms']) || !is_numeric($data['number_of_rooms']) || $data['number_of_rooms'] < 0) {
            $errors[] = "Número de quartos deve ser um número válido.";
        }

        if (!isset($data['price']) || !is_numeric($data['price']) || $data['price'] <= 0) {
            $errors[] = "Preço deve ser um número maior que zero.";
        }

        return $errors;
    }

    public static function validateCustomerInterest($data, $neighborhoods, $propertyTypes)
    {
        $errors = [];

        if (empty(trim($data['name'] ?? ''))) {
            $errors[] = "Nome é obrigatório.";
        }

        if (empty(trim($data['phone'] ?? ''))) {
            $errors[] = "Telefone é obrigatório.";
        }

        if (empty($data['desired_property_type']) || !in_array($data['desired_property_type'], $propertyTypes)) {
            $errors[] = "Tipo de imóvel é obrigatório.";
        }
        
        if (empty(trim($data['property_price_min'] ?? '')) && empty(trim($data['property_price_max'] ?? ''))) {
            $errors[] = "Pelo menos um preço de imóvel (max ou min) é obrigatório.";
        }

        return $errors;
    }
}
