$letzteRechnungsnummer = holeLetzteRechnungsnummerAusDatenbank(); 
$neueRechnungsnummer = $letzteRechnungsnummer + 1;

function holeLetzteRechnungsnummerAusDatenbank($pdo) {
    $sql = "SELECT rechnungsnummer FROM rechnungen ORDER BY rechnungsnummer DESC LIMIT 1";
    $stmt = $pdo->query($sql);
    $ergebnis = $stmt->fetch(PDO::FETCH_ASSOC);

    // Prüfe, ob ein Ergebnis zurückgegeben wurde
    if ($ergebnis) {
        return $ergebnis['rechnungsnummer'];
    } else {
        // Keine Rechnungen vorhanden, starte bei einer angenommenen Nummer oder bei 0
        return 0;
    }
}

try {
    // Ersetze die folgenden Werte mit deinen tatsächlichen Datenbank-Verbindungsinformationen
    $pdo = new PDO('mysql:host=deinHost;dbname=deineDatenbank', 'deinBenutzername', 'deinPasswort');
    
    // Hole die letzte Rechnungsnummer und generiere die neue Nummer
    $letzteRechnungsnummer = holeLetzteRechnungsnummerAusDatenbank($pdo);
    $neueRechnungsnummer = $letzteRechnungsnummer + 1;
    
    echo "Die neue Rechnungsnummer ist: " . $neueRechnungsnummer;
} catch (PDOException $e) {
    die("Verbindung fehlgeschlagen: " . $e->getMessage());
}
