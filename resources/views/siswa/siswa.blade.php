@extends('layouts.app') {{-- memanggil layout utama --}}

@section('title', 'Data Pelajaran')

@section('content')
<div class="container mt-5">
    <h1>CRUD Siswa</h1>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#crudModal" onclick="resetForm()">
        Add New Siswa
    </button>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Tanggal Lahir</th>
                <th>Jurusan</th>
                <th>Kelas</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($siswas as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->tanggal_lahir }}</td>
                    <td>{{ $item->jurusan->name ?? 'N/A' }}</td>
                    <td>{{ $item->kelas->id ?? 'N/A' }}</td> <!-- Asumsi kelas ditampilkan sebagai ID atau nama, sesuaikan jika perlu -->
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#crudModal" onclick="editSiswa({{ $item->id }}, '{{ $item->name }}', '{{ $item->email }}', '{{ $item->tanggal_lahir }}', '{{ $item->jurusan_id }}', '{{ $item->kelas_id }}')">
                            Edit
                        </button>
                        <form action="{{ route('siswa.destroy', $item->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="modal fade" id="crudModal" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crudModalLabel">Add/Edit Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="crudForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                    </div>
                    <div class="mb-3">
                        <label for="jurusan_id" class="form-label">Jurusan</label>
                        <select class="form-select" id="jurusan_id" name="jurusan_id" required>
                            <option value="">Pilih Jurusan</option>
                            @foreach($jurusans as $j)
                                <option value="{{ $j->id }}">{{ $j->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="kelas_id" class="form-label">Kelas</label>
                        <select class="form-select" id="kelas_id" name="kelas_id">
                            <option value="">Pilih Kelas (Opsional)</option>
                            @foreach($kelas as $k)
                                <option value="{{ $k->id }}">{{ $k->id }}</option> <!-- Asumsi kelas ditampilkan sebagai ID; sesuaikan jika ada nama -->
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script>
    function resetForm() {
        $('#crudForm').attr('action', '{{ route("siswa.store") }}');
        $('#crudForm').find('input[name="_method"]').remove();
        $('#name').val('');
        $('#email').val('');
        $('#tanggal_lahir').val('');
        $('#jurusan_id').val('');
        $('#kelas_id').val('');
        $('#crudModalLabel').text('Add New Siswa');
    }
    function editSiswa(id, name, email, tanggal_lahir, jurusan_id, kelas_id) {
        $('#crudForm').attr('action', '{{ route("siswa.update", ":id") }}'.replace(':id', id));
        $('#crudForm').append('<input type="hidden" name="_method" value="PUT">');
        $('#name').val(name);
        $('#email').val(email);
        $('#tanggal_lahir').val(tanggal_lahir);
        $('#jurusan_id').val(jurusan_id);
        $('#kelas_id').val(kelas_id);
        $('#crudModalLabel').text('Edit Siswa');
    }
    $('#crudForm').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            success: function(response) {
                $('#crudModal').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                alert('Error: ' + xhr.responseText);
            }
        });
    });
</script>
@endsection