    @extends('layouts.app') {{-- memanggil layout utama --}}
    
    @section('title', 'Data Pelajaran')
    
    @section('content')
<div class="container mt-5">
    <h1>CRUD Pelajaran</h1>
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
        Add New Pelajaran
    </button>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pelajarans as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->nama }}</td>
                    <td>
                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#crudModal" onclick="editPelajaran({{ $item->id }}, '{{ $item->nama }}')">
                            Edit
                        </button>
                        <form action="{{ route('pelajaran.destroy', $item->id) }}" method="POST" style="display: inline;">
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
                    <td colspan="3" class="text-center">No data available</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="modal fade" id="crudModal" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crudModalLabel">Add/Edit Pelajaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="crudForm" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" required>
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
        $('#crudForm').attr('action', '{{ route("pelajaran.store") }}');
        $('#crudForm').find('input[name="_method"]').remove();
        $('#nama').val('');
        $('#crudModalLabel').text('Add New Pelajaran');
    }
    function editPelajaran(id, nama) {
        $('#crudForm').attr('action', '{{ route("pelajaran.update", ":id") }}'.replace(':id', id));
        $('#crudForm').append('<input type="hidden" name="_method" value="PUT">');
        $('#nama').val(nama);
        $('#crudModalLabel').text('Edit Pelajaran');
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