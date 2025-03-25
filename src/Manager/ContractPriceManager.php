<?php
namespace App\Manager;

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
        $sql = "SELECT * FROM contract_price";
        $query = self::getConnexion()->prepare($sql);
        $query->execute();
        $r = $query->fetchAll();
        ///new cONTRACT
        $contractPrices = [];
        foreach ($r as $contractPrice) {
            $contractPrices[] = new ContractPrice($contractPrice['id'], $contractPrice['price'], $contractPrice['contract_id']);
        }
        return $contractPrices;
    }
}