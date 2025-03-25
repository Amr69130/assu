<?php
require_once(__DIR__ . "/vendor/autoload.php");

use App\Manager\InsuranceManager;

$title = "Bienvenue dans le comparateur des assurances";

require_once("templates/header.php");

$insuranceManager = new InsuranceManager();

var_dump($insuranceManager->getInsuranceById(1));

?>
<h1 class="text-center">Listes des Assurances</h1>


<?php
require_once("templates/footer.php");
?>