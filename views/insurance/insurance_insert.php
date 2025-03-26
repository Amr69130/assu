<?php
// Template de la route add
// URL : index.php?action=add

$title = "Ajouter une assurance";
require_once(__DIR__ . "/block/header.php");
?>
    <h1 class="text-success">Ajouter une assurance</h1>

    <form method="POST" action="index.php?action=add" class="m-5">

        <label for="model">Name</label>
        <input id="model" type="text" name="model" value="<?= $_POST['name'] ?? '' ?>">
        <?php if (isset($errors['name'])): ?>
            <p class="text-danger"><?= $errors['name'] ?></p>
        <?php endif; ?>

        <button class="btn btn-outline-success">Valider</button>

    </form>

<?php
require_once(__DIR__ . "/block/footer.php");
