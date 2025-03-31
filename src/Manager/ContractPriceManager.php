<?php

namespace App\Manager;
use App\Model\Contract;
use App\Model\ContractPrice;
use App\Model\Insurance;

class ContractPriceManager extends DatabaseManager
{

    // Create a contract price
    public function createContractPrice($price, $contractId): void
    {
        $sql = "INSERT INTO contract_price (price, contract_id) VALUES (:price, :contract_id)";
        $query = self::getConnexion()->prepare($sql);
        $query->execute([
            'price' => $price,
            'contract_id' => $contractId
        ]);
    }

    //select contract price
    public function getContractPrices(): array
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

        $query = self::getConnexion()->prepare($sql);
        $query->execute();
        $r = $query->fetchAll();

        $contractPrices = [];
        foreach ($r as $contractPrice) {
            $insurance = new Insurance($contractPrice["insurance_id"], $contractPrice["insurance_name"]);
            $contract = new Contract($contractPrice['contract_id'], $contractPrice['contract_name'], $insurance, []);
            $contractPrices[] = new ContractPrice(
                $contractPrice['contract_price_id'],
                $contractPrice['price'],
                $contractPrice['vehicle_type'],
                $contract
            );
        }
        return $contractPrices;
    }

    // Select contractPrices by contract id
    public function selectByContractId(int $contractId): array
    {

        $sql = "SELECT * FROM insurance.contract_price WHERE contract_id = :contract_id";
        $query = self::getConnexion()->prepare($sql);
        $query->execute(['contract_id' => $contractId]);
        $arrayPrices = $query->fetchAll();
        $prices = [];
        foreach ($arrayPrices as $arrayPrice) {
            $prices[] = new ContractPrice($arrayPrice['id'], $arrayPrice['price'], $arrayPrice['vehicle_type'],null);
        }
        return $prices;
    }
}