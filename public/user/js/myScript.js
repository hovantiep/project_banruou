$(document).ready(function () {
    $('.update-cart').click(function () {
        var rowId = $(this).attr('id');
        var qty = $(this).parent().parent().find('#qty').val();
        var token = $('form').find("input[name='_token']").val();
        var baseUrl = document.location.origin;
        var url = baseUrl + '/cap-nhat-hang/';
        $.ajax({
            url: url + rowId + '/' + qty,
            type: 'POST',
            case: false,
            data: {"_token": token, "rowId": rowId, "qty": qty},
            success: function (data) {
                if (data == "OK"){
                    window.location = baseUrl + '/gio-hang';
                }
            }
        });

    });
});