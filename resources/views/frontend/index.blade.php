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
   
    
</style>
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
                    <div class="form-group">
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
                <div class="col-lg-4 col-md-3 col-12 mb-4">
                    
                        <a href="{{ Route('detail.kambing',['id'=> $item['id']]) }}">
                            <div class="card">
                                <div class="kambing-img">
                                    <div class="thumbnail-img">
                                        <img src="{{ $item['photo'] != null ? 'https://apps.bukitbiak.com/'.$item['photo'][0] : asset('assets/temp_frontend/images/default.png') }}" alt="">
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">
                                            {{ $item['kode'] }}
                                    </h5>
                                    <p class="card-text">{{ $item['harga'] != null ? 'Rp. '. number_format(($item['harga'] ), 0, ',', '.') : 'Rp. 0' }}</p>
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

<script>
  
     
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