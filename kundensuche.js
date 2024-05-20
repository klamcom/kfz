$(document).ready(function() {
    $('#kundensuche').keyup(function() {
        var sucheText = $(this).val();
        if (sucheText.length > 0) {
            $.ajax({
                url: 'kundensuche.php',
                method: 'POST',
                data: { query: sucheText },
                success: function(response) {
                    $('#kundenliste').html(response);
                }
            });
        } else {
            $('#kundenliste').html('');
        }
    });

    $('#kundenliste').on('click', '.kunden', function() {
        var kundenNr = $(this).data('id');
        $.ajax({
            url: 'kundenadresse.php',
            method: 'POST',
            data: { id: kundenNr },
            success: function(response) {
                $('#kundenadresse').html(response);
                $('#kundensuche').val('');
                $('#kundenliste').html('');
                $('#kundennr').text(kundenNr); 

                rechnungsnummer(); 
                ladeFahrzeuge(kundenNr); // Laden der Fahrzeuge für den ausgewählten Kunden
            }
        });
    });

    function ladeFahrzeuge(kundenNr) {
        $.ajax({
            url: 'get_fahrzeuge.php',
            method: 'POST',
            data: { kunde_id: kundenNr },
            dataType: 'json',  // Ensures that jQuery will parse the response as JSON
            success: function(data) {
                console.log(data);  // Good for debugging
        
                $('#fahrzeug').empty().append('<option value="">Bitte wählen...</option>');
                if (Array.isArray(data)) {  // Checking if data is an array
                    data.forEach(function(fahrzeug) {
                        var optionText = fahrzeug.marke + ' ' + fahrzeug.type + ' (' + fahrzeug.kennzeichen + ')';
                        var optionValue = fahrzeug.lfNr; // oder ein anderes eindeutiges Feld, falls lfNr nicht korrekt ist
                        $('#fahrzeug').append(new Option(optionText, optionValue));
                    });  
                } 

                $('#fahrzeugauswahl').removeClass('d-none');  // Show vehicle selection
            },
            
            error: function(xhr) {
                console.error("Error loading vehicles:", xhr.responseText);
                alert('Fahrzeugdaten konnten nicht geladen werden.');
            }
        });
        
    }



    function rechnungsnummer() {
        $.ajax({
            url: 'rechnungsnummer.php',  
            method: 'GET',  
            success: function(response) {
                $('#rechnungsnummer').text(response); 
            },
            error: function(xhr, status, error) {
                console.error("Fehler beim Abrufen der Rechnungsnummer: " + error);
            }
        });
    }
    
    $('#rechnungsdatum').datepicker({
        dateFormat: 'dd.mm.yy' 
    });

    
    
    

    

});

