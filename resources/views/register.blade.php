<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
    body { background-color: #222831; font-family: 'Arial', sans-serif; color: #DFD0B8; }
    .container { max-width: 400px; background-color: #393E46; padding: 30px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4); margin-top: 50px; }
    h1 { color: #DFD0B8; margin-bottom: 30px; text-align: center; }
    .btn-primary { background-color: #948979; border-color: #948979; color: #222831; font-weight: bold; }
    .btn-primary:hover { background-color: #DFD0B8; border-color: #DFD0B8; color: #222831; }
    .form-label { color: #DFD0B8; font-weight: 500; }
    .form-control, .form-select { background-color: #222831; color: #DFD0B8; border: 1px solid #948979; }
    .form-control:focus, .form-select:focus { background-color: #2b2f36; color: #DFD0B8; border-color: #DFD0B8; box-shadow: 0 0 5px #948979; }
    .text-muted { color: #948979; }
    @media (max-width: 768px) { .container { padding: 15px; margin-top: 20px; } h1 { font-size: 1.5rem; } }
    </style>
</head>
<body>
    <div class="container">
        <h1>Register Akun Baru</h1>
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role" required>
                    <option value="">Pilih Role</option>
                    <option value="guru" {{ old('role') == 'guru' ? 'selected' : '' }}>Guru</option>
                    <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
        </form>
        <p class="text-center mt-3 text-muted">Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none">Login di sini</a></p>
    </div>
</body>
</html>