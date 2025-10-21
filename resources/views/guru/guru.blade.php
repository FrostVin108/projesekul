{{-- resources/views/guru/guru.blade.php --}}
@extends('layouts.app') {{-- memanggil layout utama --}}

@section('title', 'Guru')

@section('content')
<div class="container mt-5">
    <h1>CRUD Guru</h1>
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
        Add New Guru
    </button>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Tanggal Lahir</th>
                <th>Bidang Guru</th>
                <th>Bio</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($gurus as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->tanggal_lahir }}</td>
                    <td>{{ $item->bidangGuru->name ?? 'N/A' }}</td>
                    <td>{{ $item->bio }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#crudModal" onclick="editGuru({{ $item->id }}, '{{ $item->name }}', '{{ $item->email }}', '{{ $item->tanggal_lahir }}', '{{ $item->guru_bidang_id }}', '{{ addslashes($item->bio) }}', '{{ $item->status }}')">
                            Edit
                        </button>
                        <form action="{{ route('guru.destroy', $item->id) }}" method="POST" style="display: inline;">
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
                    <td colspan="8" class="text-center">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="modal fade" id="crudModal" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crudModalLabel">Add/Edit Guru</h5>
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
                        <label for="guru_bidang_id" class="form-label">Bidang Guru</label>
                        <select class="form-select" id="guru_bidang_id" name="guru_bidang_id" required>
                            <option value="">Pilih Bidang Guru</option>
                            @foreach($bidangGurus as $bg)
                                <option value="{{ $bg->id }}">{{ $bg->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea class="form-control" id="bio" name="bio" rows="3"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
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
        $('#crudForm').attr('action', '{{ route("guru.store") }}');
        $('#crudForm').find('input[name="_method"]').remove();
        $('#name').val('');
        $('#email').val('');
        $('#tanggal_lahir').val('');
        $('#guru_bidang_id').val('');
        $('#bio').val('');
        $('#status').val('active');
        $('#crudModalLabel').text('Add New Guru');
    }
    function editGuru(id, name, email, tanggal_lahir, guru_bidang_id, bio, status) {
        $('#crudForm').attr('action', '{{ route("guru.update", ":id") }}'.replace(':id', id));
        $('#crudForm').append('<input type="hidden" name="_method" value="PUT">');
        $('#name').val(name);
        $('#email').val(email);
        $('#tanggal_lahir').val(tanggal_lahir);
        $('#guru_bidang_id').val(guru_bidang_id);
        $('#bio').val(bio);
        $('#status').val(status);
        $('#crudModalLabel').text('Edit Guru');
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
<!-- </body>
</html> -->