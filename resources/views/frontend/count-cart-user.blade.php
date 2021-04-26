@if ($data >= 1)
    <button type="button" id="clear-all" class="btn  btn-danger mr-lg-2" data-user_id="{{ Auth::user()['id'] }}">
        <span>Hapus Semua</span><i class="las la-trash-alt"></i>
    </button>
    <button type="submit" class="btn btn-primary" id="checkout">Checkout</button>
@endif

<script>
    $('#clear-all').click(function() {
        var user_id = $(this).data('user_id');

        $.ajax({
            data: {
                'user_id': user_id
            },
            url: "{{ route('cart.deleteAll') }}",
            type: "get",
            dataType: 'json',

            success: function(response) {

                if (response.success === true) {
                    swal("Sukses!", response.message, "success");
                    show();
                    count();
                    delcheck();
                }
            },
            error: function(data) {}

        });


        // localStorage.removeItem('cart');
        // toastr.success('Keranjang Berhasil Dikosongkan !');
        // loadkeranjang();
    });

    function show(params) {
        $.ajax({
            url: "{{ route('cart.check') }}",
            type: "get",
            success: function(response) {
                $('.list-cart').html(response);
            },
        });
    }

    function count() {
        $.ajax({
            url: "{{ route('cart.count') }}",
            type: "get",
            success: function(response) {
                $('.cart-wr').html(response);
            },
        });
    }

    function delcheck() {
        $.ajax({
            url: "{{ route('cart.user.count') }}",
            type: "get",
            success: function(response) {
                $('.count-user-cart').html(response);
            },
        });
    }

</script>
