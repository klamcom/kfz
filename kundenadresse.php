<?php
require "inc/db-connect.php"; 

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

$stmt = $pdo->prepare("SELECT * FROM kunden WHERE kundenNr = :id");
$stmt->bindParam(':id', $id, PDO::PARAM_INT);
$stmt->execute();

$kunde = $stmt->fetch(PDO::FETCH_ASSOC);

if ($kunde) {
    echo '<p>' . htmlspecialchars($kunde['vorname']) . ' ' . htmlspecialchars($kunde['nachname']) . '</p>';
    echo '<p>' . htmlspecialchars($kunde['strasse']) . '</p>';
    echo '<p>' . htmlspecialchars($kunde['plz']) . ' ' . htmlspecialchars($kunde['ort']) . '</p>';
} else {
    echo '<p>Keine Adresse gefunden.</p>';
}
?>