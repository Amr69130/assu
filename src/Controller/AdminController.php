<?php

namespace App\Controller;

use App\Manager\ContractManager;
use App\Manager\ContractPriceManager;
use App\Manager\InsuranceManager;
use App\Model\Contract;
use App\Model\ContractPrice;

class AdminController
{
    private InsuranceManager $insuranceManager;
    private ContractManager $contractManager;
    private ContractPriceManager $contractPriceManager;
    private int $insuranceId;

    public function __construct()
    {
        $this->insuranceManager = new InsuranceManager();
        $this->contractManager = new ContractManager();
        $this->contractPriceManager = new ContractPriceManager();
        $this->checkAdminPermission();
    }

    private function checkAdminPermission(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'superadmin')) {
            header("Location: index.php?action=login");
            exit();
        }

        // Pour les admins, vérifier qu'ils accèdent uniquement à leur assurance
        if ($_SESSION['role'] === 'admin') {
            $this->insuranceId = $_SESSION['insurance_id'];
        } elseif (isset($_GET['insurance_id'])) {
            // Pour les superadmins, ils peuvent spécifier quelle assurance gérer
            $this->insuranceId = (int)$_GET['insurance_id'];
        } else {
            header("Location: index.php?action=superadmin");
            exit();
        }
    }

    public function dashboard(): void
    {
        $insurance = $this->insuranceManager->selectById($this->insuranceId);

        if (!$insurance) {
            header("Location: index.php");
            exit();
        }

        require_once("views/admin/dashboard.php");
    }

    // CRUD pour Contract
    public function createContractForm(): void
    {
        $insurance = $this->insuranceManager->selectById($this->insuranceId);

        if (!$insurance) {
            header("Location: index.php");
            exit();
        }

        require_once("views/admin/contract_form.php");
    }

    public function processCreateContract(): void
    {
        $errors = [];
        $insurance = $this->insuranceManager->selectById($this->insuranceId);

        if (!$insurance) {
            header("Location: index.php");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';

            if (empty($name)) {
                $errors['name'] = "Le nom du contrat est requis";
            }

            if (empty($errors)) {
                $this->contractManager->createContract($name, $this->insuranceId);
                header("Location: index.php?action=admin");
                exit();
            }
        }

        require_once("views/admin/contract_form.php");
    }

    // Ajoutez les méthodes pour modifier/supprimer les contrats

    // CRUD pour Contract Price
    public function createPriceForm(int $contractId): void
    {
        // Vérifier que le contrat appartient bien à l'assurance gérée par l'admin
        $contracts = $this->contractManager->getContractsByInsuranceId($this->insuranceId);
        $contractExists = false;

        foreach ($contracts as $contract) {
            if ($contract->getId() === $contractId) {
                $contractExists = true;
                break;
            }
        }

        if (!$contractExists) {
            header("Location: index.php?action=admin");
            exit();
        }

        require_once("views/admin/price_form.php");
    }

    public function processCreatePrice(int $contractId): void
    {
        // Validation similaire à createPriceForm
        $errors = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $vehicleType = $_POST['vehicle_type'] ?? '';
            $price = $_POST['price'] ?? '';

            if (empty($vehicleType)) {
                $errors['vehicle_type'] = "Le type de véhicule est requis";
            }

            if (empty($price) || !is_numeric($price) || $price <= 0) {
                $errors['price'] = "Le prix doit être un nombre positif";
            }

            if (empty($errors)) {
                // Insérer le prix dans la base de données
                // Cette méthode devrait être ajoutée à ContractPriceManager
                $this->contractPriceManager->createContractPrice($price, $contractId, $vehicleType);
                header("Location: index.php?action=admin");
                exit();
            }
        }

        require_once("views/admin/price_form.php");
    }

    // Ajoutez les méthodes pour modifier/supprimer les prix
}















// namespace App\Controller;

// use App\Manager\CarManager;
// use App\Manager\InsuranceManager;
// use App\Model\Car;
// use App\Model\Insurance;

//
/**
 * AdminController
 * Contient les routes pour gérer les Assurances en tant qu'admin
 */
// class AdminController
// {

    // private InsuranceManager $insuranceManager;

    // public function __construct()
    // {
    //     $this->insuranceManager = new InsuranceManager();
    // }

    // // Route DashboardAdmin ( ancien admin.php ) 
    // // URL : index.php?action=admin
    // public function dashboardAdmin()
    // {
    //     //Récuperer les assurances
    //     $insurance = $this->insuranceManager->selectAll();
    //     //Afficher les voitures dans la template
    //     require_once("./views/admin/index_admin.php");
    // }

    // // Route DashboardAdmin ( ancien add.php ) 
    // // URL : index.php?action=add
    // public function insert()
    // {
    //     $errors = [];
    //     // Si le formulaire est validé
    //     if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //         $errors = $this->validateInsuranceForm($errors, $_POST);

    //         if (empty($errors)) {
    //             //Instancier une objet Insurance avec les données du formulaire
    //             $insurance = new Insurance(null, $_POST["brand"], $_POST["model"], $_POST["horsePower"], $_POST["image"]);
    //             // Ajouter l'assurance en BDD  et rediriger
    //             $insuranceManager = new InsuranceManager();
    //             $insuranceManager->insert($insurance);
    //             $this->dashboardAdmin();
    //             exit();
    //         }
    //     }
    //     require_once("./views/insurance_insert.php");
    // }

    // Route EditCar ( ancien update.php ) 
    // URL : index.php?action=edit&id=1
    /* public function editCar(int $id)
    {
        $car = $this->carManager->selectByID($id); // Un seul connect DB par page

        //Vérifier si la voiture avec l'ID existe en BDD
        if (!$car) {

            header("Location: index.php?action=admin");
            exit();
        }

        $errors = [];
        // Si le formulaire est validé
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Vérifier les champs du formulaire
            $errors = $this->validateCarForm($errors, $_POST);
            // Si le formulaire n'a pas renvoyé d'erreurs
            if (empty($errors)) {

                // Mettre à jour la voiture $car et rediriger
                $car->setModel($_POST["model"]);
                $car->setBrand($_POST["brand"]);
                $car->setImage($_POST["image"]);
                $car->setHorsePower($_POST["horsePower"]);

                $this->carManager->update($car);

                header("Location: index.php?action=admin");
                exit();
            }
        }
        require_once("./templates/car_update.php");
    }*/

    // Route EditCar ( ancien update.php )
    // URL : index.php?action=edit&id=1
    // public function editInsurance($id)
    // {

    //     $insurance = $this->insuranceManager->selectByID($id); // Un seul connect DB par page

    //     //Vérifier si l'assurance avec l'ID existe en BDD
    //     if (!$insurance) {

    //         header("Location: index.php?action=admin");
    //         exit();
    //     }

    //     $errors = [];
    //     // Si le formulaire est validé
    //     if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //         // Vérifier les champs du formulaire
    //         $errors = $this->validateInsuranceForm($errors, $_POST);
    //         // Si le formulaire n'a pas renvoyé d'erreurs
    //         if (empty($errors)) {

    //             // Mettre à jour l'assurance $insurance et rediriger
    //             $insurance->setName($_POST["name"]);


    //             $this->insuranceManager->update($insurance);

    //             header("Location: index.php?action=admin");
    //             exit();
    //         }
    //     }
    //     require_once("./views/insurance_update.php");
    // }




    // Route Delete ( ancien delete.php ) 
    // URL : index.php?action=delete&id=1
//     public function deleteCar(int $id)
//     {
//         $car = $this->carManager->selectByID($id);

//         //Vérifier si la voiture avec l'ID existe en BDD
//         if (!$car) {

//             header("Location: index.php?action=admin");
//             exit();
//         }

//         //Si le form est validé
//         if ($_SERVER["REQUEST_METHOD"] == "POST") {
//             //Supprimer la voiture et rediriger
//             $this->carManager->deleteByID($car->getId());

//             header("Location: index.php?action=admin");
//             exit();
//         }

//         require_once("./templates/car_delete.php");
//     }


//     public function validateCarForm(array $errors, array $carForm): array
//     {
//         if (empty($carForm["model"])) {
//             $errors["model"] = "le modele de voiture est manquant";
//         }
//         if (empty($carForm["brand"])) {
//             $errors["brand"] = "la marque de la voiture est manquante";
//         }
//         if (empty($carForm["horsePower"])) {
//             $errors["horsePower"] = "la puissance du vehicule est manquante";
//         }
//         if (empty($carForm["image"])) {
//             $errors["image"] = "l'image de la voiture est manquante";
//         }
//         //Démo class CarFormValidator

//         return $errors;
//     }
// }