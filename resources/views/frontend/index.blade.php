@extends('layouts.frontend')

@section('title','Online Store')
@section('css')
<style>
    .card-img img {
        width:100%;
        height:auto;
    }
    .btn.btn-primary:hover {
        background:#279220;
    }
    .btn-primary:not(:disabled):not(.disabled):active, .btn-primary:not(:disabled):not(.disabled).active, .show > .btn-primary.dropdown-toggle{
        background:#279220;
    }
    @media screen and (max-width: 1199.98px){
        .hidden {
            display: none;
        }
    }
    .bg-kambing {
        width:100%;
        height:280px;
        transition: all .2s ease-in-out;
    }
    .bg-kambing:hover, .bg-kambing:focus {
        -ms-transform: scale(1.2);
        -moz-transform: scale(1.2);
        -webkit-transform: scale(1.2);
        -o-transform: scale(1.2);
        transform: scale(1.2);
    }

   
    .title {
        display: block;
        margin: 0 0 0 18px;
        max-height: 40px;
        overflow: hidden;
        cursor: pointer;
    }
    .price {
        font-weight: 550;
        color: #FFCC55;
        margin: 0 0 0 18px;
        font-size: 16px;
    }
    .owner {
        display: flex;
        justify-content: flex-start;
        color: black;
        font-size: 13px;
        border-radius: 30px;
        margin: 5px 15px 15px;
    }

    .owner-icon{
        position: relative;
        display: flex;
        height: 22px;
        width: 22px;
        align-items: center;
        justify-content: center;
        background: #000;
        color: #fff;
        border-radius: 100%;
        font-size: 13px;
        margin-right: 5px;
    }
   .owner-info {
        position: relative;
        height: 20px;
        overflow: hidden;
        width: calc(100% - 20px);
    }
   
    
</style>

<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="banner-breadcrumb">
        <div class="container">
            <div class="banner-content">
                <div class="banner-content-text">
                    <div class="title-heading text-center">
                        <h1>Online Store</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="thumbnail-img">
            <img src="{{ asset('assets/temp_frontend/images/slide-1.jpg')}}">
        </div>
    </div>
    <div class="box-wrap padding-half">
        <div class="container">
            <div class="row mb-4">
                <div class="col-md-8">
                    <div class="float-left">
                        <p class="font-weight-bold">Total Kambing : {{ $data['jumlah_kambing'] }}</p>
                    </div>
                </div>     
               
                <div class="col-md-2">          
                    <div class="form-group ">
                        <select name="filter_jenis" id="filter" class="form-control" style="margin-top:-20px;">
                                <option selected disabled>Filter Jenis Kambing</option>
                            @foreach($data['jenis'] as $value)
                                <option value="{{ $value['id'] }}">{{ $value['nama'] }}</option>
                            @endforeach    
                        </select>
                       
                    </div>          
                </div>  
                <div class="col-md-2">           
                    <div class="btn-group dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> Filter Jenis Kelamin</button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" onClick="laki()"><i class="las la-mars"></i><span>Jantan</span></a>
                            <a class="dropdown-item" onClick="perempuan()"><i class="las la-venus"></i><span>Betina</span></a>
                            <a class="dropdown-item" onClick="reset()"><i class="las la-sync"></i><span>Reset</span></a>
                        </div>
                    </div>
                </div>
                
                
            </div>
            <div class="row list-kambing" >           
                @foreach($data['kambing'] as $item)   
                <div class="col-lg-3 col-sm-4  col-12 mb-4">
                    
                        <a href="{{ Route('detail.kambing',['id'=> $item['id']]) }}">
                            <div class="card">
                                <div class="kambing-img">
                                    <div class="thumbnail-img">
                                        <img class="bg-kambing" src="{{ asset('assets/temp_frontend/images/loader.svg') }}" data-src="{{ $item['photo'] != null ? 'https://apps.bukitbiak.com/'.$item['photo'][0] : asset('assets/temp_frontend/images/default.png') }}">
                                    </div>
                                </div>
                              
                                <div class="title">
                                    <h5>
                                        {{ $item['kode'] }}
                                    </h5>
                                </div> 
                                <div class="price">
                                    {{ $item['harga'] != null ? 'Rp. '. number_format(($item['harga'] ), 0, ',', '.') : 'Rp. 0' }}
                                </div>
                                <div class="owner">
                                    <div class="owner-icon">
                                        <i class="las la-dog"></i>
                                    </div>
                                    <div class="owner-info">
                                        <span class="owner-desc">{{ $item['jenis'] }}</span>                                   
                                        <span class="owner-desc float-right">{{ $item['kelamin'] == 1 ? 'Jantan' : 'Betina' }}</span>                                   
                                    </div>
                                </div>
                                
                              
                            </div>
                        </a>    
                     
                </div>
                @endforeach

                <div class="text-center">
                    {{ $data['kambing']->links() }}
                </div>
            </div>
            
        </div>
        
        
        
    </div>

@endsection
@section('js')
<script src="{{ asset('assets/temp_frontend/js/jQuery.loadScroll.js') }}"></script>

<script>
    $(function() {  
        // Custom fadeIn Duration
        $('.bg-kambing').loadScroll(1000);

    });
     
    function laki(){
        $value     = 'laki';
        $.ajax({
            type : 'get',
            url : '{{ route('kambing.filter.jk') }}',
            data:{'search':$value},
         
            success:function(data){
                $('.list-kambing').html(data);
            }
        });
    }
    function perempuan(){
        $value      = 'perempuan';
        $.ajax({
            type : 'get',
            url : '{{ route('kambing.filter.jk') }}',
            data:{'search':$value},
            
            success:function(data){
                $('.list-kambing').html(data);
            }
        });
    }
    function reset(){
        $value      = 'reset';
        $.ajax({
            type : 'get',
            url : '{{ route('kambing.filter.jk') }}',
            data:{'search':$value},
            
            success:function(data){
                $('.list-kambing').html(data);
            }
        });
    }
    
    $(document).ready(function() {

    $('#filter').change(function(){

      $value       = 'jenis';    
      $jenis_id    = $(this).val();

      $.ajax({
          type : 'get',
          url  : '{{ route('kambing.filter.jk') }}',
          data: {'search':$value,'jenis_id':$jenis_id},
          success:function(data){
            $('.list-kambing').html(data);
        }
      });
    });
  });
</script>
@endsection