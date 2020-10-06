@php
    $total = 0;
@endphp

@foreach($data['cart'] as $key =>  $val)

<li class="list-group-item d-flex justify-content-between align-items-center">
    <input type="checkbox" name="id[]" value="{{ $val['id'] }}">
    <input type="hidden" name="user_id[]" value="{{ $val['user_id'] }}" >
    
    <span class="produk-text">{{ $val['kode'] }}</span>
    <span>Rp. {{ number_format(($val['harga'] ), 0, ',', '.') }}</span>
    @php
        $total += $val['harga'];
    @endphp

    <a href="javascript:;" class="delete-cart" data-id="{{ $val['id'] }}">
        <i class="fa fa-trash"></i>
    </a>
</li>

@endforeach
@if(count($data['cart']) > 0)
<ul class="list-group">
<li class="list-group-item d-flex justify-content-between align-items-center">
    <span>TOTAL</span>
    <span style="padding-right:24px;">Rp. {{ number_format(($total ), 0, ',', '.') }}</span>							
</ul>
@endif
