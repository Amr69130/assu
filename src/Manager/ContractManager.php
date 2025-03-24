<?php
namespace App\Manager;

class ContractManager extends DatabaseManager
{

    //crud
    public function createContract($name, $insuranceId)
    {
        $sql = "INSERT INTO contract (name, insurance_id) VALUES (:name, :insurance_id)";
        $query = $this->db->prepare($sql);
        $query->execute([
            'name' => $name,
            'insurance_id' => $insuranceId
        ]);
    }
    //select
    public function getContracts()
    {
        $sql = "SELECT * FROM contract";
        $query = $this->db->prepare($sql);
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