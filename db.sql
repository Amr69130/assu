CREATE DATABASE insurance;

USE insurance;

CREATE TABLE insurance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

CREATE TABLE contract (
    id INT AUTO_INCREMENT PRIMARY KEY,
    insurance_id INT,
    name VARCHAR(255) NOT NULL,
    FOREIGN KEY (insurance_id) REFERENCES insurance(id)
);



CREATE TABLE contract_price (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contract_id INT,
    vehicle_type ENUM('city_car', 'sedan', 'utility') NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (contract_id) REFERENCES contract(id)
);

-- Data Insertion
INSERT INTO insurance (name) VALUES ('AssurAuto+'), ('SafeDrive'), ('ZenAssur'), ('AutoSecure');

INSERT INTO contract (insurance_id, name) VALUES 
(1, 'Eco'), (1, 'PlusPlus'),
(2, 'Eco'), (2, 'PlusPlus'),
(3, 'Eco'), (3, 'PlusPlus'),
(4, 'Eco'), (4, 'PlusPlus');




-- Average prices
INSERT INTO contract_price (contract_id, vehicle_type, price) VALUES 
(1, 'city_car', 25), (1, 'sedan', 35), (1, 'utility', 40),
(2, 'city_car', 45), (2, 'sedan', 60), (2, 'utility', 70),
(3, 'city_car', 22), (3, 'sedan', 30), (3, 'utility', 38),
(4, 'city_car', 50), (4, 'sedan', 65), (4, 'utility', 75),
(5, 'city_car', 20), (5, 'sedan', 28), (5, 'utility', 36),
(6, 'city_car', 47), (6, 'sedan', 63), (6, 'utility', 72),
(7, 'city_car', 23), (7, 'sedan', 32), (7, 'utility', 39),
(8, 'city_car', 48), (8, 'sedan', 67), (8, 'utility', 78);
