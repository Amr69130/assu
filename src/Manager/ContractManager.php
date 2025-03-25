<?php

namespace App\Manager;

use App\Model\Contract;

class ContractManager extends DatabaseManager
{

    //crud
    public function createContract($name, $insuranceId)
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
        foreach ($r as $contract) {
            $contracts[] = new Contract($contract['id'], $contract['name'], $contract['insurance_id']);
        }
        return $contracts;
    }
}
