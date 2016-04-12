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
function confirmDel(msg){
    if(window.confirm(msg)){
        return true;
    }
    return false;
}