<?php
// Verbindung zur Datenbank herstellen
require "inc/db-connect.php";

// Suchbegriff aus der URL-Anfrage abrufen
$term = $_GET['term'] ?? '';

// SQL-Abfrage vorbereiten (inklusive JOIN, um den Steuersatz abzurufen)
$query = $pdo->prepare("SELECT el.id, el.bezeichnung, el.preis, s.steuersatz AS steuersatz FROM ersatzteil_leistung AS el LEFT JOIN steuersatz AS s ON el.fkSteuersatzID = s.steuersatzID WHERE el.bezeichnung LIKE :term LIMIT 10");

// SQL-Abfrage ausführen
$query->execute(['term' => "%" . $term . "%"]);

// Ergebnisse der Abfrage abrufen
$articles = $query->fetchAll(PDO::FETCH_ASSOC);

// Header für JSON-Daten setzen
header('Content-Type: application/json');

// Ergebnisse im JSON-Format zurückgeben
echo json_encode($articles);
?>

