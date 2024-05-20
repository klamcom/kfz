<?php
require 'inc/db-connect.php';

// Prüfen, ob die Anfrage vom Typ POST ist
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Annahme, dass alle erforderlichen Felder gesendet wurden, validiere diese im realen Einsatz
    $lfdNr = $_POST['lfdNr'];
    $kunde = $_POST['kunde']; // Stelle sicher, dass du die Kundennummer korrekt extrahierst, wenn sie im Format 'id Vorname Nachname' gesendet wird
    $kennzeichen = $_POST['kennzeichen'];
    $marke = $_POST['marke'];
    $type = $_POST['type'];
    $baujahr = $_POST['baujahr'];
    $kmStand = $_POST['kmStand'];
    $kw = $_POST['kw'];
    $benzinDiesel = $_POST['BenzinDiesel'];
    $tueren = $_POST['tueren'];
    $kombi = $_POST['kombi'];
    $zulassung = $_POST['zulassung'];
    $erstzulassung = $_POST['erstzulassung'];
    $fahrgestellnummer = $_POST['fahrgestellnummer'];
    $motornummer = $_POST['motornummer'];
    $hubraum = $_POST['hubraum'];
    $fin = $_POST['fin'];

    // Vorbereiten des Update-Statements
    $sql = "UPDATE kfz SET 
                fkKundennummer = :kunde, 
                kennzeichen = :kennzeichen, 
                marke = :marke, 
                type = :type, 
                baujahr = :baujahr, 
                kmStand = :kmStand, 
                kw = :kw, 
                BenzinDiesel = :benzinDiesel, 
                tueren = :tueren, 
                kombi = :kombi, 
                zulassung = :zulassung, 
                erstzulassung = :erstzulassung, 
                fahrgestellnummer = :fahrgestellnummer, 
                motornummer = :motornummer, 
                hubraum = :hubraum, 
                fin = :fin
            WHERE lfdNr = :lfdNr";

    $stmt = $pdo->prepare($sql);

    // Binden der Werte an das Statement
    $stmt->bindParam(':lfdNr', $lfdNr);
    $stmt->bindParam(':kunde', $kunde);
    $stmt->bindParam(':kennzeichen', $kennzeichen);
    $stmt->bindParam(':marke', $marke);
    // Binden weiterer Parameter...
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':baujahr', $baujahr);
    $stmt->bindParam(':kmStand', $kmStand);
    $stmt->bindParam(':kw', $kw);
    $stmt->bindParam(':benzinDiesel', $benzinDiesel);
    $stmt->bindParam(':tueren', $tueren);
    $stmt->bindParam(':kombi', $kombi);
    $stmt->bindParam(':zulassung', $zulassung);
    $stmt->bindParam(':erstzulassung', $erstzulassung);
    $stmt->bindParam(':fahrgestellnummer', $fahrgestellnummer);
    $stmt->bindParam(':motornummer', $motornummer);
    $stmt->bindParam(':hubraum', $hubraum);
    $stmt->bindParam(':fin', $fin);

    // Ausführen des Update-Statements
    if($stmt->execute()){
        // Weiterleitung oder Erfolgsmeldung
        header('Location: index3.php');
        exit();
    } else {
        // Fehlerbehandlung
        echo "Ein Fehler ist aufgetreten.";
    }
}
?>
