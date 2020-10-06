@extends('layouts.frontend')

@section('title','Register')
@section('css')
<style type="text/css">

.btn {
    max-width: 500px;
}


</style>
@endsection
@section('content')

<div class="content-msp">
	<div class="container msp">
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
							Daftar
						</a>
					</li>
					
					

				</ul>
			</nav>
		</div>
	</div>

	<div class="container msp blog">
		<div class="blog-post-detail" style="padding-bottom: 0;">
			<div class="content-header">
				<div class="header-info">
					<div class="title">
						<h1>Daftar </h1>
					</div>
					
				</div>
				@if($message = Session::get('sukses'))
				<div class="alert alert-success" role="alert">
					<a class="close" href="#" data-dismiss="alert" aria-label="close"><i class="icon ti-close"></i></a>
					{{ $message }}
				</div>
				@endif

				@if($message = Session::get('failed'))
				<div class="alert alert-success" role="alert">
					<a class="close" href="#" data-dismiss="alert" aria-label="close"><i class="icon ti-close"></i></a>
					{{ $message }}
				</div>
				@endif

				@if ($errors->any())
				<div class="alert alert-danger" role="alert">
					<ul>
						@foreach($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif 


				<div class="login-box">
     
                <form method="POST" action="{{ route('register_in') }}" class="login-form">
                @csrf
                    <div class="form-group">
                        <div class="input-with-icon">
                            <i class="las la-user"></i>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="off" required placeholder="Nama Lengkap"> 
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-with-icon">
                            <i class="las la-store"></i>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="off" required placeholder="Email"> 
                        </div>
                    </div>
                    
                   
                    <div class="form-group">
                        <div class="input-with-icon">
                            <i class="las la-key"></i>
                            <input type="password"  id="login-password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" required name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-with-icon">
                            <i class="las la-key"></i>
                            <input type="password"  id="password_confirmation" class="form-control @error('password') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password" placeholder="Konfirmasi Password">
                        </div>
                    </div>
                   
                    <div class="form-group">
                    <button type="submit" name="login" value="Login" class="btn black">Register</button>
                    </div>
                </form>						    
                      
                     
                 
					    <a href="{{ url('login') }}" class="btn white">
							Login
						</a>
						<div class="separator">
							<span class="separator-text">atau</span>
						</div>
						<div class="socmed-login">

							<a href="{{ route('google.login') }}" class="btn white">
							<img class="mr-1" src="{{ asset('assets/temp_frontend/images/google.svg')}}" alt="">
							<span>Login dengan Google</span>
							</a>
						</div>
	
				</div>
				
			</div>


		</div>
	</div>


</div>

@endsection