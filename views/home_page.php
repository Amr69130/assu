<?php require_once 'bloc/header.php'; ?>

<div class="container mt-4">
    <h1>Contract List</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Contract Number</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contracts as $contract): ?>
                <tr>
                    <td><?= $contract->getId(); ?></td>
                    <td><?= $contract->getContractNumber(); ?></td>
                    <td><?= $contract->getStartDate(); ?></td>
                    <td><?= $contract->getEndDate(); ?></td>
                    <td>
                        <a href="/contract/edit/<?= $contract->getId(); ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="/contract/delete/<?= $contract->getId(); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php require_once 'bloc/footer.php'; ?>