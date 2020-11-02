
@if($data['kambing']->count())
@foreach($data['kambing'] as $item)
                <div class="col-lg-3 col-sm-4  col-12 mb-4">

                        <a href="{{ Route('detail.kambing',['id'=> $item['id']]) }}">
                            <div class="card">
                                <div class="kambing-img">
                                    <div class="thumbnail-img">
                                        <img class="bg-kambing" src="{{ $item['photo'] != null ? 'https://apps.bukitbiak.com/'.$item['photo'][0] : asset('assets/temp_frontend/images/default.png')}}">
                                    </div>
                                    <!-- <div class="loader-img">
                                        <img class="bg-kambing" src="{{ asset('assets/temp_frontend/images/loader.svg') }}" data-src="{{ $item['photo'] != null ? 'https://apps.bukitbiak.com/'.$item['photo'][0] : asset('assets/temp_frontend/images/default.png') }}">
                                    </div> -->
                                </div>

                                <div class="title">
                                    <h6>
                                        {{ $item['kode'] }}
                                    </h6>
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
                {{ $data['kambing']->links('pagination.default') }}

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
