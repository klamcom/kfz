<?php
require "inc/db-connect.php"; // Stellen Sie sicher, dass diese Datei die PDO-Verbindung herstellt.

$kundenId = isset($_POST['kundenNr']) ? intval($_POST['kundenNr']) : 0;

try {
    // Verwendung eines Prepared Statement, um SQL-Injection zu verhindern
    $stmt = $pdo->prepare("SELECT kundenNr FROM kunden WHERE kundenNr = :id");
    $stmt->bindParam(':id', $kundenId, PDO::PARAM_INT); // Sicherstellen, dass die ID als Integer behandelt wird
    $stmt->execute();

    // Ergebnis auslesen, wenn vorhanden
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        echo $row['kundenNr'];
    } else {
        echo "Keine Daten gefunden";
    }
} catch (PDOException $e) {
    // Fehlerbehandlung
    echo "Datenbankfehler: " . $e->getMessage();
}

$conn = null; // Schließt die Verbindung
?>
