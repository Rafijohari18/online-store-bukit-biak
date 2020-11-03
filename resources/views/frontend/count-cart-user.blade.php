@if($data > 0)
    <button type="button" class="btn clear-all btn-danger mr-lg-2" data-dismiss="modal" data-user_id="{{ Auth::user()['id'] }}">
        <span>Hapus Semua</span><i class="las la-trash-alt"></i>
    </button>
    <button type="submit" class="btn btn-primary" id="checkout">Checkout</button>
@endif