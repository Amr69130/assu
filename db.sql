CREATE TABLE assurances (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) UNIQUE NOT NULL
);

CREATE TABLE contrats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    assurance_id INT,
    nom VARCHAR(255) NOT NULL,
    FOREIGN KEY (assurance_id) REFERENCES assurances(id)
);

CREATE TABLE garanties (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contrat_id INT,
    garantie VARCHAR(255) NOT NULL,
    FOREIGN KEY (contrat_id) REFERENCES contrats(id)
);

CREATE TABLE prix_moyen (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contrat_id INT,
    type_vehicule ENUM('citadine', 'berline', 'utilitaire') NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (contrat_id) REFERENCES contrats(id)
);

-- Insertion des données
INSERT INTO assurances (nom) VALUES ('AssurAuto+'), ('SafeDrive'), ('ZenAssur'), ('AutoSécure');

INSERT INTO contrats (assurance_id, nom) VALUES 
(1, 'Eco'), (1, 'PlusPlus'), 
(2, 'Eco'), (2, 'PlusPlus'), 
(3, 'Eco'), (3, 'PlusPlus'), 
(4, 'Eco'), (4, 'PlusPlus');

-- Garanties pour chaque contrat
INSERT INTO garanties (contrat_id, garantie) VALUES 
(1, 'Responsabilité civile'), (1, 'Assistance minimale'), 
(2, 'Tous risques'), (2, 'Assistance 24/7'), (2, 'Véhicule de remplacement'), 
(3, 'Responsabilité civile'), (3, 'Bris de glace'), 
(4, 'Tous risques'), (4, 'Vol/incendie'), (4, 'Franchise réduite'), 
(5, 'Responsabilité civile'), (5, 'Protection du conducteur'), 
(6, 'Tous risques'), (6, 'Panne mécanique'), (6, 'Protection juridique'), 
(7, 'Responsabilité civile'), (7, 'Dépannage 50km'), 
(8, 'Tous risques'), (8, 'Garantie accessoires'), (8, '0km dépannage');

-- Prix moyens
INSERT INTO prix_moyen (contrat_id, type_vehicule, prix) VALUES 
(1, 'citadine', 25), (1, 'berline', 35), (1, 'utilitaire', 40),
(2, 'citadine', 45), (2, 'berline', 60), (2, 'utilitaire', 70),
(3, 'citadine', 22), (3, 'berline', 30), (3, 'utilitaire', 38),
(4, 'citadine', 50), (4, 'berline', 65), (4, 'utilitaire', 75),
(5, 'citadine', 20), (5, 'berline', 28), (5, 'utilitaire', 36),
(6, 'citadine', 47), (6, 'berline', 63), (6, 'utilitaire', 72),
(7, 'citadine', 23), (7, 'berline', 32), (7, 'utilitaire', 39),
(8, 'citadine', 48), (8, 'berline', 67), (8, 'utilitaire', 78);


