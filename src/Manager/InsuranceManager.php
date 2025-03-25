<?php

namespace App\Manager;

use PDO;
use App\Entity\Insurance;

class InsuranceManager extends DatabaseManager
{
    public function getAllInsurances(): array
    {
        // Connexion a la bdd et sélectionner tous les assurances
        $requete = self::getConnexion()->prepare("SELECT * FROM insurance;");
        $requete->execute();
        $arrayInsurances = $requete->fetchAll();
        return $arrayInsurances;
    }

    public function getInsuranceById(int $id): array|false
    {
        $requete = self::getConnexion()->prepare("SELECT * FROM insurance WHERE id = :id;");
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
