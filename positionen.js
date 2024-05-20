$(document).ready(function() {
    $('#rechnungsdatum').datepicker({
        dateFormat: 'dd.mm.yy'
    });

    $('#addRow').click(function() {
        const newRow = $('<tr>');
        newRow.append($('<td>').text($('#rechnungspositionen tbody tr').length + 1));
        newRow.append($('<td contenteditable="true">'));
        newRow.append($('<td contenteditable="true">'));
        newRow.append($('<td contenteditable="true">'));
        newRow.append($('<td class="sum">'));
        newRow.append($('<td>').append($('<button>').addClass('btn btn-danger deleteRow').text('Löschen')));
        $('#rechnungspositionen tbody').append(newRow);
    });

    $(document).on('click', '.deleteRow', function() {
        $(this).closest('tr').remove();
        renumberPositions();
    });

    function renumberPositions() {
        $('#rechnungspositionen tbody tr').each(function(index) {
            $(this).find('td:first').text(index + 1);
        });
    }

    $(document).on('input', 'td[contenteditable="true"]', function() {
        const row = $(this).closest('tr');
        const qty = parseFloat(row.children('td').eq(2).text()) || 0;
        const price = parseFloat(row.children('td').eq(3).text()) || 0;
        const sum = qty * price;
        row.children('td.sum').text(sum.toFixed(2));
    });

    $('#rechnungspositionen tbody').sortable({
        axis: 'y',
        containment: 'parent',
        update: function(event, ui) {
            renumberPositions();
        }
    });
});