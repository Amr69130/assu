<?php

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