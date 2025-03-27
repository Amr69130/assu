<?php

namespace App\Manager;

use PDO;
use App\Model\Insurance;
use App\Model\ContractPrice;
use App\Model\Contract;

class InsuranceManager extends DatabaseManager
{



    //  selectionne de tous les assurances avec les contrats 
    public function selectAll(): array
    {
        // Connexion a la bdd et sélectionner tous les assurances
        $requete = self::getConnexion()->prepare(
            "SELECT 
                i.id , 
                i.name, 
                c.id AS contract_id, 
                c.name AS contract_name 
                    FROM 
                    insurance i 
                        LEFT JOIN contract c ON i.id = c.insurance_id
                        -- left join contract price and the insurance   
                            ORDER BY 
                            i.id, c.id;"
        );
        $requete->execute();
        $arrayInsurances = $requete->fetchAll();
        // creer des objets

        $insurances = [];
        foreach ($arrayInsurances as $arrayInsurance) {
            //Istantiation d'un objet Car avec les données du tableau associatif
            $insurances[] = new Insurance($arrayInsurance["id"], $arrayInsurance["name"]);
        }

        return $insurances;
    }

    public function selectByID(int $id): Insurance|false
    {
        $requete = self::getConnexion()->prepare(
            "SELECT 
            i.id AS insurance_id, 
            i.name AS insurance_name, 
            c.id AS contract_id, 
            c.name AS contract_name,
            cp.vehicle_type,
            cp.price
        FROM 
            insurance i
        LEFT JOIN 
            contract c ON i.id = c.insurance_id
        LEFT JOIN 
            contract_price cp ON c.id = cp.contract_id
        WHERE 
            i.id = :id"
        );

        $requete->execute(['id' => $id]);
        $results = $requete->fetchAll();

        if (!$results) {
            return false;
        }

        // Récupérer les informations de l'assurance
        $insuranceId = $results[0]['insurance_id'];
        $insuranceName = $results[0]['insurance_name'];
        $insurance = new Insurance($insuranceId, $insuranceName, []);
        // Créer un tableau pour stocker les contrats
        $contracts = [];

        foreach ($results as $row) {
            $contractId = $row['contract_id'];
            if (!isset($contracts[$contractId])) {
                $contracts[$contractId] = new Contract(
                    $contractId,
                    $row['contract_name'],
                    $insurance
                );
            }
            if ($row['vehicle_type'] !== null) {
                $contracts[$contractId]->addPrice(
                    new ContractPrice($row['vehicle_type'], $row['price'])
                );
            }
        }

        return new Insurance($insuranceId, $insuranceName, array_values($contracts));
    }






//    public function selectByID(int $id): Insurance|false
//    {
//        $requete = self::getConnexion()->prepare(
//            "SELECT
//            i.id,
//            i.name,
//            c.id AS contract_id,
//            c.name AS contract_name,
//            cp.vehicle_type,
//            cp.price
//        FROM
//            insurance i
//        INNER JOIN
//            contract c ON i.id = c.insurance_id
//        LEFT JOIN
//            contract_price cp ON c.id = cp.contract_id
//        WHERE
//            i.id = :id"
//        );
//
//        $requete->execute(['id' => $id]);
//        $arrayInsurance = $requete->fetchAll(); // On récupère toutes les lignes correspondantes
//
//        if (empty($arrayInsurance)) {
//            return false; // Aucun résultat trouvé
//        }
//
//        // Initialisation des tableaux pour stocker les contrats
//        $contracts = [];
//
//        foreach ($arrayInsurance as $row) {
//            $contracts[] = [
//                'contract_id' => $row["contract_id"],
//                'contract_name' => $row["contract_name"],
//                'vehicle_type' => $row["vehicle_type"],
//                'price' => $row["price"]
//            ];
//        }
//
//        // Création de l'objet Insurance
//        return new Insurance(
//            $arrayInsurance[0]["id"],  // ID de l'assurance
//            $arrayInsurance[0]["name"], // Nom de l'assurance
//            $contracts  // Tableau des contrats associés
//        );
//    }







    // add insurance
    public function insert(string $name): bool
    {
        $requete = self::getConnexion()->prepare("INSERT INTO insurance (name) VALUES(:name);");
        $requete->execute([
            ":name" => $name
        ]);
        return $requete->rowCount() > 0;
    }

    // update insurance
    public function update(int $id, string $name): bool
    {
        $requete = self::getConnexion()->prepare("UPDATE insurance SET name = :name WHERE id = :id;");
        return $requete->execute(['id' => $id, 'name' => $name]);
    }

    //  delete insurance
    public function deleteInsurance(int $id): bool
    {
        $requete = self::getConnexion()->prepare("DELETE FROM insurance WHERE id = :id;");
        return $requete->execute(['id' => $id]);
    }
}
