@php
    $total = 0;
@endphp
    <tr>
        <td>#</td>
        <td>Kode</td>
        <td>Harga</td>
        <td>Quantity</td>
        <td>Total</td>
        <td>Aksi</td>
    </tr>

@foreach($data['cart'] as $key =>  $val)
@php
    $total += $val['harga'];
@endphp
    <tr>
        <td>
            <input type="checkbox" name="id[]" id="id[]" value="{{ $val['id'] }}" checked>
            <input type="hidden" name="user_id[]" value="{{ $val['user_id'] }}" >
        </td>
        <td>
            <span class="produk-text">{{ $val['kode'] }}</span>
        </td>
        <td>
            <span>
                Rp. {{ number_format(($val['harga'] ), 0, ',', '.') }}
            </span>
        </td>
        <td>
            <input type="text" pattern="[0-9]" min="1" id="qty[]" name="qty[]" value="{{ $val['qty'] }}"
            data-id="{{ $val['id'] }}">
        </td>
        <td id="total">
                Rp. {{ number_format(($val['total'] ), 0, ',', '.') }}
        </td>
        <td>
            <a href="javascript:;" class="delete-cart" data-id="{{ $val['id'] }}">
                <i class="fa fa-trash"></i>
            </a>
        </td>
    </tr>

@endforeach

@if(count($data['cart']) > 0)
<ul class="list-group">
<li class="list-group-item d-flex justify-content-between align-items-center">
    <span>TOTAL</span>
    <span style="padding-right:24px;">Rp. {{ number_format(($total ), 0, ',', '.') }}</span>							
</ul>
@endif

<script>
		$(document).ready(function() {


			$('[id^=qty]').bind('keyup',function () {
                var id     = $(this).data('id');
                var qty    = $(this).val();


                if(qty != ''){
                    $.ajax({
                        data: {'id':id,'qty':qty},
                        url: "{{ route('cart.updateQty') }}",
                        type: "POST",
                        dataType: 'json',
                        success: function(response){
                            
                            show();
                            
                            

                            setTimeout(() => {
                                window.location.reload;
                            }, 2000);

                        },
                        
				    });
                }

			});

           
		
        });

        function show(params) {
            $.ajax({
                url: "{{ route('cart.check') }}",
                type: "get",
                success: function(response){
                    $('.list-cart').html(response);
                },
            });
        }

</script>

