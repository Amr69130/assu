<?php
require_once(__DIR__ . "/vendor/autoload.php");

use App\Controller\HomeController;

var_dump($_SERVER["REQUEST_URI"]);

$action = $_GET["action"] ?? 'homePage';

var_dump("Action",$action);

//Créer une route pour la page d'accueil
//afficher toutes les assurances
//  index.php?action=homePage
if($action == "homePage"){
    $homeController = new HomeController();
    $homeController->homePage();
}
// Créer une route...
//  index.php?action=page23
// elseif($action == "page23"){
//     $homeController = new HomeController();
//     $homeController->homePage();
// }
else{
    echo("Page INCONNUE");
}