<?php

namespace App\Manager;
use App\Model\Insurance;
use App\Model\Contract;

class InsuranceManager extends DatabaseManager
{
    //  select all insurances and all contracts
    public function selectAll(): array
    {
        // Connexion à la bdd et sélectionner toutes les assurances
        $requete = self::getConnexion()->prepare(
            "SELECT 
                i.id, 
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
        // crée des objets
        $insurances = [];
        foreach ($arrayInsurances as $arrayInsurance) {
            //instancier un objet insurance avec les données du tableau associatif
            $insurances[] = new Insurance($arrayInsurance["id"], $arrayInsurance["name"]);
        }
        return $insurances;
    }

    //  Select insurance by id
    public function selectById(int $id): Insurance|false
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
         // Select contracts by assurance id
        $contracts = $contractManager->getContractsByInsuranceId($id);

//        var_dump($contracts);

        // Initialisation des tableaux pour stocker les contrats

        /**
         * @var Contract $contract
         */
            foreach ($contracts as $contract) {
                // Select contractPrices by ContractID id
                $contractPrices = $contractPriceManager->selectByContractId($contract->getId());
                $contract->setPrices($contractPrices);
            }

        // Création de l'objet Insurance
        return new Insurance(
            $arrayInsurance["id"],  // ID de l'assurance
            $arrayInsurance["name"], // Nom de l'assurance
            $contracts  // Tableau des contrats associés
        );
    }

    // Add insurance
    public function insert(string $name): bool
    {
        $requete = self::getConnexion()->prepare("INSERT INTO insurance (name) VALUES(:name);");
        $requete->execute([
            ":name" => $name
        ]);
        return $requete->rowCount() > 0;
    }

    // Update insurance
    public function update(int $id, string $name): bool
    {
        $requete = self::getConnexion()->prepare("UPDATE insurance SET name = :name WHERE id = :id;");
        return $requete->execute(['id' => $id, 'name' => $name]);
    }

    //  Delete insurance
    public function deleteInsurance(int $id): bool
    {
        $requete = self::getConnexion()->prepare("DELETE FROM insurance WHERE id = :id;");
        return $requete->execute(['id' => $id]);
    }
}