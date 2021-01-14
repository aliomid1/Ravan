
$(document).ready(function() {


if ($('#Alert-Message').data('type') == 'error') {
    toastr.error($('#Alert-Message').data('message'));
}
if ($('#Alert-Message').data('type') == 'success') {
    toastr.success($('#Alert-Message').data('message'));
}
if ($('#Alert-Message').data('type') == 'warning') {
    toastr.warning($('#Alert-Message').data('message'));
}
});