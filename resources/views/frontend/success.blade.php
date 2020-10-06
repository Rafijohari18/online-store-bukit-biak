@extends('layouts.frontend')

@section('title','Online Store')
@section('css')
<style>
    .card-img img {
        width:100%;
        height:280px;
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
               
               
                <div class="col-md-4 mb-4">
                    
                        <a href="">
                            <div class="card">

                                <div class="card-body">
                                    <h5 class="card-title">
                                            Berhasil
                                    </h5>
                                    <p class="card-text">Transaksi Berhasil</p>
                                </div>
                            </div>
                        </a>    
                     
                </div>
                
            </div>
        </div>
        
    </div>
@endsection
