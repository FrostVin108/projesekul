<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'kenzo&vincent')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    /* === STYLE UTAMA === */
body {
  background-color: #222831;
  color: #DFD0B8;
  font-family: 'Poppins', sans-serif;
  display: flex;
  min-height: 100vh;
  margin: 0;
}

/* === SIDEBAR === */
.sidebar {
  width: 250px;
  background-color: #393E46;
  display: flex;
  flex-direction: column;
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  box-shadow: 2px 0 10px rgba(0, 0, 0, 0.4);
}

/* Bagian menu yang bisa discroll */
.nav-scroll {
  flex: 1;
  overflow-y: auto;
  padding: 20px;
}

/* Scrollbar */
.nav-scroll::-webkit-scrollbar {
  width: 8px;
}
.nav-scroll::-webkit-scrollbar-thumb {
  background-color: #948979;
  border-radius: 10px;
}
.nav-scroll::-webkit-scrollbar-thumb:hover {
  background-color: #DFD0B8;
}

.sidebar h2 {
  color: #DFD0B8;
  text-align: center;
  margin-bottom: 20px;
  font-weight: 600;
}

.nav-links {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.sidebar a {
  color: #DFD0B8;
  text-decoration: none;
  padding: 10px 15px;
  border-radius: 8px;
  display: block;
  transition: 0.3s;
}

.sidebar a:hover {
  background-color: #948979;
  color: #222831;
}

/* Dropdown */
.dropdown-container {
  display: none;
  flex-direction: column;
  margin-left: 10px;
  margin-top: 5px;
}

.dropdown-container a {
  background-color: #222831;
  color: #DFD0B8;
  font-size: 0.95rem;
  padding: 8px 15px;
}

.dropdown-btn {
  background: none;
  border: none;
  color: #DFD0B8;
  text-align: left;
  width: 100%;
  padding: 10px 15px;
  border-radius: 8px;
  transition: 0.3s;
  font-size: 1rem;
}

.dropdown-btn:hover {
  background-color: #948979;
  color: #222831;
}

/* Tombol Logout */
.logout-section {
  padding: 20px;
  border-top: 1px solid #948979;
  background-color: #2b2f36;
}

.logout-btn {
  background-color: #b44a4a;
  color: #DFD0B8;
  border: none;
  padding: 10px 15px;
  border-radius: 8px;
  text-align: center;
  text-decoration: none;
  font-weight: 500;
  display: block;
  transition: 0.3s;
}

.logout-btn:hover {
  background-color: #8a3838;
  color: #DFD0B8;
}

/* === KONTEN UTAMA === */
.content {
  margin-left: 270px;
  padding: 30px;
  flex: 1;
}

/* === TABEL === */
.table {
  background-color: #393E46;
  color: #DFD0B8;
  border-radius: 8px;
  overflow: hidden;
  border-collapse: collapse;
}

/* Header */
.table thead {
  background-color: #948979;
  color: #222831;
  font-weight: bold;
}

/* Garis pembatas */
.table th, 
.table td {
  border: 1px solid #2e343b !important;
  vertical-align: middle;
}

/* Warna baris bergantian */
.table-striped tbody tr:nth-of-type(odd) {
  background-color: #2b2f36;  /* warna sedikit lebih gelap */
}

.table-striped tbody tr:nth-of-type(even) {
  background-color: #393E46;  /* warna sedikit lebih terang */
}

/* Hover efek */
.table-striped tbody tr:hover {
  background-color: #4a5057;
  transition: background-color 0.2s ease-in-out;
}

/* Tombol di dalam tabel */
.btn-warning {
  background-color: #948979;
  border: none;
  color: #222831;
}
.btn-warning:hover {
  background-color: #DFD0B8;
  color: #222831;
}

.btn-danger {
  background-color: #b84c4c;
  border: none;
  color: #DFD0B8;
}
.btn-danger:hover {
  background-color: #a23f3f;
}

/* === MODAL === */
.modal-content {
  background-color: #393E46;
  color: #DFD0B8;
  border: 1px solid #948979;
  border-radius: 10px;
}

.form-control {
  background-color: #222831;
  color: #DFD0B8;
  border: 1px solid #948979;
}
.form-control:focus {
  background-color: #2e343b;
  border-color: #DFD0B8;
  color: #DFD0B8;
  box-shadow: none;
}

.btn-primary {
  background-color: #948979;
  border: none;
  color: #222831;
}
.btn-primary:hover {
  background-color: #a89c8a;
}

.btn-secondary {
  background-color: #222831;
  border: 1px solid #948979;
  color: #DFD0B8;
}
.btn-secondary:hover {
  background-color: #2f343a;
}

/* === RESPONSIVE === */
@media (max-width: 768px) {
  .sidebar {
    position: relative;
    width: 100%;
    height: auto;
  }
  .content {
    margin-left: 0;
  }
}
  </style>
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="nav-scroll">
      <h2>Sistem Manajemen Sekolah</h2>
      <hr>
      <div class="nav-links">
        <a href="{{ route('guru') }}">Guru</a>

        <!-- Dropdown Data -->
        <button class="dropdown-btn">Data ▾</button>
        <div class="dropdown-container">
          <a href="{{ route('guru.bidang') }}">Bidang Guru</a>
          <a href="{{ route('siswa.jurusan') }}">Jurusan</a>
        </div>

        <a href="{{ route('pelajaran') }}">Pelajaran</a>
        <a href="{{ route('jadwal') }}">Jadwal</a>
        <a href="{{ route('siswa') }}">Siswa</a>
        <a href="{{ route('ekstra') }}">Ekstrakurikuler</a>
        <a href="{{ route('kelas.apa') }}">Kelas Apa</a>
        <a href="{{ route('ruang_kelas') }}">Ruang Kelas</a>
        <a href="{{ route('lab') }}">Lab</a>
        <a href="{{ route('kelas') }}">Kelas</a>
      </div>
    </div>

    <!-- Tombol Logout -->
    <div class="logout-section">
      <a href="{{ route('logout') }}" class="logout-btn"
         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        Logout
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>
    </div>
  </div>

  <!-- Konten utama -->
  <div class="content">
    @yield('content')
  </div>

  <script>
    // Dropdown toggle
    document.querySelector('.dropdown-btn').addEventListener('click', function() {
      this.classList.toggle('active');
      const dropdown = this.nextElementSibling;
      dropdown.style.display = dropdown.style.display === 'flex' ? 'none' : 'flex';
    });
  </script>
</body>
</html>