<!DOCTYPE html>
<html lang="de">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Neue Rechnung</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">    
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<style>
    #kundenliste {
        max-width: 300px; 
        width: 100%; 
        overflow-x: auto; 
    }

    .abstand-oben {
    margin-top: 150px;
    }

    th, td {
        text-align: left;
        padding: 8px;
    }
    th {
        background-color: #f9f9f9;
    }
    .ui-sortable-placeholder {
        visibility: inherit !important;
        background: #eee !important;
    }

</style>


</head>
<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <input type="text" class="form-control" id="kundensuche" placeholder="Bitte einen Kundennamen eingeben!">
                <div id="kundenliste" class="list-group">
                    <!-- Kundenliste wird hier eingefügt -->
                </div>
            </div>
            <button id="createCustomer" class="btn btn-primary mt-3">Neuen Kunden erstellen</button>
            <div id="kundenadresse" class="mt-5">
                <!-- Kundenadresse wird hier eingefügt -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group abstand-oben">
                <label for="rechnungsdatum">Rechnungsdatum:</label>
                <input type="text" class="form-control" id="rechnungsdatum" placeholder="Datum wählen">
            </div>
            <div class="mt-3">
                <label>Rechnungsnummer:</label>
                <div id="rechnungsnummer" class="font-weight-bold">
                    <!-- Rechnungsnummer wird hier eingefügt -->
                </div>
            </div>
            <div class="mt-3">
                <label>Kundennummer:</label>
                <div id="kundennr" class="font-weight-bold">
                    <!-- Kundennummer wird hier eingefügt -->
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-5">
            <table id="rechnungspositionen" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Bezeichnung</th>
                        <th>Menge</th>
                        <th>Preis (€)</th>
                        <th>Summe (€)</th>
                        <th>Aktion</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td> <!-- Nicht editierbar -->
                        <td contenteditable="true">Beispielprodukt</td>
                        <td contenteditable="true">1</td>
                        <td contenteditable="true">100.00</td>
                        <td class="sum">100.00</td>
                        <td><button class="btn btn-danger deleteRow">Löschen</button></td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="6"><button id="addRow" class="btn btn-primary">Neue Zeile hinzufügen</button></td>
                    </tr>
                </tfoot>
            </table>
        </div>

    </div>
    
</div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    <script src="kundensuche.js"></script>
    <script src="positionen.js"></script>
</body>



</html>
