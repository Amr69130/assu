<?php
/**
 * @var Insurance $insurance
 */

$title = $insurance->getName() . " - Détails";
require_once __DIR__ . '/../../views/block/header.php';
$name = $insurance->getName();
$contracts = $insurance->getContracts();
?>

<div class="container mt-5">
    <!-- Titre principal -->
    <h1 class="text-center fw-bold" style="color: #f8c400;">Détails de l'Assurance - <?= htmlspecialchars($name) ?></h1>

    <div class="row justify-content-center mt-4">
        <?php foreach ($contracts as $contract): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg mb-4 border-2 border-warning rounded-3">
                    <div class="card-body bg-dark text-light">
                        <h5 class="card-title text-center text-uppercase fw-bold"><?= htmlspecialchars($contract->getName()) ?></h5>
                        <hr class="border-warning">

                        <!-- Tableau des prix -->
                        <h6 class="text-muted text-center">Tarifs :</h6>
                        <table class="table table-bordered text-light">
                            <thead class="table-dark">
                            <tr>
                                <th>Type de véhicule</th>
                                <th>Prix (€)</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($contract->getPrice() as $contractPrice): ?>
                                <tr>
                                    <td><?= htmlspecialchars($contractPrice->getVehicleType()) ?></td>
                                    <td><strong><?= htmlspecialchars($contractPrice->getPrice()) ?> €</strong></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Bouton retour -->
    <!-- Bouton retour -->
    <div class="text-center mt-4 mb-5">
        <a href="index.php" class="btn btn-custom">Retour à l'accueil</a>
    </div>

</div>

<?php require_once __DIR__ . '/../../views/block/footer.php'; ?>

<!-- Styles personnalisés -->
<style>
    /* Carte assurance */
    .card {
        transition: transform 0.3s ease-in-out;
    }

    .card:hover {
        transform: scale(1.05);
    }

    /* Bouton personnalisé */
    .btn-custom {
        background-color: #f8c400;
        color: #000;
        font-weight: bold;
        border-radius: 25px;
        padding: 10px 20px;
        transition: all 0.3s ease-in-out;
    }

    .btn-custom:hover {
        background-color: #ffd700;
        transform: scale(1.1);
    }
</style>
