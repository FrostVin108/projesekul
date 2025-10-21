<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'kenzo&vincent')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background-color: #222831;
      color: #DFD0B8;
      font-family: 'Poppins', sans-serif;
      display: flex;
      min-height: 100vh;
    }

    /* Sidebar */
    .sidebar {
      width: 250px;
      background-color: #393E46;
      padding: 20px;
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between; /* Biar logout bisa nempel di bawah */
      box-shadow: 2px 0 10px rgba(0, 0, 0, 0.4);
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
    }

    .dropdown-container a {
      background-color: #222831;
      color: #DFD0B8;
      font-size: 0.95rem;
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
    .logout-btn {
      background-color: #b44a4a;
      color: #DFD0B8;
      border: none;
      padding: 10px 15px;
      border-radius: 8px;
      text-align: center;
      text-decoration: none;
      font-weight: 500;
      transition: 0.3s;
      margin-top: auto;
    }

    .logout-btn:hover {
      background-color: #8a3838;
      color: #DFD0B8;
    }

    .content {
      margin-left: 270px;
      padding: 30px;
      flex: 1;
    }

    @media (max-width: 768px) {
      .sidebar {
        position: relative;
        width: 100%;
        height: auto;
        flex-direction: column;
      }

      .content {
        margin-left: 0;
        padding: 15px;
      }
    }
  </style>
</head>

<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="nav-scroll">
      <h2>Kenzo & Vincent</h2>
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
    <a href="{{ route('logout') }}" class="logout-btn"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      Logout
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      @csrf
    </form>
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