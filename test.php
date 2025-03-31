<?php

$sql = "SELECT * FROM insurance";
$stmt = $pdo->query($sql);
$assurances = $stmt->fetchAll(PDO::FETCH_ASSOC);



$assuranceId = 1; // ID de l'assurance sélectionnée
$sql = "SELECT * FROM contract WHERE assurance_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$assuranceId]);
$contrats = $stmt->fetchAll(PDO::FETCH_ASSOC);



$contratId = 2; // ID du contrat sélectionné
$sql = "SELECT * FROM contract_price WHERE contrat_id = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$contratId]);
$prices = $stmt->fetchAll(PDO::FETCH_ASSOC);
