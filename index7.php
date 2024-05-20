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
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select/dist/css/bootstrap-select.min.css">
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
            <div id="fahrzeugauswahl" class="form-group mt-3 d-none">
                <label for="fahrzeug">Fahrzeug:</label>
                <select id="fahrzeug" class="form-control">
                    <option value="">Bitte wählen...</option>
                </select>
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
            <form id="insert_form">
                <table class="table" id="item_table">
                    <thead>
                        <tr>
                            <th scope="col" class="col-1">#</th>
                            <th scope="col" class="col-1">Position</th>
                            <th scope="col" class="col-5">Artikelbezeichnung</th>
                            <th scope="col" class="col-1">Menge</th>
                            <th scope="col" class="col-1">Preis netto</th>
                            <th scope="col" class="col-1">Gesamt</th>
                            <th scope="col" class="col-1">Steuer</th>
                            <th scope="col" class="col-1">Aktion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Dynamic Rows will be inserted here -->
                    </tbody>
                </table>
                    <button type="button" class="btn btn-primary add">Position hinzufügen</button>
                    <button type="submit" class="btn btn-success" id="submit_button">Speichern</button>
                    <div id="error"></div>
            </form>
        </div>

    </div>
    
</div>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    
    <script src="kundensuche.js"></script>
    <script src="positionen2.js"></script>
</body>



</html>
