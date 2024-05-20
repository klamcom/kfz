<?php
require 'inc/db-connect.php';

try {
    // Erstelle eine Abfrage, um alle Kundendaten zu holen
    $stmt = $pdo->query("SELECT kundenNr, vorname, nachname FROM kunden");
    $kunden = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Konnte keine Verbindung zur Datenbank herstellen: " . $e->getMessage());
}

// Überprüfe, ob Kundendaten vorhanden sind
if ($kunden) {
    echo "<ul>";
    foreach ($kunden as $kunde) {
        echo "<li>";
        echo "Kunde: " . htmlspecialchars($kunde['vorname']) . " " . htmlspecialchars($kunde['nachname']);
        // Button oder Link, der per AJAX die Kundendaten an rechnung.php sendet
        // Die 'data-kundenNr' wird verwendet, um die KundenNr per AJAX an rechnung.php zu senden
        echo " <button class='loadKundeBtn' data-kundenNr='" . htmlspecialchars($kunde['kundenNr']) . "'>Details</button>";
        echo "</li>";
    }
    echo "</ul>";
} else {
    echo "<p>Keine Kundendaten gefunden.</p>";
}
?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function() {
    $('.loadKundeBtn').click(function() {
        var kundenNr = $(this).data('kundennr');
        $.ajax({
            url: 'rechnung.php', // Oder ein anderes Script, das die Daten verarbeitet
            type: 'POST',
            data: { kundenNr: kundenNr },
            success: function(response) {
                // Hier musst du entscheiden, wie du die Antwort verarbeiten möchtest.
                // Zum Beispiel könntest du die Antwort in einem bestimmten <div> auf rechnung.php anzeigen.
                $('#kundendatenContainer').html(response);
            }
        });
    });
});
</script>
