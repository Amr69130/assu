<?php

namespace App\Controller;

use App\Manager\ContractManager;
use App\Model\Contract;
class contractController
{
    private ContractManager $contractManager;
    public function __construct()
    {
        $this->contractManager = new ContractManager();
    }
    public function index(): void
    {
        $contracts = $this->contractManager->getContracts();
        require_once 'views/home_page.php';
    }

//    public function create($name, $insuranceId)
//    {
//        return $this->contractManager->createContract($name, $insuranceId);
//    }
//    public function update(arguments)
//     {
//         return $this->contractManager->updateContract(arguments);
//     }
//
//     public function delete(arguments)
//     {
//         return $this->contractManager->deleteContract($id);
}
