<?php
// Stelle sicher, dass 'inc/db-connect.php' den Code für die Datenbankverbindung enthält.
require 'inc/db-connect.php';

// Überprüfe, ob 'kundenNr' als Query-Parameter gesendet wurde
if (isset($_GET['kundenId'])) {
    $kundenId = htmlspecialchars($_GET['kundenId']);
} else {
    $kundenId = 'Unbekannt'; // oder leite zurück, oder zeige eine Fehlermeldung
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rechnung erstellen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">  
</head>
<body>
    <div class="container mt-5">
        <h2>Rechnung für Kunde Nr. <?php echo $kundenId; ?></h2>
        <!-- Weitere Logik zur Anzeige der Rechnungsinformationen oder zum Hinzufügen von Rechnungspositionen -->
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>
</html>