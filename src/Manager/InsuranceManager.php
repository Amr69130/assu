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
                            GROUP BY
                            i.id
                            ORDER BY 
                            i.id, c.id
                            ;"

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
               i.id,
               i.name
           FROM
               insurance i
           WHERE
               i.id = :id"
        );

        $requete->execute(['id' => $id]);
        $arrayInsurance = $requete->fetch(); // On récupère toutes les lignes correspondantes

        if ($arrayInsurance === false) {
            return false; // Aucun résultat trouvé
        }

        $contractManager = new ContractManager();
        $contractPriceManager = new ContractPriceManager();
        // TODO Select contracts by assurance id et adpater la boucle
        $arrayContracts = "???";
        // Initialisation des tableaux pour stocker les contrats
        $contracts = [];
        foreach ($arrayContracts as $arrayContract) {
            // TODO Select contractPrices by ContractID id et adpater la boucle
            $arrayContractPrices = "???";
            $contractsPrices = [];
            foreach ($arrayContractPrices as $arrayContractPrice) {
                $contractsPrices[] = new ContractPrice($arrayContract["id"], $arrayContract["price"], $arrayContract["vehicule_type"],null);
            }

            $contracts[] = new Contract(
                $arrayContract ["id"],
                $arrayContract["name"],
                null,
                $contractsPrices
            );
        }

        // Création de l'objet Insurance
        return new Insurance(
            $arrayInsurance["id"],  // ID de l'assurance
            $arrayInsurance["name"], // Nom de l'assurance
            $contracts  // Tableau des contrats associés
        );
    }







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
