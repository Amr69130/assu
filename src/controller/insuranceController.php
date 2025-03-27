<?php

namespace App\Controller;

use App\Manager\InsuranceManager;
use App\Model\Insurance;

class InsuranceController
{
    private $insuranceManager;

    public function __construct()
    {
        $this->insuranceManager = new InsuranceManager();
    }

    public function index()
    {
        $insurances = $this->insuranceManager->getAllInsurances();
        require_once 'views/insurance_list.php';
    }

    // public function create($data)
    // {
    //     return $this->insuranceManager->createInsurance($data);
    // }

    // public function update($id, $data)
    // {
    //     return $this->insuranceManager->updateInsurance($id, $data);
    // }

    // public function delete($id)
    // {
    //     return $this->insuranceManager->deleteInsurance($id);
    // }
}
