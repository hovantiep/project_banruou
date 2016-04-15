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
        $('#insert').append('<div class="form-group"><input type="file" name="fEditDetail[]" class="file" </div>');
    });
});

/**
 * Xóa hình ảnh sản phẩm ajax: product/edit
 */
$(document).ready(function () {
    $('a#del_img').on('click', function () {
        var url = 'http://project_laravel.local/admin/product/delImg/';
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














