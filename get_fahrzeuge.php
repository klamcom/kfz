<?php
require "inc/db-connect.php"; // Inkludieren der Datenbankverbindung

header('Content-Type: application/json');

if (isset($_POST['kunde_id'])) {
    $kundeId = $_POST['kunde_id'];

    try {
        // Vorbereiten der SQL-Abfrage
        $stmt = $pdo->prepare("SELECT kfz.lfdNr, kfz.marke, kfz.type, kfz.kennzeichen FROM kfz
                               JOIN kunden ON kfz.fkKundennummer = kunden.kundenNr
                               WHERE kunden.kundenNr = :kunde_id");
        $stmt->bindParam(':kunde_id', $kundeId, PDO::PARAM_INT);
        $stmt->execute();

        $fahrzeuge = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Die Fahrzeugdaten als JSON-Antwort zurückgeben
        echo json_encode($fahrzeuge);
    } catch(PDOException $e) {
        // Senden einer Fehlermeldung im Falle eines SQL-Fehlers
        http_response_code(500);
        echo json_encode(['error' => "Datenbankfehler: " . $e->getMessage()]);
    }
} else {
    // Senden einer Fehlermeldung, falls keine Kunden-ID übermittelt wurde
    http_response_code(400);
    echo json_encode(['error' => 'Keine Kunden-ID angegeben']);
}
?>

