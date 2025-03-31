<?php

namespace App\Manager;

use App\Model\Contract;

class ContractManager extends DatabaseManager
{

    //crud
    public function createContract($name, $insuranceId): array
    {
        $sql = "INSERT INTO contract (name, insurance_id) VALUES (:name, :insurance_id)";
        $query = self::getConnexion()->prepare($sql);
        $query->execute([
            'name' => $name,
            'insurance_id' => $insuranceId
        ]);
    }

    //select
    public function getContracts()
    {
        //  inner join id et price requette 
        $sql = "SELECT * FROM contract";
        $query = self::getConnexion()->prepare($sql);
        $query->execute();
        $r = $query->fetchAll();
        ///new cONTRACT
        $contracts = [];
        //Créer les contractPrice
        foreach ($r as $contract) {
            $contracts[] = new Contract($contract['id'], $contract['name'], $contract['insurance_id']);
        }
//        return $contracts;
    }

    // TODO Select contracts by assurance id
    public function getContractsByInsuranceId($insuranceId)
    {
        $sql = "SELECT * FROM contract WHERE insurance_id = :insurance_id";
        $query = self::getConnexion()->prepare($sql);
        $query->execute([
            'insurance_id' => $insuranceId
        ]);
        $r = $query->fetchAll();
        $contracts = [];
        foreach ($r as $contract) {
            $contracts[] = new Contract($contract['id'], $contract['name'], null,[]);
        }

        return $contracts;
    }

}
