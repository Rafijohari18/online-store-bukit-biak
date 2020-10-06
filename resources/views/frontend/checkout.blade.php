@extends('layouts.frontend')

@section('title','Checkout Kambing')
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('assets/temp_frontend/bootstrap-select/bootstrap-select.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

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
                            <li>
                                <a href="">
                                    Keranjang
                                </a>
                            </li>
                            <li class="current">
                                Checkout
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <h5 class="card-header">Alamat Saya</h5>
                        <div class="card-body">
                           <p class="card-text float-right ml-2 editbtn" style="text-decoration:underline;" data-toggle="modal" data-target="#modalubah"
                           data-provinsi_id ="{{  $data['alamat'] != null ? $data['alamat']->provinsi_id : ''  }}"  data-kota_id ="{{  $data['alamat'] != null ? $data['alamat']->kota_id : ''  }}"  data-kecamatan_id ="{{  $data['alamat'] != null ? $data['alamat']->kecamatan_id : ''  }}"  data-desa_id ="{{  $data['alamat'] != null ? $data['alamat']->desa_id : ''  }}">Ubah </p>
                          
                           <p class="card-text">Nama Toko : {{  $data['alamat'] != null ? $data['alamat']->nama : ''  }}</p>
                           <p class="card-text">No Telepon : {{  $data['alamat'] != null ? $data['alamat']->no_telp : ''  }}</p>
                           <p class="capitalize" style="text-transform: capitalize;">Alamat :  
                                @if($data['alamat'] != null) 
                                    <?php echo ucwords(strtolower($data['alamat']->Provinsi->name)) ?> ,
                                    <?php echo ucwords(strtolower($data['alamat']->Kota->kota)) ?> ,
                                    <?php echo ucwords(strtolower($data['alamat']->Kecamatan->kecamatan)) ?> ,
                                    <?php echo ucwords(strtolower($data['alamat']->Desa->desa)) ?>
                                    
                                @endif 
                            </p> 


                        </div>
                    </div>
                </div>
            </div>
            
            
            <div class="row mt-4 ">
                <div class="col-lg-12">
                    <div class="card">
                        <h5 class="card-header">Invoice Domba</h5>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 mt-5">
                                    <img src="{{ asset('assets/temp_frontend/images/logo.png')}}" alt="logo" style="width:400px;height:auto;">
                                </div>
                                <div class="col-lg-6 mt-5">
                                    <h4>PT. Bukit Biak</h4>
                                    <p>Desa Ambarjaya, Kecamatan Ciambar,<br> Kabupaten Sukabumi, Jawa Barat, <br>Indonesia</p>
                                </div>

                                
                                <div class="col-lg-12 mt-3">
                                    <div class="card p-3" style="background-color:#E6E6FA">
                                            <h5>Invoice #{{ $data['invoice']->no_invoice }}</h5>
                                            <p>Diterbitkan Pada : {{ Carbon\Carbon::parse($data['invoice']->created_at)->translatedFormat('d F Y')  }} </p> 
                                    </div>
                                </div>
                                
                                
                               
                                <div class="col-lg-12">
                                    <h6 class="mt-5">Diterbitkan Atas Nama :</h6>
                                    
                                    <p>{{ $data['alamat']->nama }}</p>
                                    <h6>Alamat Pengiriman : </h6>
                                    <p>
                                        @if($data['alamat'] != null) 
                                        <?php echo ucwords(strtolower($data['alamat']->Provinsi->name)) ?> ,
                                        <?php echo ucwords(strtolower($data['alamat']->Kota->kota)) ?> ,
                                        <?php echo ucwords(strtolower($data['alamat']->Kecamatan->kecamatan)) ?> ,
                                        <?php echo ucwords(strtolower($data['alamat']->Desa->desa)) ?>
                                
                                        @endif 
                                    </p>
                                </div>
                            </div>
                            
                            <table class="table mt-4">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Kode Domba</th>
                                        <th scope="col">Jenis Domba</th>
                                        <th scope="col">Harga Domba</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @php
                                    $total = 0;
                                    
                                @endphp
                                @foreach($data['invoice']->cart as $cart)

                                <form id="konfirmasiform" onsubmit="return submitForm();">
                                <div id="start">
                                    <!-- <input type="hidden" name="idkeranjang[]" class="idkeranjang" id="idkeranjang" value="{{ $cart->id }}"> -->
                                    <input type="hidden" name="idinvoice" class="idinvoice" id="idinvoice" value="{{ $data['invoice']->id }}"> 
                                    <input type="hidden" name="kodeinvoice" class="kodeinvoice" id="kodeinvoice" value="{{ $data['invoice']->no_invoice }}"> 
                                    
                                </div>
                                </form>

                                @php
                                    $id     = $cart->id;
                                    $total += $cart->harga;
                                @endphp
                                <tr>
                                    <td>{{ $cart->kode }}</td>
                                    <td>{{ $cart->jenis }}</td>
                                    <td>Rp. {{ number_format(($cart->harga), 0, ',', '.') }} </td>
                                </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td></td>
                                    <td>Total</td>
                                    <td>Rp. {{ number_format(($total), 0, ',', '.') }} </td>
                                    <input type="hidden" id="total" value="{{ $total }}">
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                           
                            
                        <div class="card-footer">
                            @if($data['alamat'] == null)
                                <button class="btn btn-success float-right" id="alert-alamat">
                                    Lakukan Pembayaran
                                </button> 
                            @elseif($data['alamat'] != null && $data['invoice']->snap_token == null)
                                <button class="btn btn-success float-right"  id="konfirm">
                                    Lakukan Pembayaran
                                </button> 
                            @elseif($data['alamat'] != null && $data['invoice']->snap_token != null)
                                    <a href="javascript:;" onclick="snap.pay('{{ $data['invoice']->snap_token }}')" class="btn text-uppercase btn-primary">LANJUTKAN PEMBAYARAN</a>
                                <!-- <a href="javascript:;" data-toggle="modal" data-target="#modalbatal" class="btn text-uppercase btn-danger">BATALKAN TRANSAKSI</a> -->
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div> 
</div>


  <!-- modal ubah -->
  <div class="modal fade" id="modalubah" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-lg">
                <div class="modal-header">
                    <div class="title-heading">
                        <h5>Alamat</h5>
                    </div>
                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                        
                </div>
                <form id="alamatForm" method="POST">
                    @csrf
                
                <div class="modal-body">
                    <input type="hidden" name="user_id" value="{{ Auth::user()['id'] }}">
                    
                    <label for="name">Provinsi</label>
                    <div class="form-group">
                        <select class="form-control mt-2" name="provinsi_id" id="id_provinsi" required >
                            <option disabled selected >Pilih Provinsi</option>
                            @foreach ($data['provinsi'] as $row)
                            <option value="{{ $row->id }}" @if($data['alamat'] != null) {{ $row->id  == $data['alamat']->provinsi_id ? 'selected' : ''}} @endif>{{ $row->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="name" >Kota</label>
                    <div class="form-group">
                        <select name="kota_id" id="kota" class="form-control" required>
                            <option value="" ></option>
                        </select>
                    </div>

                    <label for="name">Kecamatan</label>
                    <div class="form-group">
                        <select name="kecamatan_id" id="kecamatan" class="form-control" required>
                            <option value="" ></option>
                        </select>
                        
                    </div>

                    <label for="name">Desa</label>
                    <div class="form-group">   
                        <select name="desa_id" id="desa" class="form-control" required>
                            <option value="" ></option>
                        </select>
                        
                    </div>
                  
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="saveBtn" class="btn btn-primary">Simpan</button>
                </div>

                </form>
                
            </div>
        </div>
    </div>
    <!-- end modal -->

@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script src="{{ asset('assets/temp_frontend/bootstrap-select/bootstrap-select.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script  src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<script>
    
        $(document).ready(function(){
        
            $('#id_provinsi').select2({
                dropdownParent: $('#modalubah'),
                width: '100%',
            });

            $('#kota').select2({
                dropdownParent: $('#modalubah'),
                width: '100%' 
            });

            $('#kecamatan').select2({
                dropdownParent: $('#modalubah'),
                width: '100%' 
            });

            $('#desa').select2({
                dropdownParent: $('#modalubah'),
                width: '100%' 
            });


        
        $('#konfirm').click(function(){
            
            $('#konfirmasiform').submit();
        });

        $('#alert-alamat').click(function(){
            swal("Gagal!", "Lengkapi Data Alamat Anda !", "error");
        });
    });

    function submitForm() {

        const keranjang = [];
            $('.idkeranjang').each(function() {
            keranjang.push($(this).val());
        });
        
        
        
        // Kirim request ajax
        $.post("{{ route('checkout.submitpayment') }}",
        {
            _method      : 'POST',
            _token       : '{{ csrf_token() }}',
            idkeranjang  : keranjang,
            idinvoice    : $('#idinvoice').val(),
            kodeinvoice  : $('#kodeinvoice').val(),
            jumlah       : $('#total').val(),
   
        },
        
        function (data, status) {
            snap.pay(data.snap_token, {
               
                // Optional
                onSuccess: function (result) {
                    location.reload();
                },
                // Optional
                onPending: function (result) {
                    location.reload();
                },
                // Optional
                onError: function (result) {
                    location.reload();
                }
            });
        });
        return false;
    }

  
  
    $('#id_provinsi').change(function(){

    var cid = $(this).val();
    
    if(cid){
        $.ajax({
            type:"get",
            url:'/checkout/getKota/' + cid, 
            success:function(res){       
            if(res)
            {
                $("#kota").empty();
                $("#kota").append('<option>Pilih Kota</option>');
                $.each(res,function(key,value){
                    $("#kota").append('<option value="'+key+'">'+value+'</option>');
                });
                $('#kota').selectpicker('refresh');
            }
        }
    });
}
});

    $('#kota').change(function(){

    var cid = $(this).val();

    if(cid){
        $.ajax({
            type:"get",
            url:'/checkout/getKecamatan/' + cid, 
            success:function(res){       
            if(res)
            {
                $("#kecamatan").empty();
                $("#kecamatan").append('<option>Pilih Kecamatan</option>');
                $.each(res,function(key,value){
                    $("#kecamatan").append('<option value="'+key+'">'+value+'</option>');
                });
                $('#kecamatan').selectpicker('refresh');
            }
        }
    });
    }
});

    $('#kecamatan').change(function(){

    var cid = $(this).val();

    if(cid){
        $.ajax({
            type:"get",
            url:'/checkout/getDesa/' + cid, 
            success:function(res){       
            if(res)
            {
                $("#desa").empty();
                $("#desa").append('<option>Pilih Desa</option>');
                $.each(res,function(key,value){
                    $("#desa").append('<option value="'+key+'">'+value+'</option>');
                });
                $('#desa').selectpicker('refresh');
            }
        }
    });
    }
});

    $('.editbtn').click(function(){
       
        var provinsi    = $(this).data('provinsi_id');
        var kota        = $(this).data('kota_id');
        var kecamatan   = $(this).data('kecamatan_id');
        var desa        = $(this).data('desa_id');
       
        var cid = $(this).val();
        $.ajax({
            type:"get",
            url:'/checkout/getKota/' + provinsi, 
            success:function(res){       
                if(res)
                {
                    $("#kota").empty();
                    $("#kota").append('<option>Pilih Kota</option>');
                    $.each(res,function(key,value){
                        $("#kota").append('<option value="'+key+'">'+value+'</option>');
                    });
                    $('#kota').selectpicker('val', kota);
                    $('#kota').selectpicker('refresh');
                }
                $.ajax({
                    type:"get",
                    url:'/checkout/getKecamatan/' + kota, 
                    success:function(res){       
                        if(res)
                        {
                            $("#kecamatan").empty();
                            $("#kecamatan").append('<option>Pilih Kecamatan</option>');
                            $.each(res,function(key,value){
                                $("#kecamatan").append('<option value="'+key+'">'+value+'</option>');
                            });
                            $('#kecamatan').selectpicker('val', kecamatan);
                            $('#kecamatan').selectpicker('refresh');
                        }

                            $.ajax({
                                type:"get",
                                url:'/checkout/getDesa/' + kecamatan, 
                                success:function(res){       
                                if(res)
                                {
                                    $("#desa").empty();
                                    $("#desa").append('<option>Pilih Desa</option>');
                                    $.each(res,function(key,value){
                                        $("#desa").append('<option value="'+key+'">'+value+'</option>');
                                    });
                                    $('#desa').selectpicker('val', desa);
                                    $('#desa').selectpicker('refresh');
                                }
                            }
                        });
                        
                    }
                });
            }
        });

      
    });


    $(function() {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    
    $('#saveBtn').click(function () {
        setTimeout(() => {
            savealamat();
        }, 3000);
    });

    function savealamat() {
        $.ajax({
        data: $('#alamatForm').serialize(),
        url: "{{ route('alamat.store') }}",
        type: "POST",
        dataType: 'json',
        success: function(response){    
            $('#alamatForm').trigger("reset");
            $('#modalubah').modal('hide');
            if (response.success === true) {
                swal("Sukses!", response.message, "success");
                setTimeout(() => {
                    window.location.href = "{{ route('checkout.form') }}";
                }, 3000);
            }
        },
        error: function (data) {
        }

        });
    }

});




</script>
@endsection