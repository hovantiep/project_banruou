/**
 * Page-Level Demo Scripts - Tables - Use for reference
 */

$(document).ready(function () {
    $('#dataTables-example').DataTable({
        responsive: true
    });
});

/**
 * Tắt arlet
 */
$('div.alert').delay(3000).slideUp();
/**
 * Xác nhận xóa
 */
function confirmDel(msg) {
    if (window.confirm(msg)) {
        return true;
    }
    return false;
}
/**
 * Thêm hình ảnh cho sản phẩm: product/edit
 */
$(document).ready(function () {
    $('#addImages').click(function () {
        $('#insert').append('<div class="form-group"><input type="file" name="fEditDetail[]" class="file" multiple></div>');
    });
});

/**
 * Xóa hình ảnh sản phẩm ajax: product/edit
 */
$(document).ready(function () {
    $('a#del_img').on('click', function () {

        // var host = window.location.host;  // Lay host
        // var base_url = window.location.origin; // Lay duong dan
        // var pathArray = window.location.pathname.split( '/' ); // Lay duong dan thu muc den file

        // var url = document.location.origin + '/admin/product/delImg/'; // Truong hop sai duong dan thi dung
        // var url = base_url + '/' + pathArray[1] + '/' + pathArray[2] + '/admin/product/delImg/';
        //
        var full_url = window.location.href;
        var url = full_url.replace(/[a-z]*\/\d/,'delImg/');

        var _token = $("form[name=frmEditProduct]").find('input[name=_token]').attr('value');
        var src = $(this).parent().find('img').attr('src');
        var idImg = $(this).parent().find('img').attr('id');
        var groupId = $(this).parent().attr('id');
        $.ajax({
                url: url + idImg,
                type: 'GET',
                cache: false,
                data: {"_token": _token, "idImg": idImg, "urlImg": src},
                success: function (data) {
                    if (data == "OK") {
                        $('#' + groupId).remove();
                    } else {
                        alert("Error!");
                    }
                }
            }
        )
        ;
    });
});














