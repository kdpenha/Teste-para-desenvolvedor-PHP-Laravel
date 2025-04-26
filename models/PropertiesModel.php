<?php

require_once __DIR__ . '/../models/PdoModel.php';

class PropertiesModel extends PdoModel {
    public function __construct() {
        parent::__construct('properties');
    }

    public function getPropertiesForInterest($interest)
    {
        $query = "SELECT * FROM properties WHERE property_type = :property_type";
        $params = [
            ':property_type' => $interest['desired_property_type'],
        ];

        if (!empty($interest['property_price_min'])) {
            $query .= " AND price >= :price_min";
            $params[':price_min'] = $interest['property_price_min'];
        }
        if (!empty($interest['property_price_max'])) {
            $query .= " AND price <= :price_max";
            $params[':price_max'] = $interest['property_price_max'];
        }
        if (!empty($interest['number_min_of_rooms'])) {
            $query .= " AND number_of_rooms >= :min_rooms";
            $params[':min_rooms'] = $interest['number_min_of_rooms'];
        }
        if (!empty($interest['desired_neighborhoods'])) {
            $neighborhoods = json_decode($interest['desired_neighborhoods'], true);
            if (!empty($neighborhoods)) {
                $query .= " AND neighborhood IN ('" . implode("', '", $neighborhoods) . "')";
                // OBS: neighborhoods não é bindado, é direto na string.
            }
        }

        $stmt = $this->db->prepare($query);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}