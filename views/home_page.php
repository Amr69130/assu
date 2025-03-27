<?php
// Template de la route index
// URL : index.php?action=index

$title = "Bienvenue dans le Garage";
require_once("block/header.php");
?>

    <h1 class="text-center">Listes des Assurances</h1>
    <div class="d-flex flex-wrap justify-content-evenly">
        <?php foreach ($insurances as $insurance): ?>

                <div class="p-2">
                    <h2><?= $insurance->getName() ?></h2>
                </div>
    <div class="d-flex justify-content-between">
        <a class="btn btn-primary" href="index.php?action=detail&id=<?= $insurance->getId() ?>">DETAILS</a>
            </div>
        <?php endforeach; ?>
    </div>
<?php
require_once("block/footer.php");