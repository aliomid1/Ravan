$.ajaxSetup({

    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.sendcode').click(function () {
    var item = $(this);
    var email = $('.emailuser').val();
    var url = $(this).data('url');
    item.attr('disabled', 'disabled');
    item.html('<span class="spinner-grow spinner-grow-sm m-l-5" role="status" aria-hidden="true"></span>   در حال ارسال ...')
    $.ajax({
        type: "POST",
        url: url,
        data: {
            email: email
        },
        success: function (res) {

            if (res == true) {
                item.html('ارسال کد تایید');
                item.removeAttr('disabled', 'disabled');
                $('.sendcode').text('ارسال مجدد کد ');
                $('.verify').fadeIn();
                $('.checkcode').fadeIn();

            } else {
                toastr.warning(res);
                item.html('ارسال کد تایید');
                item.removeAttr('disabled', 'disabled');
                $('.verify').hide();
                $('.checkcode').hide();
                $('.sendcode').fadeIn();
            }
        }
    });
});



$('.checkcode').click(function () {
    var code = $('.codevv').val();
    var url = $(this).data('url');
    $.ajax({
        type: "POST",
        url: url,
        data: {
            code: code
        },
        success: function (res) {

            if (res == true) {
                location.reload()
            } else {
                toastr.warning(res);
            }
        }
    });
});
