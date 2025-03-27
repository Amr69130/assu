<?php
require_once(__DIR__ . "/vendor/autoload.php");

use App\Controller\HomeController;

//var_dump($_SERVER["REQUEST_URI"]);

$action = $_GET["action"] ?? 'homePage';


//if (isset($_GET['id'])) {
//    $id = intval($_GET['id']);
//} else {
//    $id = null;
//}

$id = intval($_GET['id'] ?? null);


//var_dump("Action",$action);

//Créer une route pour la page d'accueil
//afficher toutes les assurances
//  index.php?action=homePage
if($action == "homePage"){
    $homeController = new HomeController();
    $homeController->homePage();
}
// Créer une route pour les details
//  index.php?action=detail&id=1
elseif($action == "detail"){
    $homeController = new HomeController();
    $homeController->detailInsurance($id);
}
else{
    echo("Page INCONNUE");
}