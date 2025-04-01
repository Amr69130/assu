<?php
require_once(__DIR__ . "/vendor/autoload.php");

use App\Controller\HomeController;
use App\Controller\AuthController;
use App\Controller\SuperAdminController;
use App\Controller\AdminController;

$action = $_GET["action"] ?? 'homePage';
$id = intval($_GET['id'] ?? 0);

// Routes publiques
if ($action == "homePage") {
    $homeController = new HomeController();
    $homeController->homePage();
} elseif ($action == "detail") {
    $homeController = new HomeController();
    $homeController->detailInsurance($id);
}
// Routes d'authentification
elseif ($action == "login") {
    $authController = new AuthController();
    $authController->showLoginForm();
} elseif ($action == "login_process") {
    $authController = new AuthController();
    $authController->processLogin();
} elseif ($action == "logout") {
    $authController = new AuthController();
    $authController->logout();
}
// Routes SuperAdmin
elseif ($action == "superadmin") {
    $superAdminController = new SuperAdminController();
    $superAdminController->dashboard();
} elseif ($action == "create_insurance") {
    $superAdminController = new SuperAdminController();
    $superAdminController->createInsuranceForm();
} elseif ($action == "create_insurance_process") {
    $superAdminController = new SuperAdminController();
    $superAdminController->processCreateInsurance();
} elseif ($action == "edit_insurance") {
    $superAdminController = new SuperAdminController();
    $superAdminController->editInsuranceForm($id);
} elseif ($action == "edit_insurance_process") {
    $superAdminController = new SuperAdminController();
    $superAdminController->processEditInsurance($id);
} elseif ($action == "delete_insurance") {
    $superAdminController = new SuperAdminController();
    $superAdminController->deleteInsuranceForm($id);
} elseif ($action == "delete_insurance_process") {
    $superAdminController = new SuperAdminController();
    $superAdminController->processDeleteInsurance($id);
} elseif ($action == "create_user") {
    $superAdminController = new SuperAdminController();
    $superAdminController->createUserForm();
} elseif ($action == "create_user_process") {
    $superAdminController = new SuperAdminController();
    $superAdminController->processCreateUser();
}
// Routes Admin
elseif ($action == "admin") {
    $adminController = new AdminController();
    $adminController->dashboard();
} elseif ($action == "create_contract") {
    $adminController = new AdminController();
    $adminController->createContractForm();
} elseif ($action == "create_contract_process") {
    $adminController = new AdminController();
    $adminController->processCreateContract();
} elseif ($action == "create_price") {
    $contractId = intval($_GET['contract_id'] ?? 0);
    $adminController = new AdminController();
    $adminController->createPriceForm($contractId);
} elseif ($action == "create_price_process") {
    $contractId = intval($_GET['contract_id'] ?? 0);
    $adminController = new AdminController();
    $adminController->processCreatePrice($contractId);
}
// Route par défaut
else {
    echo ("Page INCONNUE");
}
































 //<?php
// require_once(__DIR__ . "/vendor/autoload.php");

// use App\Controller\HomeController;

// //var_dump($_SERVER["REQUEST_URI"]);

// $action = $_GET["action"] ?? 'homePage';


// //if (isset($_GET['id'])) {
// //    $id = intval($_GET['id']);
// //} else {
// //    $id = null;
// //}

// $id = intval($_GET['id'] ?? null);


// //var_dump("Action",$action);

// //Créer une route pour la page d'accueil
// //afficher toutes les assurances
// //  index.php?action=homePage
// if($action == "homePage"){
//     $homeController = new HomeController();
//     $homeController->homePage();
// }
// // Créer une route pour les details
// //  index.php?action=detail&id=1
// elseif($action == "detail"){
//     $homeController = new HomeController();
//     $homeController->detailInsurance($id);
// }
// else{
//     echo("Page INCONNUE");
// } -->