CREATE DATABASE teste_php;

USE teste_php;

-- Tabela de propriedades (imóveis)
CREATE TABLE properties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    property_type VARCHAR(255) NOT NULL,
    neighborhood VARCHAR(255) NOT NULL,
    number_of_rooms INT NOT NULL,
    price FLOAT NOT NULL
);

-- Tabela de interesses de clientes
CREATE TABLE customer_interests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    desired_property_type VARCHAR(255) NOT NULL,
    property_price_min FLOAT,
    property_price_max FLOAT,
    number_min_of_rooms INT,
    desired_neighborhoods JSON
);