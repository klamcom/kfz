<?php
require "inc/db-connect.php"; 

$query = isset($_POST['query']) ? $_POST['query'] : '';

$stmt = $pdo->prepare("SELECT * FROM kunden WHERE nachname LIKE :query");

$suchenach = "%$query%";
$stmt->bindParam(':query', $suchenach, PDO::PARAM_STR);

$stmt->execute();

$ergebnis = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($ergebnis) {
    foreach ($ergebnis as $zeile) {
        echo '<a href="#" class="list-group-item list-group-item-action kunden" data-id="' . $zeile['kundenNr'] . '">' . htmlspecialchars($zeile['kundenNr']) . " " . htmlspecialchars($zeile['nachname']) . " " . htmlspecialchars($zeile['vorname']) . '</a>';    }
} else {
    echo '<p class="list-group-item">Kein Ergebnis gefunden</p>';
}
?>
