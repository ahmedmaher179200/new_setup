<script>
    $(document).on("click",".fire-popup", function(){	
        var url = $(this).attr('data-url');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $.ajax({
            async: false,
            method: "get",
            url: url,
            data: {
                // product_id: product_id,
            },
        success: function (data) {
            $('.my-popup .modal-title').html(data.title);
            $('.my-popup .modal-body').html(data.body);
        },
        error: function (data) {
            alert('false');
        }
        });
    })

    $(document).on("click",".delete-popup", function(){	
        var delete_url = $(this).attr('data-url');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $.ajax({
            async: false,
            method: "get",
            url: "{{route('DeletePopup')}}",
            data: {
                delete_url: delete_url,
            },
        success: function (data) {
            $('.my-popup .modal-title').html(data.title);
            $('.my-popup .modal-body').html(data.body);
        },
        error: function (data) {
            alert('false');
        }
        });
    })
</script>