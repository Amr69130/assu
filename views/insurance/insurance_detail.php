<?php
//Template de la route detail
//URL : index.php?action=detail&id=1

$title = $insurance->getName() . " détails";
require_once __DIR__ . '/../../views/block/header.php';
$name = $insurance->getName();
$contracts = $insurance->getContracts();
?>
<h1 class="text-center">DETAILS DE L'ASSU SA MERE</h1>
    <?=var_dump($insurance);
   ?>

        <div class="col-4 d-flex p-3 justify-content-center">
            <div class="p-2">

                <p></p>
                <h2><?php echo $name ?></h2>

                <?php foreach ($contracts as $contract): ?>
                    <p>Contrat : <?=($contract->getName()) ?> </p>
                <?php endforeach; ?>

                <a class="btn btn-primary" href="index.php">RETOUR ACCUEIL</a>





            </div>
        </div>
<?php
require_once __DIR__ . '/../../views/block/footer.php';
