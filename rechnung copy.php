<?php require "inc/db-connect.php"; ?>

<?php
if (isset($_GET['kundennr'])) {
    $kundennr = $_GET['kundennr'];
    $antwort = "Rechnung für Kundennr $kundennr wird erstellt.";
} else {
    $antwort = "Keine Kundennr angegeben.";
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Modal Formular Beispiel</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        $stmt = $pdo->prepare('SELECT * FROM kunden left join anrede on kunden.fkAnrede = anrede.id WHERE kundenNr = :kundennr');       
        $stmt->bindParam(':kundennr', $kundennr);
        $stmt->execute();  
    ?>
    
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <h2>Kunde</h2>
                    <p>Kundennummer: <?php echo $row['kundenNr']; ?></p>
                    <p>Anrede: <?php echo $row['anrede']; ?></p>
                    <p>Titel vor: <?php echo $row['titelvor']; ?></p>
                    <p>Nachname: <?php echo $row['nachname']; ?></p>
                    <p>Vorname: <?php echo $row['vorname']; ?></p>
                    <p>Titel nach: <?php echo $row['titelnach']; ?></p>
                    <p>Firma: <?php echo $row['firma']; ?></p>
                    <p>Strasse: <?php echo $row['strasse']; ?></p>
                    <p>PLZ: <?php echo $row['plz']; ?></p>
                    <p>Ort: <?php echo $row['ort']; ?></p>
                    <p>Telefon: <?php echo $row['telefon']; ?></p>
                    <p>Telefon 2: <?php echo $row['telefon2']; ?></p>
                    <p>E-Mail: <?php echo $row['mail']; ?></p>
                    <p>Kunde seit: <?php echo $row['kundeseit']; ?></p>
                    <p>Fax: <?php echo $row['fax']; ?></p>
                    <p>Kommentar: <?php echo $row['kommentar']; ?></p>
                </div>
            </div>
        </div>
    <?php } ?>


    <div class="container mt-5">
<div id="antwort">
    <?php echo $antwort; ?>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


</body>
</html>