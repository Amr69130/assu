<?php

namespace App\Controller;

use App\Manager\InsuranceManager;
use App\Model\Insurance;

class insuranceController
{
    private InsuranceManager $insuranceManager;

    public function __construct()
    {
        $this->insuranceManager = new InsuranceManager();
    }

    public function index(): void
    {
        $insurances = $this->insuranceManager->selectAll();
        require_once 'views/insurance_list.php';
    }

    public function insertInsurance(string $name): bool
    {
        return $this->insuranceManager->insert($name);
    }

    public function updateInsurance(int $id, string $name): bool
    {
        return $this->insuranceManager->update($id, $name);
    }

    public function delete(int $id): bool
    {
        return $this->insuranceManager->deleteInsurance($id);
    }
}
