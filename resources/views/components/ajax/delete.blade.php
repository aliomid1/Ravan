<script>
    $(document).ready(function() {
        $('.delete').click(function(e) {
            var id = $(this).data('id');
            var url = $(this).data('url');
            var type = $(this).data('type');
            var item = $(this).data('item');
            var parent = $(this).data('parent');
            var typesend1 = $(this).data('typesend');
            var typesend = "DELETE";
            var html = $(this);
            if (type == 'item') {
                typesend = 'POST';
            }
            if (typesend1) {
                typesend = typesend1
            }
            swal({
                    title: "آیا اطمینان دارید؟",
                    text: "پس از حذف قادر به بازیابی این " + item + "  نخواهید بود!",
                    icon: "warning",
                    buttons: {
                        confirm: 'بله',
                        cancel: 'خیر'
                    },
                    dangerMode: true
                })
                .then(function(willDelete) {
                    if (willDelete) {          
                        $.ajax({
                            type: typesend,
                            url: url,
                            data: {
                                id: id
                            },
                            success: function(response) {
                                if (response == true) {
                                    toastr.success('' + item + ' حذف شد');
                                    if (type == 'table') {
                                        html.parents('tr').fadeOut();
                                    }
                                    if (type == 'item') {
                                        html.parents(parent).fadeOut();
                                    }
                                } else {
                                    toastr.error(response);

                                }
                            }
                        });
                    }
                });

        });
    });

</script>
