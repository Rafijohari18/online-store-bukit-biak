<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="theme-color" content="#fff" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @if (Request::segment(3) != null)
            {{ ucfirst(str_replace('-', ' ', Request::segment(2))) }} - @yield('title')
        @else
            @yield('title')
        @endif
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="images/favicon.ico" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500" rel="stylesheet">

    <!-- Css Global -->
    <link rel="stylesheet" href="{{ asset('assets/temp_frontend/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/temp_frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/temp_frontend/css/line-awesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/temp_frontend/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/temp_frontend/css/fontawesome-all.css') }}">

    <!-- Css Additional -->
    <link rel="stylesheet" href="{{ asset('assets/temp_frontend/css/lightgallery.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/temp_frontend/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/jquery-loading-master/demo/demo.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">
    @yield('css')

    <style>
        .modal .modal-dialog-aside {
            width: 350px;
            max-width: 80%;
            height: 100%;
            margin: 0;
            transform: translate(0);
            transition: transform .2s;
        }

        .modal .modal-dialog-aside .modal-content {
            height: inherit;
            border: 0;
            border-radius: 0;
        }

        .modal .modal-dialog-aside .modal-content .modal-body {
            overflow-y: auto
        }

        .modal.fixed-left .modal-dialog-aside {
            margin-left: auto;
            transform: translateX(100%);
        }

        .modal.fixed-right .modal-dialog-aside {
            margin-right: auto;
            transform: translateX(-100%);
        }

        .modal.show .modal-dialog-aside {
            transform: translateX(0);
            width: 430px;
        }

        .cart-wr {
            z-index: 100;
            right: 30px;
            position: fixed;
            bottom: 75px;
        }

        .buttonCart {
            border-radius: 100%;
            height: 40px;
            width: 40px;
            background-color: #ffcc55;
            border: 0;
            margin-bottom: 15px;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            font-size: 22px;
        }

        .badge-notif {
            position: relative;
        }

        .badge-notif[data-badge]:after {
            content: attr(data-badge);
            position: absolute;
            top: 19px;
            right: -6px;
            font-size: .5em;
            background: #000;
            color: white;
            width: 20px;
            height: 20px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }



        @media screen and (max-width: 991.98px) {


            .cart-wr {
                right: 23px;
                bottom: 23px;

            }

            /* .buttonCart {
                    width: 30px;
     height: 30px;
     position: relative;
    bottom: 14px;
    } */

            .buttonCart i {
                font-size: 18px;
            }

        }

        .cart-wrap {
            text-align: right;
            padding-right: 10px;
        }

        .produk-text {
            max-width: 130px;
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;
            padding: 0 15px;
        }

        .loading-div {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }


        .kambing-img {
            position: relative;
            margin-bottom: 1.5em;
        }

        .kambing-img:after {
            position: relative;
            content: "";
            display: block;
            padding-top: 100%;
        }

        footer {
            padding-bottom: 0px;
        }

        @media screen and (min-width: 767.98px) {
            .modal-content {
                width: 125%;
            }
        }

    </style>
</head>

<body>
    @php
        $segment1 = Request::segment(1);
        $segment2 = Request::segment(2);
        $segment3 = Request::segment(3);
        $segment4 = Request::segment(4);
    @endphp



    <div id="page">
        <header>
            <div class="main-header">
                <div class="container">
                    <div class="menubar-flex">
                        <div class="menubar-left">
                            <div class="main-logo">
                                <a class="logo" href="{{ url('/') }}">
                                    <img src="{{ asset('assets/temp_frontend/images/logo.png') }}">
                                </a>
                            </div>
                        </div>
                        <div class="menubar-center">
                            <nav class="main-nav">
                                <ul class="list-nav" id="hover-line">

                                    <li
                                        class="{{ $segment1 != 'history' && $segment1 != 'login' ? 'current-nav' : '' }}">
                                        <a href="{{ url('/') }}">Online Store</a>
                                    </li>
                                    @if (!Auth::user())
                                        <li class="{{ $segment1 == 'login' ? 'current-nav' : '' }}">
                                            <a href="{{ route('login') }}">Login</a>
                                        </li>
                                    @endif
                                    @if (Auth::user())
                                        <li class="{{ $segment1 == 'history' ? 'current-nav' : '' }}">
                                            <a href="{{ route('history') }}">History </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('logout') }}"
                                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">Log
                                                Out</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>
                                        </li>
                                    @endif

                                </ul>
                            </nav>
                        </div>
                        <div class="menubar-right">
                            <a href="https://api.whatsapp.com/send?phone=6281289171867&amp;text=Assalamu'alaikum..."
                                target="_blank" class="nav-item d-flex align-items-center">
                                <i class="lab la-whatsapp"></i>
                                <div class="nav-whatsapp">
                                    <span>chat sekarang</span>
                                    <h6>+62 81 289 171 867</h6>
                                </div>
                            </a>
                        </div>
                        <div class="navigation-burger">
                            <span></span>
                        </div>

                    </div>
                </div>
            </div>

        </header>
        <main>
            @yield('content')
        </main>
        <footer>
            <div class="footer">
                <div class="container">
                    <div class="footer-links">
                        <div class="row justify-content-between">
                            <div class="col-md-6 col-lg-3">
                                <div class="widget mb-4">
                                    <div class="logo-footer">
                                        <img src="{{ asset('assets/temp_frontend/images/logo-ori.svg') }}" alt="">
                                    </div>
                                    <div class="footer-copyright">
                                        © 2020 <a href="index.html">Bukit Biak</a>. All Rights Reserved
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="widget">
                                    <h5 class="f-title">Explore</h5>
                                    <div id="quicks">
                                        <ul class="menu-quicks">
                                            <li><a href="http://bukitbiak.com/page/tentang-bukit-biak">Profil</a></li>
                                            <li><a href="http://bukitbiak.com/page/hewan-qurban">Qurban</a></li>
                                            <li><a href="http://bukitbiak.com/page/hewan-aqiqah">Aqiqah</a></li>
                                            <li><a href="http://bukitbiak.com/page/kerjasama-reseller">Reseller</a></li>
                                            <li><a href="http://bukitbiak.com/post/galeri">Galeri</a></li>
                                            <li><a href="http://bukitbiak.com/inquiry/kontak-kami">Kontak</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="widget">
                                    <h5 class="f-title">Kontak Kami</h5>
                                    <ul>
                                        <li>Desa Ambarjaya, Kecamatan Ciambar, Kabupaten Sukabumi, Jawa Barat</li>
                                        <li><strong>No. HP: </strong>081289171867</li>
                                        <li><strong>Email: </strong>info@bukitbiak.com</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>


        <div class="cart-wr">


        </div>




        <!-- modal -->
        <div id="cartmodal" class="modal fixed-right fade" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-aside" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Keranjang Saya</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form method="POST" id="kambingForm" action="{{ route('checkout') }}">
                        @csrf
                        <div class="modal-body">
                            <h5 class="list-title"></h5>

                            <table class="table table-striped table-bordered list-cart">

                            </table>
                            <ul class="list-group list-total">
                            </ul>

                            <input type="hidden" name="user_id"
                                value="{{ Auth::user()['id'] != null ? Auth::user()['id'] : '' }}">
                        </div>
                        <div class="modal-footer count-user-cart">


                        </div>
                    </form>
                </div>
            </div> <!-- modal-bialog .// -->
        </div> <!-- modal.// -->

        <!-- end modal -->



        <!-- Modal -->
        <!-- <div class="modal fade" id="cartmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="title-heading">
                                <h5>Keranjang Saya</h5>
                            </div>

                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
        </button>

      </div>
      <form method="POST" id="kambingForm" action="{{ route('checkout') }}">
      @csrf
                        <div class="modal-body">

                            <h5 class="list-title"></h5>

       <ul class="list-group list-cart">


       </ul>

       <ul class="list-group list-total">

       </ul>
       <input type="hidden" name="user_id" value="{{ Auth::user()['id'] != null ? Auth::user()['id'] : '' }}">
                        </div>
                        <div class="modal-footer">
       <button type="submit" class="btn btn-primary" id="checkout">
        Checkout
       </button>
                            <button type="button" class="btn-clear clear-all btn white" data-dismiss="modal" data-user_id="{{ Auth::user()['id'] }}">
                                <i class="las la-trash-alt"></i><span style="padding-left: 10px;">Hapus Semua</span>
                            </button>
      </div>
      </form>

                    </div>
                </div>
            </div> -->

        <!--<div class="loader text-center">-->
        <!--    <div class="loader-inner">-->

                <!-- Animated Spinner -->
        <!--        <div class="lds-roller mb-3">-->
        <!--            <div></div>-->
        <!--            <div></div>-->
        <!--            <div></div>-->
        <!--            <div></div>-->
        <!--            <div></div>-->
        <!--            <div></div>-->
        <!--            <div></div>-->
        <!--            <div></div>-->
        <!--        </div>-->

                <!-- Spinner Description Text [For Demo Purpose]-->
        <!--        <h4 class="text-uppercase font-weight-bold">Loading</h4>-->
        <!--        <p class="font-italic text-muted">Jendela pemuatan ini akan dihapus setelah <strong-->
        <!--                class="countdown text-dark font-weight-bold">3</strong> Detik</p>-->
        <!--    </div>-->
        <!--</div>-->


        <a id="button"></a>
        <!-- <div id="loading-custom-overlay"></div>
   <div id="custom-overlay"></div> -->
</body>
<!-- jQuery.min.js -->
<script src="{{ asset('assets/temp_frontend/js/jquery.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
    integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
<!-- jQuery Global-->
<!--<script src="{{ asset('assets/temp_frontend/js/fill.box.js') }}"></script>-->
<script src="{{ asset('assets/temp_frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/temp_frontend/js/main.js') }}"></script>

<!-- jQuery Additional-->
<script src="{{ asset('assets/temp_frontend/js/lightgallery.js') }}"></script>
<script src="{{ asset('assets/temp_frontend/js/lg/lg-video.js') }}"></script>
<script src="{{ asset('assets/temp_frontend/js/lg/lg-zoom.js') }}"></script>
<script src="{{ asset('assets/temp_frontend/js/lg/lg-thumbnail.js') }}"></script>
<script src="{{ asset('assets/temp_frontend/js/masonry.pkgd.min.js') }}"></script>
<script src="{{ asset('assets/temp_frontend/js/imagesloaded.js') }}"></script>
<script src="{{ asset('assets/temp_frontend/js/classiee.js') }}"></script>
<script src="{{ asset('assets/temp_frontend/js/AnimOnScroll.js') }}"></script>
<script src="{{ asset('assets/temp_frontend/js/modernizr-2.6.2.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.20/lodash.min.js"></script>
<script src="{{ asset('assets/temp_frontend/toastr/toastr.min.js') }}"></script>

<script src="{{ asset('js/jquery-loading-master/dist/jquery.loading.js') }}"></script>
<script src="{{ asset('assets/temp_frontend/js/fill.box.js') }}"></script>
@yield('js')
<script>
    $(document).ready(function() {

        // HIDE LOADING SPINNER WHEN PAGE IS LOADED [7000msec after the page is loaded]
        // $(window).on('load', function() {
        //     setTimeout(function() {
        //         $('.loader').hide(300);
        //     }, 3000);
        // });



        // FOR DEMO PURPOSE
        // $(window).on('load', function() {
        //     var loadingCounter = setInterval(function() {
        //         var count = parseInt($('.countdown').html());
        //         if (count !== 0) {
        //             $('.countdown').html(count - 1);
        //         } else {
        //             clearInterval();
        //         }
        //     }, 1000);
        // });




        $.ajax({
            url: "{{ route('cart.count') }}",
            type: "get",
            success: function(response) {
                $('.cart-wr').html(response);
            },
        });

        $.ajax({
            url: "{{ route('cart.user.count') }}",
            type: "get",
            success: function(response) {
                $('.count-user-cart').html(response);
            },
        });


    })

    $(document).ready(function() {
        var dataharga = [];

        $(document).on('click', '#buttoncart', function() {
            // loadkeranjang();
            show();
        })
    })

    function show(params) {
        $.ajax({
            url: "{{ route('cart.check') }}",
            type: "get",
            success: function(response) {
                $('.list-cart').html(response);
            },
        });
    }

    function count() {
        $.ajax({
            url: "{{ route('cart.count') }}",
            type: "get",
            success: function(response) {
                $('.cart-wr').html(response);
            },
        });
    }

    function delcheck() {
        $.ajax({
            url: "{{ route('cart.user.count') }}",
            type: "get",
            success: function(response) {
                $('.count-user-cart').html(response);
            },
        });
    }

    $(document).on('click', '.delete-cart', function() {
        var id = $(this).data('id');

        $.ajax({
            data: {
                'id': id
            },
            url: "{{ route('cart.delete') }}",
            type: "get",
            dataType: 'json',

            success: function(response) {

                if (response.success === true) {
                    swal("Sukses!", response.message, "success");
                    show();
                    count();
                    delcheck();

                }

            },
            error: function(data) {}

        });

        // lokal storage
        // var idp = $(this).data('id');
        // let storage = JSON.parse(localStorage.getItem('cart'));

        // for(var i = 0; i < storage.length; i++){
        // 	if(storage[i].id == idp ){
        // 		storage.splice(i,1);
        // 		break;
        // 	}
        // }
        // localStorage.setItem("cart",JSON.stringify(storage));
        // toastr.success('Item Berhasil Di Hapus !');
        // loadkeranjang();
    });

    $('#clear-all').click(function() {

        var user_id = $(this).data('user_id');

        $.ajax({
            data: {
                'user_id': user_id
            },
            url: "{{ route('cart.deleteAll') }}",
            type: "get",
            dataType: 'json',
            success: function(response) {

                if (response.success === true) {
                    swal("Sukses!", response.message, "success");
                    show();
                }
            },


        });


        // localStorage.removeItem('cart');
        // toastr.success('Keranjang Berhasil Dikosongkan !');
        // loadkeranjang();
    });

    function refreshPage() {
        location.reload(true);
    }


    function loadkeranjang() {

        $('.list-cart').empty();
        $('.list-total').empty();

        let storage = JSON.parse(localStorage.getItem('cart'));
        var sum = 0;


        $.each(storage, function(key, value) {

            if (value.harga != null) {
                dataharga = value.harga;
                $('.list-cart').append(
                    "<li class='list-group-item d-flex justify-content-between align-items-center'><input type='checkbox' name='id[]' value=" +
                    value.id + "><input type='hidden' name='kode[]' value=" + value.kode +
                    " ><input type='hidden' name='user_id[]' value=" + value.user +
                    " ><input type='hidden' name='harga[]'  value=" + value.harga +
                    " ><span class='produk-text'>" + value.kode + "</span><span>" + formatRupiah(value.harga
                        .toString(), 'Rp.') +
                    "</span><a href='javascript:;' class='delete-cart' data-id='" + value.id +
                    "'><i class='fa fa-trash'></i></a></li>");
                sum += Number(value.harga);
            } else {
                return null;
            }
            hargatotal = formatRupiah(sum.toString(), 'Rp.');


        });
        $('.list-total').append(
            "<li class='list-group-item d-flex justify-content-between align-items-center'><span>TOTAL</span><span style='padding-right:66px;'>" +
            hargatotal + "</span>");

    }


    // $(document).on('change','#kambing_id',function(){
    // 	var tes = $(this).data('price');
    // 	alert(tes);
    // });

    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        if (angka == null) {
            return null;
        } {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }
    }

    $(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // $('#checkout').click(function () {

        // $(this).html('Mengirim..');


        // $.ajax({
        // 	data: $('#kambingForm').serialize(),
        // 	url: "{{ route('checkout') }}",
        // 	type: "POST",
        // 	dataType: 'json',
        // 	success: function(response){
        // 		$('#cartmodal').modal('hide');
        // 		window.location.href = "{{ route('checkout.form') }}";
        // 	},
        // 	error: function (data) {
        // 		console.log('Error:', data);
        // 		$('#saveBtn').html('Save Changes');
        // 	}

        // 	});
        // });
    });

    $('#list-video').lightGallery({
        selector: '.item-video',
        autoplayFirstVideo: false,
    });

    //MASONRY
    new AnimOnScroll(document.getElementById('masonry'), {
        minDuration: 0,
        maxDuration: 0,
        viewportFactor: 0
    });

    $('.masonry-photo').lightGallery({});



    $(document).ready(function() {
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut",
        }


        // 			$('.clear-all').click(function(){
        // 				localStorage.removeItem('cart');
        // 				toastr.success('Keranjang Berhail Dikosongkan !');
        // 				loadkeranjang();
        // 			});


    });

</script>


</html>
