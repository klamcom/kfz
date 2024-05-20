$(document).ready(function() {
    let count = 1;

    function addInputField() {
        const rowHtml = `<tr>
            <td class="col-1"><input type="text" name="posnr[]" class="form-control posnr" value="${count}" readonly /></td>
            <td class="col-5"><select name="artikel[]" class="form-control artikel"></select></td>
            <td class="col-1"><input type="number" name="menge[]" class="form-control menge" /></td>
            <td class="col-1"><input type="text" name="preis[]" class="form-control preis" readonly /></td>
            <td class="col-2"><input type="text" name="gesamt[]" class="form-control gesamt" readonly /></td>
            <td class="col-2">${count > 1 ? '<button type="button" class="btn btn-danger btn-sm remove"><i class="fas fa-minus"></i></button>' : ''}</td>
        </tr>`;
        
        const $row = $(rowHtml).appendTo('#item_table tbody');
        populateDropdown($row.find('.artikel'));

        $row.find('.menge, .preis').on('change', function() {
            updateTotal($row);
        });

        count++;
    }

    function populateDropdown($select) {
        $.ajax({
            url: 'get_articles.php',
            method: 'GET',
            success: function(html) {
                $select.html(html);
            },
            error: function() {
                console.error('Failed to fetch articles');
                $select.html('<option value="">Error loading articles</option>');
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

    $('#item_table').on('change', '.artikel', function() {
        const price = $(this).find('option:selected').data('preis');
        $(this).closest('tr').find('.preis').val(price);
        const steuer = $(this).find('option:selected').data('steuer');
        $(this).closest('tr').find('.steuer').val(steuer);
        updateTotal($(this).closest('tr'));
    });

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
});
