<form action="{{ route('register') }}" method="POST">
    @csrf
    <input type="text" name="name" placeholder="Nama Lengkap" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>
    <button type="submit">Daftar</button>
</form>
    <p>Belum punya akun? <a href="{{ route('login') }}">login di sini</a></p>


