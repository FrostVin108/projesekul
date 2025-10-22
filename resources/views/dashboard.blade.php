@extends('layouts.app') {{-- memanggil layout utama --}}

@section('title', 'Data Pelajaran')

@section('content')
    <!-- Konten Utama -->
    <div class="content">
        <div class="container-fluid">
            <!-- Header Dashboard -->
            <div class="dashboard-header">
                <h1>Welcome to the Dashboard</h1>
                <p>Overview of key data and statistics</p>
            </div>

            <!-- Statistik Cards -->
            <div class="row">
                <div class="col-md-4 col-12">
                    <div class="stat-card">
                        <h3>Total Siswa</h3>
                        <p>{{ $totalSiswa }}</p>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="stat-card">
                        <h3>Total Guru</h3>
                        <p>{{ $totalGuru }}</p>
                    </div>
                </div>
                <div class="col-md-4 col-12">
                    <div class="stat-card">
                        <h3>Total Kelas</h3>
                        <p>{{ $totalKelas }}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12">
                    <div class="stat-card">
                        <h3>Total Jadwal</h3>
                        <p>{{ $totalJadwal }}</p>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="stat-card">
                        <h3>Total Ekstrakulikuler</h3>
                        <p>{{ $totalEkstrakulikuler }}</p>
                    </div>
                </div>
            </div>

            <!-- Tabel Data Terbaru -->
            <h2 class="mt-5">Recent Data</h2>
            <div class="row">
                <div class="col-md-4 col-12 mb-4">
                    <div class="container">
                        <h4>Recent Siswa</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentSiswa as $siswa)
                                        <tr>
                                            <td>{{ $siswa->name }}</td>
                                            <td>{{ $siswa->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 mb-4">
                    <div class="container">
                        <h4>Recent Guru</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentGuru as $guru)
                                        <tr>
                                            <td>{{ $guru->name }}</td>
                                            <td>{{ $guru->email }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-12 mb-4">
                    <div class="container">
                        <h4>Recent Kelas</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Count Siswa</th>
                                        <th>Ruang</th>
                                        <th>Kelas Apa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentKelas as $kelas)
                                        <tr>
                                            <td>{{ $kelas->count_siswa }}</td>
                                            <td>{{ $kelas->ruangKelas->ruang ?? 'N/A' }}</td>
                                            <td>{{ $kelas->kelasApa->kelas_berapa ?? 'N/A' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="dashboard-footer">
                <p>&copy; 2023 School Management System. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleDropdown(id) {
            var container = document.getElementById(id);
            if (container.style.display === "flex") {
                container.style.display = "none";
            } else {
                container.style.display = "flex";
            }
        }
    </script>
@endsection