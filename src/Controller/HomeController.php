<?php

namespace App\Controller;
use App\Manager\InsuranceManager;

class HomeController
{
    private InsuranceManager $insuranceManager;
    public function __construct()
    {
        // Quand on crée un IndexController
        // Il contiendra automatiquement un InsuranceManager
        // Utilisable avec $this->insuranceManager
        $this->insuranceManager = new InsuranceManager();
    }
    public function homePage(): void
    {
        //Récuperer les assurances
        $insurances = $this->insuranceManager->selectAll();
        require_once("views/home_page.php");
    }

    // Route DetailCar -> URL: index.php?action=detail&id=10
    public function detailInsurance(int $id): void
    {
        //Récuperer les assurances
        $insurance = $this->insuranceManager->selectById($id);
        if ($insurance !== false) {
            //Afficher les assurances dans la view
            require_once("./views/insurance/insurance_detail.php");
        } else {
            header("Location: index.php");
            exit();
        }
    }
}
