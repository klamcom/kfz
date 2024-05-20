<?php
require "inc/db-connect.php";  

try {
    $stmt = $pdo->prepare("SELECT MAX(rechnr) AS max_rechnungsnummer FROM rechnung");
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $nextRechnungsnummer = $row ? (int) $row['max_rechnungsnummer'] + 1 : 1;

    echo $nextRechnungsnummer; 
} catch (PDOException $e) {
    echo "Datenbankfehler: " . $e->getMessage();
    exit;
}

$pdo = null; 
?>
