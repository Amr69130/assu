<?php

namespace App\Manager;

use App\Model\Contract;
use App\Model\ContractPrice;
use App\Model\Insurance;

class ContractPriceManager extends DatabaseManager
{
    //crud
    public function createContractPrice($price, $contractId)
    {
        $sql = "INSERT INTO contract_price (price, contract_id) VALUES (:price, :contract_id)";
        $query = self::getConnexion()->prepare($sql);
        $query->execute([
            'price' => $price,
            'contract_id' => $contractId
        ]);
    }
    //select
    public function getContractPrices()
    {
        $sql = "
            SELECT 
                cp.id AS contract_price_id, 
                cp.price, 
                cp.vehicle_type,
                c.id AS contract_id, 
                c.name AS contract_name, 
                i.id AS insurance_id, 
                i.name AS insurance_name
            FROM contract_price cp
            JOIN contract c ON cp.contract_id = c.id
            JOIN insurance i ON c.insurance_id = i.id
        ";


        // il join add contract et insurance 
        $query = self::getConnexion()->prepare($sql);
        $query->execute();
        $r = $query->fetchAll();
        ///new CONTRACT
        $contractPrices = [];
        foreach ($r as $contractPrice) {
            $insurance = new Insurance($contractPrice["insurance_id"], $contractPrice["insurance_name"]);
            $contract = new Contract($contractPrice['contract_id'], $contractPrice['contract_name'], $insurance);
            $contractPrices[] = new ContractPrice(
                $contractPrice['contract_price_id'],
                $contractPrice['price'],
                $contractPrice['vehicle_type'],
                $contract
            );
        }
        return $contractPrices;
    }
}
