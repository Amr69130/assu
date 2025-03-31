<?php
//Template de la route detail
//URL : index.php?action=detail&id=1

$title = $insurance->getName() . " détails";
require_once __DIR__ . '/../../views/block/header.php';
$name = $insurance->getName();
$contracts = $insurance->getContracts();
?>

<div class="container mt-5">
    <h1 class="text-center text-primary">Détails de l'Assurance - <?= htmlspecialchars($name) ?></h1>

    <div class="row justify-content-center">
        <?php foreach ($contracts as $contract): ?>
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg mb-4">
                    <div class="card-body">
                        <h5 class="card-title text-center text-uppercase fw-bold"><?= htmlspecialchars($contract->getName()) ?></h5>
                        <hr>
                        <h6 class="text-muted">Tarifs :</h6>
                        <table class="table table-bordered">
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
                                    <td><?= htmlspecialchars($contractPrice->getPrice()) ?> €</td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
                        <div class="text-center">
                            <a href="index.php" class="btn btn-primary mt-2">Retour à l'accueil</a>
                        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../../views/block/footer.php'; ?>
