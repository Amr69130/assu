<?php
$title = "Bienvenue chez Assurance Auto";
require_once("block/header.php");
?>

<div class="container">
    <!-- Titre principal -->
    <h1 class="text-center mt-4 mb-5 fw-bold" style="color: #f8c400;">Nos Offres d'Assurance</h1>

    <!-- Conteneur des assurances -->
    <div class="row justify-content-center">
        <?php foreach ($insurances as $insurance): ?>
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg border-0 rounded-3 text-center p-4 bg-dark text-light">
                    <h2 class="mb-3"><?= $insurance->getName() ?></h2>
                    <a class="btn btn-custom w-100" href="index.php?action=detail&id=<?= $insurance->getId() ?>">Voir les détails</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once("block/footer.php"); ?>

<!-- Styles personnalisés -->
<style>
    /* Bouton personnalisé */
    .btn-custom {
        background-color: #f8c400;
        color: #000;
        font-weight: bold;
        border-radius: 25px;
        padding: 10px;
        transition: all 0.3s ease-in-out;
    }

    .btn-custom:hover {
        background-color: #ffd700;
        transform: scale(1.05);
    }

    /* Style des cartes */
    .card {
        transition: transform 0.3s ease-in-out;
        border: 2px solid #f8c400;
    }

    .card:hover {
        transform: scale(1.05);
    }
</style>
