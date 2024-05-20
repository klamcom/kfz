$(document).ready(function() {
    $('#customerSearch').keyup(function() {
        var searchText = $(this).val();
        if (searchText.length > 0) {
            $.ajax({
                url: 'search-customers.php',
                method: 'POST',
                data: { query: searchText },
                success: function(response) {
                    $('#kundenliste').html(response);
                }
            });
        } else {
            $('#kundenliste').html('');
        }
    });

    // Event delegation to handle clicks on dynamically generated customer names
    $('#kundenliste').on('click', '.customer-item', function() {
        var kundenNr = $(this).data('id');
        $.ajax({
            url: 'get-customer-address.php',
            method: 'POST',
            data: { id: kundenNr },
            success: function(response) {
                $('#customerAddress').html(response);
            }
        });
    });
});

