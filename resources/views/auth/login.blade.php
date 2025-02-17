<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Login Pendaftaran</title>
	<link rel="stylesheet" type="text/css" href="slide navbar style.css">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


<link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
	<div class="main">  	
		<input type="checkbox" id="chk" aria-hidden="true">
		@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

			<div class="signup">
				<form action="{{ route('login') }}" method="POST" >
					@csrf
                    <div class="logo-container">
        <img src="{{ asset('img/htp.png') }}" alt="Icon" width="64" height="64">
    </div>
					<label for="chk" aria-hidden="true">Login</label>
					<input type="email" name="email" placeholder="Email" required="">
					<input type="password" name="password" placeholder="Password" required="">
					<button>Login</button>
				</form>
			</div>
 
			<div class="login">
			<form action="{{ route('register') }}" method="POST">
    @csrf
		
    
		<label class="register-header" for="chk" aria-hidden="true">
		<p>Belum punya akun?</p>
        <i class="fa-solid fa-arrow-down"></i>
        Daftar</label>


    <input type="text" name="name" placeholder="Nama Lengkap" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
    <button>Register</button>
</form>

	</div>
</body>
</html>