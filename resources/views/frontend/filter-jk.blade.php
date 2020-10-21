
@if($data['kambing']->count())
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
                    <h6 class="card-title">
                            {{ $item['kode'] }}
                    </h6>
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
<h5 class="text-danger text-center w-100 mt-5">Data Tidak Ditemukan !</h5>
@endif



<script src="{{ asset('assets/temp_frontend/js/jquery.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <!-- jQuery Global-->
<script src="{{ asset('assets/temp_frontend/js/fill.box.js')}}"></script>
<script src="{{ asset('assets/temp_frontend/js/bootstrap.min.js')}}"></script>
<script src="{{ asset('assets/temp_frontend/js/main.js')}}"></script>
<script>
$(document).ready(function() {
    $('.thumbnail-img img').fillBox();
});
</script>
