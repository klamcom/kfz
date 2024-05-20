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
<!-- rechnung.php -->
<button id="loadKundenBtn">Neue Rechnung einfügen</button>
<div id="kundendatenContainer"></div>
<div id="fahrzeugeUndRechnungenContainer"></div>

<!-- Modal für neue Positionen -->
<div class="modal" id="addPositionModal">
  <!-- Modal-Content -->
  <form id="addPositionForm">
    <!-- Formularfelder für neue Position -->
    <button type="submit">Speichern</button>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<script>
// JQuery für den initialen Button, um Kundendaten zu laden
$('#loadKundenBtn').click(function() {
    $('#kundendatenContainer').load('kundendaten.php');
});

// Handler für das Einreichen neuer Positionen (Beispiel)
$('#addPositionForm').submit(function(e) {
    e.preventDefault();
    var formData = $(this).serialize();
    $.ajax({
        url: 'insert_position.php',
        type: 'POST',
        data: formData,
        success: function(result) {
            alert('Position hinzugefügt');
            // Modal schließen und Daten neu laden...
        }
    });
});
</script>
</body>
</html>
