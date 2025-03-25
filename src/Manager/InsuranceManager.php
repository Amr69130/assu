<?php

namespace App\Manager;

use PDO;
use App\Model\Insurance;

class InsuranceManager extends DatabaseManager
{



    //  selectionne de tous les assurances avec les contrats 
    public function getAllInsurances(): array
    {
        // Connexion a la bdd et sélectionner tous les assurances
        $requete = self::getConnexion()->prepare(
            "SELECT 
                i.id AS insurance_id, 
                i.name AS insurance_name, 
                c.id AS contract_id, 
                c.name AS contract_name, 
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

    public function getInsuranceById(int $id): array|false
    {
        $requete = self::getConnexion()->prepare(
            "SELECT 
                i.id AS insurance_id, 
                i.name AS insurance_name, 
                c.id AS contract_id, 
                c.name AS contract_name,
                cov.id AS coverage_id,
                cov.coverage AS coverage_type,
                cp.vehicle_type,
                cp.price
            FROM 
                insurance i
            INNER JOIN 
                contract c ON i.id = c.insurance_id
            LEFT JOIN 
                coverage cov ON c.id = cov.contract_id
            LEFT JOIN 
                contract_price cp ON c.id = cp.contract_id
            WHERE 
                i.id = :id
            ORDER BY 
                c.id, cov.id;
        "
        );
        $requete->execute(['id' => $id]);
        $arrayInsurance = $requete->fetch();
        return $arrayInsurance;
    }
    // add insurance
    public function addInsurance(string $name): bool
    {
        $requete = self::getConnexion()->prepare("INSERT INTO insurance (name) VALUES(:name);");
        $requete->execute([
            ":name" => $name
        ]);
        return $requete->rowCount() > 0;
    }

    // update insurance
    public function updateInsurance(int $id, string $name): bool
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
