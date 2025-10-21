<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'kenzo&vincent')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <style>
    body { background-color: #222831; font-family: 'Arial', sans-serif; color: #DFD0B8; }
    .container { max-width: 1200px; background-color: #393E46; padding: 30px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.4); }
    h1 { color: #DFD0B8; margin-bottom: 30px; text-align: center; }
    .table { background-color: #222831; color: #DFD0B8; }
    .table th { background-color: #948979; color: #222831; border: none; }
    .table-striped tbody tr:nth-of-type(odd) { background-color: #2e343d; }
    .table-striped tbody tr:hover { background-color: #393E46; }
    .btn-primary { background-color: #948979; border-color: #948979; color: #222831; font-weight: bold; }
    .btn-primary:hover { background-color: #DFD0B8; border-color: #DFD0B8; color: #222831; }
    .btn-warning { background-color: #DFD0B8; border-color: #DFD0B8; color: #222831; font-weight: 500; }
    .btn-warning:hover { background-color: #948979; border-color: #948979; color: #222831; }
    .btn-danger { background-color: #b44a4a; border-color: #b44a4a; color: #DFD0B8; }
    .btn-danger:hover { background-color: #8a3838; border-color: #8a3838; }
    .btn-secondary { background-color: #393E46; border-color: #393E46; color: #DFD0B8; }
    .btn-secondary:hover { background-color: #222831; border-color: #222831; }
    .modal-content { background-color: #393E46; color: #DFD0B8; border-radius: 10px; border: 1px solid #948979; }
    .modal-header, .modal-footer { border: none; }
    .form-label { color: #DFD0B8; font-weight: 500; }
    .form-control, .form-select { background-color: #222831; color: #DFD0B8; border: 1px solid #948979; }
    .form-control:focus, .form-select:focus { background-color: #2b2f36; color: #DFD0B8; border-color: #DFD0B8; box-shadow: 0 0 5px #948979; }
    textarea.form-control { resize: none; }
    @media (max-width: 768px) { .container { padding: 15px; } h1 { font-size: 1.5rem; } }
    </style>
</head>
<body>
    <div>
        <h1>
            <a href="{{ route('guru') }}">guru</a> |
            <a href="{{ route('guru.bidang') }}">bidang guru</a> |
            <a href="{{ route('pelajaran') }}">pelajaran</a> |
            <a href="{{ route('jadwal') }}">jadwal</a> |
            <a href="{{ route('siswa') }}">siswa</a> |
            <a href="{{ route('siswa.jurusan') }}">jurusan</a> |
            <a href="{{ route('ekstra') }}">ekstrakulikuler</a> |
            <a href="{{ route('kelas.apa') }}">kelas apa</a> |
            <a href="{{ route('ruang_kelas') }}">ruang kelas</a> |
            <a href="{{ route('lab') }}">lab</a> |
            <a href="{{ route('kelas') }}">kelas</a>
        </h1>
</div>

        {{-- Bagian konten yang bisa diganti --}}
        @yield('content')

</body>
</html>
