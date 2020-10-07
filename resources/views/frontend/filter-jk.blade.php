@if($data['kambing']->count())
@foreach($data['kambing'] as $item)       
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
    <div class="text-center">
        {{ $data['kambing']->links() }}
    </div>
@else
<h1 class="text-danger text-center">Data Tidak Ditemukan</h1>
@endif