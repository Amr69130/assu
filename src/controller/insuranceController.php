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
        $insurances = $this->insuranceManager->selectAll();
        require_once 'views/insurance_list.php';
    }

    public function insertInsurance(string $name)
    {
        return $this->insuranceManager->insert($name);
    }

    public function updateInsurance(int $id, string $name)
    {
        return $this->insuranceManager->update($id, $name);
    }

    public function delete(int $id)
    {
        return $this->insuranceManager->deleteInsurance($id);
    }
}
