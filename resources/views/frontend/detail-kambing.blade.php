@extends('layouts.frontend')

@section('title','Detail Kambing')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<style>
@media screen and (max-width: 991.98px){
    .product-summary .box-info-price .box-btn > * {
        min-width: 50%;
        border-radius: 0;
    }
    /* .product-summary .box-info-price .box-btn .btn.orange {
        width: 100%;
        border-radius: 0;
    }
    .product-summary .box-info-price .box-btn .btn.green {
        width: 50%;
        border-radius: 0;
    } */
    .product-summary .box-info-price .box-btn {
        position: fixed;
        width: 100%;
        bottom: 0;
        left: 0;
        z-index: 1005;
        display: flex;
    }

}
    .product-summary .box-info-price .box-btn {
        display: flex;
    }
    @media screen and (max-width: 480px){
        .title-heading h1 {
            font-size: 28px;
        }
    }

    input[type="number"] {
        -webkit-appearance: textfield;
        -moz-appearance: textfield;
        appearance: textfield;
    }
    input[type=number]::-webkit-inner-spin-button, 
    input[type=number]::-webkit-outer-spin-button { 
        -webkit-appearance: none;
    }
    .number-input button {
        -webkit-appearance: none;
        background-color: transparent;
        border: none;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        margin: 0;
        position: relative;
    }
    .number-input button:before,
    .number-input button:after {
        display: inline-block;
        position: absolute;
        content: '';
        height: 2px;
        transform: translate(-50%, -50%);
    }
    .number-input button.plus:after {
        transform: translate(-50%, -50%) rotate(90deg);
    }
    .number-input input[type=number] {
        text-align: center;
    }


    .md-number-input.number-input {
        border: 2px solid black;
        width: 9rem;
        height: 2rem;
    }
    .md-number-input.number-input button {
        outline: none;
        width: 2rem;
        padding-top: .8rem;
    }
    .md-number-input.number-input button.minus {
        padding-left: 8px;
        bottom: 5px;
    }
    .md-number-input.number-input button.plus {
        bottom: 5px;
    }
    .md-number-input.number-input button:before,
    .md-number-input.number-input button:after {
        width: 1rem;
        background-color: #212121;
    }

    .md-number-input.number-input input[type=number] {
        max-width: 4rem;
        padding: .5rem;
        border: solid #ddd;
        border-width: 0 2px;
        font-size: 15px;
        height: 1.7rem;
        font-weight: bold;
        outline: none;
    }
   
    @media not all and (min-resolution:.001dpcm)
    { @supports (-webkit-appearance:none) and (stroke-color:transparent) {
    .number-input.md-number-input.safari_only button:before, 
    .number-input.md-number-input.safari_only button:after {
        margin-top: -.6rem;
    }
    }}
</style>

@endsection

@section('content')
<div class="content-msp">
        <div class="product-banner">
            <div class="container msp blog">
                <div class="breadcrumb-toolbar">
                    <nav class="breadcrumb">
                        <ul class="breadcrumb-list">
                            <li>
                                <a href="">
                                    Home
                                </a>
                            </li>

                            <li class="current">
                                Kambing {{ $data['kambing']['kode'] }}
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container">
                <div class="row">
                    <div class="col-lg-6 ">
                        <img src="{{ $data['kambing']['photo'] != null ? 'https://apps.bukitbiak.com/'.$data['kambing']['photo'][0] : asset('assets/temp_frontend/images/default.png') }}" class="photo-kambing">
                    </div>
                    <div class="col-lg-6">
                        <div class="product-summary">
                            <div class="box-category">
                                {{ $data['kambing']['jenis'] }}

                            </div>

                            <div class="title-heading">
                                <h2>{{ $data['kambing']['kode'] }}</h2>
                            </div>

                            <div class="box-description">
                                <article class="content">
                                    <p>Bobot : {{ $data['kambing']['bobot'] }} KG </p>
                                    <p>Umur : {{ $data['kambing']['umur'] }} Bulan </p>
                                    <p>Unggulan : {{ $data['kambing']['unggulan'] == 1 ? 'Ya' : 'Tidak' }}</p>
                                    <p>Jenis Kelamin : {{ $data['kambing']['kelamin'] == 1 ? 'Jantan' : 'Betina' }}</p>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <p>Kuantitas</p>
                                        </div>
                                        <div class="col-md-10">
                                            <div class="number-input md-number-input">
                                                
                                                <button onclick="this.parentNode.querySelector('input[type=number]').stepDown()" class="minus"></button>
                                                <input class="quantity" min="1" name="quantity" value="1" id="quantity" type="number">
                                                <button onclick="this.parentNode.querySelector('input[type=number]').stepUp()" class="plus"></button>
                                            </div>
                                        </div>
                                    </div>
                                    

                                </article>


                            </div>

                            <div class="box-info-price">


                                <div class="box-price">
                                    <div class="price-value">{{ $data['kambing']['harga'] != null ? 'Rp. '. number_format(($data['kambing']['harga'] ), 0, ',', '.') : 'Rp. 0' }}</div>
                                </div>
                                <div class="box-btn mt-xl-0 ">
                                    @if(Auth::user())

                                    

                                    <input type="hidden" class="form-control" name="kode" id="kode" value="{{ $data['kambing']['kode'] }}">
                                    <input type="hidden" class="form-control" name="harga" id="harga" value="{{ $data['kambing']['harga'] }}">
                                    <input type="hidden" class="form-control" name="jenis" id="jenis" value="{{ $data['kambing']['jenis'] }}">
                                    <input type="hidden" class="form-control" name="berat" id="berat" value="{{ $data['kambing']['bobot'] }}">
                                    <input type="hidden" class="form-control" name="user_id" id="user_id" value="{{ Auth::user()['id'] }}">


                                    <a target="_Blank"  id="btn-order" target="_blank" class="btn orange mr-lg-2">
                                        <span>Beli Sekarang</span></a>

                                    <a class="btn green addcart" id="addkeranjang"  title="Tambah ke Keranjang">
                                        <span>Keranjang</span><i class="las la-cart-plus"></i>
                                    </a>
                                    





                                    @else
                                    <a target="_blank" href="{{ route('register') }}" class="btn orange mr-lg-2">
                                        <span>Beli Sekarang</span></a>
                                    <a class="btn green" href="{{ route('register') }}">
                                        <span>Keranjang</span><i class="las la-cart-plus"></i>
                                    </a>


                                    @endif

                                </div>


                            </div>
                        


                    </div>
                </div>

        </div>
    </div>

</div>

@endsection
@section('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script>



     $(document).ready(function(){

     $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#addkeranjang').click(function () {
            var kode  = $('#kode').val();
            var harga  = $('#harga').val();
            var jenis  = $('#jenis').val();
            var berat  = $('#berat').val();
            var user_id  = $('#user_id').val();
            var quantity  = $('#quantity').val();

            $.ajax({
                data: { 'kode' :kode,'harga' :harga,'jenis' :jenis,'berat' :berat,'user_id' :user_id,'quantity' :quantity,} ,
                url: "{{ route('cart.store') }}",
                type: "POST",
                dataType: 'json',
            
       
            
            success: function(response){
            
                if (response.success == true) {
                    swal("Sukses!", response.message, "success");
                }else if(response.success == false){
                    swal("Gagal!", response.message, "error");
                }

            },

            });
        });

         $('#btn-order').click(function () {
            var kode  = $('#kode').val();
            var harga  = $('#harga').val();
            var jenis  = $('#jenis').val();
            var berat  = $('#berat').val();
            var user_id  = $('#user_id').val();
            var quantity  = $('#quantity').val();


            $.ajax({
                data: { 'kode' :kode,'harga' :harga,'jenis' :jenis,'berat' :berat,'user_id' :user_id,'quantity' :quantity,} ,
                url: "{{ route('checkout.live') }}",
                type: "POST",
                dataType: 'json',
               
                success: function(response){
                    if (response.success === true) {
                        window.location.href = "{{ route('checkout.form') }}";
                        swal("Sukses!", response.message, "success");
                    }

                },
                error: function (data) {
                    console.log('Error:', data);
                }

            });


    });
});
});

    function refreshPage() {
        location.reload(true);
    }




        //via local storage
        // $('#addkeranjang').click(function(){
        //     let storage = JSON.parse(localStorage.getItem("cart"));
		// 		if(storage == null){
		// 			storage = [];
		// 		}
        //         var id       = $(this).data('id');
		// 		var kode     = $(this).data('kode');
		// 		var harga    = $(this).data('harga');
		// 		var user     = $(this).data('user');

		// 		var count    = 1;
		// 		var data = {
		// 			id:id,
		// 			kode:kode,
		// 			harga:harga,
		// 			user:user,

		// 		};

		// 		let cari = _.find(storage, {id: id});

		// 		if(_.isObject(cari)){
		// 			toastr.error('Produk Sudah Ada !');
		// 			return false;
		// 		}else{
		// 			storage.push(data);
		// 			localStorage.setItem("cart",JSON.stringify(storage));
		// 			toastr.success('Produk Sudah dimasukan ke keranjang !');
		// 		}
        // });
	// });
</script>
@endsection
