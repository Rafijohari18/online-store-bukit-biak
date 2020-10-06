@extends('layouts.frontend')

@section('title','History')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/temp_frontend/bootstrap-sortable/bootstrap-sortable.css')}}">
    <style>
        .list-historyl {
            list-style-type: circle
        }
    </style>
@endsection
@section('content')

<div class="banner-breadcrumb">
        <div class="container">
            <div class="banner-content">
                <div class="banner-content-text">
                    <div class="title-heading text-center">
                        <h1>History Transaksi {{ Auth::user()['name'] }}</h1>
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
                <table class="table table-bordered table-hover table-striped table-light sortable">
                    <thead>
                        <tr>
                            <th data-defaultsort="asc">#</th>
                            <th>No Invoice</th>
                            <th>Kode Kambing</th>
                            <th>Jenis Kambing</th>
                            <th>Harga Kambing</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        
                        @foreach($data['history'] as $item)
                      
                        <tr>
                            <th scope="row">{{ $loop->iteration  }}</th>
                            <td>{{ $item->no_invoice }}</td>

                            <td>
                                @foreach($item->cart as $cart)
                                    <ul>
                                        <li> - {{ $cart->kode }}</li>
                                    </ul>
                                @endforeach
                            </td>
                            <td>
                                @foreach($item->cart as $cart)
                                    <ul>
                                        <li class="list-history"> - {{ $cart->jenis }}</li>
                                    </ul>
                                @endforeach
                            </td>
                            <td>
                            
                                @foreach($item->cart as $cart)
                                    <ul>
                                        <li class="list-history"> Rp. {{ number_format(($cart->harga), 0, ',', '.') }}</li>
                                    </ul>
                                @endforeach
                            </td>
                        </tr>
                       
                        @endforeach
                        <tr>
                            <td colspan="5" class="text-danger">
                                @if(count($data['history']) == 0)
                                    <p class="text-danger text-center">Data masih kosong !!</p>        
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
               
            </div>
                <div class="text-center mt-3">
                    {{ $data['history']->links() }}
                </div>
        </div>
        
    </div>

@endsection
@section('js')
<script src="{{ asset('assets/temp_frontend/bootstrap-sortable/bootstrap-sortable.js')}}"></script>
@endsection
