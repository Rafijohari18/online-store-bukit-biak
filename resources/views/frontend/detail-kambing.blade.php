@extends('layouts.frontend')

@section('title','Detail Kambing')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
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
                <div class="col-lg-6 single-product-info">
                    <div class="product-summary">
                        <div class="box-category">
                           
                                {{ $data['kambing']['jenis'] }}
                           
                        </div><br>
                        
                        <div class="title-heading">
                            <h1>{{ $data['kambing']['kode'] }}</h1>
                        </div>
                        
                        <div class="box-info-price">
                           
                          
                            
                            <div class="box-price">
                                <div class="price-value">{{ $data['kambing']['harga'] != null ? 'Rp. '. number_format(($data['kambing']['harga'] ), 0, ',', '.') : 'Rp. 0' }}</div>
                            </div>
                            <div class="box-btn">
                                @if(Auth::user())
                                <a target="_Blank"  id="btn-order" target="_blank" data-kode="{{ $data['kambing']['kode'] }}" data-harga="{{ $data['kambing']['harga'] }}" 
                                    data-jenis="{{ $data['kambing']['jenis'] }}" data-user="{{ Auth::user()['id'] }}">
                                    <button class="btn orange">Beli Sekarang</button></a>
                                <a class="btn green addcart" id="addkeranjang"  title="Tambah ke Keranjang" data-kode="{{ $data['kambing']['kode'] }}" 
                                data-jenis="{{ $data['kambing']['jenis'] }}" data-harga="{{ $data['kambing']['harga'] }}" data-user="{{ Auth::user()['id'] }}" >
                                    <span>Masukkan Keranjang</span><i class="las la-cart-plus"></i>
                                </a>

                               

                                @else
                                <a target="_blank" href="{{ route('register') }}">
                                    <button class="btn orange">Beli Sekarang</button></a>
                                <a class="btn green" href="{{ route('register') }}">
                                    <span>Masukkan Keranjang</span><i class="las la-cart-plus"></i>
                                </a>


                                @endif
                                
                            </div>
                            
                        
                        </div>
                        <div class="box-description">
                            <article class="content">
                                <p>Bobot : {{ $data['kambing']['bobot'] }} KG </p>
                                <p>Umur : {{ $data['kambing']['umur'] }} Bulan </p>
                                <p>Unggulan : {{ $data['kambing']['unggulan'] == 1 ? 'Ya' : 'Tidak' }}</p>
                                <p>Jenis Kelamin : {{ $data['kambing']['kelamin'] == 1 ? 'Jantan' : 'Betina' }}</p>
                            </article>
                            
                            
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
      

        var kode        = $(this).data('kode');
        var jenis       = $(this).data('jenis');
        var harga       = $(this).data('harga');
        var user_id     = $(this).data('user');  
    
        $.ajax({
            data: {'kode':kode,'jenis':jenis,'harga':harga,'user_id':user_id},
            url: "{{ route('cart.store') }}",
            type: "POST",
            dataType: 'json',
            success: function(response){
                
                if (response.success === true) {
                    swal("Sukses!", response.message, "success");
                }else if(response.success === false){
                    swal("Gagal!", response.message, "error");
                }
            },
            error: function (data) {
            }

        });
    });

         $('#btn-order').click(function () {
            var kode        = $(this).data('kode');
            var jenis       = $(this).data('jenis');
            var harga       = $(this).data('harga');
            var user_id     = $(this).data('user');  

    
            $.ajax({
                data: {'kode':kode,'jenis':jenis,'harga':harga,'user_id':user_id},
                url: "{{ route('checkout.live') }}",
                type: "POST",
                dataType: 'json',
                beforeSend: function() {
                    $('body').loading('toggle');
                },
                success: function(response){
                    if (response.success === true) {
                        $('#cartmodal').modal('hide');
                        window.location.href = "{{ route('checkout.form') }}";
                        swal("Sukses!", response.message, "success");
                    }
                    
                },
                error: function (data) {
                    console.log('Error:', data);
                    $('#saveBtn').html('Save Changes');
                }

            });
                
     
    });
});
});
            
         
           

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