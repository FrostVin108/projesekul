<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #222831; color: #DFD0B8; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .card { background-color: #393E46; border: 1px solid #948979; max-width: 400px; width: 100%; }
        .form-label { color: #DFD0B8; }
        .form-control { background-color: #222831; color: #DFD0B8; border: 1px solid #948979; }
        .btn-primary { background-color: #948979; border-color: #948979; }
        .btn-primary:hover { background-color: #DFD0B8; border-color: #DFD0B8; color: #222831; }
    </style>
</head>
<body>
<div class="card p-4">
    <h2 class="text-center mb-4">Login</h2>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="POST" action="{{ route('login.store') }}">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <!-- <p class="text-center mt-3"><a href="{{ route('register') }}">Belum punya akun? Register</a></p> -->
</div>
</body>
</html>