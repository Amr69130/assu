<?php

namespace App\Manager;
use App\Model\Contract;

class ContractManager extends DatabaseManager
{
    //Create Contract
    public function createContract($name, $insuranceId): void
    {
        $sql = "INSERT INTO contract (name, insurance_id) VALUES (:name, :insurance_id)";
        $query = self::getConnexion()->prepare($sql);
        $query->execute([
            'name' => $name,
            'insurance_id' => $insuranceId
        ]);
    }

    //select Contract
    public function getContracts(): array
    {
        $sql = "SELECT * FROM contract";
        $query = self::getConnexion()->prepare($sql);
        $query->execute();
        $r = $query->fetchAll();
        ///new CONTRACT
        $contracts = [];
        //Créer les contractPrice
        foreach ($r as $contract) {
            $contracts[] = new Contract($contract['id'], $contract['name'], $contract['insurance_id'], []);
        }
        return $contracts;
    }

    // Select contracts by assurance id
    public function getContractsByInsuranceId($insuranceId): array
    {
        $sql = "SELECT * FROM contract WHERE insurance_id = :insurance_id";
        $query = self::getConnexion()->prepare($sql);
        $query->execute([
            'insurance_id' => $insuranceId
        ]);
        $r = $query->fetchAll();
        $contracts = [];
        foreach ($r as $contract) {
            $contracts[] = new Contract($contract['id'], $contract['name'], null, []);
        }

        return $contracts;
    }
}
