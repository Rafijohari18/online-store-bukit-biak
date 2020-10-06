@extends('layouts.frontend')

@section('title','Online Store')
@section('css')
<style>
    .card-img img {
        width:100%;
        height:auto;
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
            <div class="row">
                @foreach($data['kambing']['data_kambing'] as $item)   
               
                <div class="col-md-4 col-sm-6 mb-4">
                    
                        <a href="{{ Route('detail.kambing',['id'=> $item['id']]) }}">
                            <div class="card">
                                <div class="card-img">
                                    <img class="img-fluid img-thumbnail" src="{{ $item['photo'] != null ? 'https://apps.bukitbiak.com/'.$item['photo'][0] : asset('assets/temp_frontend/images/default.png') }}" alt="">
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
            </div>
        </div>
        
    </div>

@endsection