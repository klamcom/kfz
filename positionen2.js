$(document).ready(function() {
    let count = 1;

    function initializeSortable() {
        $("#item_table tbody").sortable({
            handle: '.handle', // Optional: Falls Sie einen Griff zum Ziehen haben wollen
            update: function(event, ui) {
                updatePositionNumbers(); // Aktualisieren der Positionsnummern nach dem Sortieren
            }
        });
    }

    function addInputField() {
        const rowHtml = `<tr>
            <td class="handle">☰</td> <!-- Griff zum Ziehen -->
            <td class="col-1"><input type="text" name="posnr[]" class="form-control posnr" value="${count}" readonly /></td>
            <td class="col-5"><input type="text" name="artikel[]" class="form-control artikel" /></td>
            <td class="col-1"><input type="number" name="menge[]" class="form-control menge" /></td>
            <td class="col-1"><input type="text" name="preis[]" class="form-control preis" readonly /></td>
            <td class="col-2"><input type="text" name="gesamt[]" class="form-control gesamt" readonly /></td>
            <td class="col-2"><input type="text" name="steuer[]" class="form-control steuer" readonly /></td>
            <td class="col-2">${count > 0 ? '<button type="button" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button>' : ''}</td>
        </tr>`;

        const $row = $(rowHtml).appendTo('#item_table tbody');
        initializeSortable();
        applyAutocomplete($row.find('.artikel'));

        $row.find('.menge, .preis').on('change', function() {
            updateTotal($row);
        });

        count++;
    }

    function applyAutocomplete($input) {
        $input.autocomplete({
            source: function(request, response) {
                $.getJSON('get_articles2.php', { term: request.term }, function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: item.bezeichnung + ' - ' + item.preis + ' €' + ' - ' + item.steuersatz + '%',
                            value: item.bezeichnung,
                            price: item.preis,
                            steuer: item.steuersatz
                        };
                    }));
                });
            },
            minLength: 2,
            select: function(event, ui) {
                const $row = $(this).closest('tr');
                $row.find('.preis').val(ui.item.price);
                $row.find('.steuer').val(ui.item.steuer);
                updateTotal($row);
            }
        });
    }

    function updateTotal($row) {
        const quantity = $row.find('.menge').val();
        const price = $row.find('.preis').val();
        const total = quantity * price;
        $row.find('.gesamt').val(total.toFixed(2));
    }

    $('.add').on('click', function() {
        addInputField();
    });

    $(document).on('click', '.remove', function() {
        $(this).closest('tr').remove();
        updatePositionNumbers();
    });

    function updatePositionNumbers() {
        $('#item_table tbody tr').each(function(index) {
            $(this).find('.posnr').val(index + 1);
        });
        count = $('#item_table tbody tr').length + 1;
    }



    $('#insert_form').on('submit', function(event) {
        event.preventDefault();
        $.ajax({
            url: 'submit_endpoint.php',
            method: 'POST',
            data: $('#insert_form').serialize(),
            beforeSend: function() {
                $('#submit_button').prop('disabled', true);
            },
            complete: function() {
                $('#submit_button').prop('disabled', false);
            },
            success: function(data) {
                console.log('Success:', data);
                $('#error').html('<div class="alert alert-success">Success! Data submitted.</div>');
                $('#item_table tbody').empty();
                addInputField();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error:', textStatus, errorThrown);
                $('#error').html('<div class="alert alert-danger">Error submitting data.</div>');
            }
        });
    });
    initializeSortable();
});
