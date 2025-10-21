@extends('layouts.app') {{-- memanggil layout utama --}}

@section('title', 'Data Pelajaran')

@section('content')
    <div class="container mt-5">
        <h1>CRUD Ruang Kelas</h1>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#crudModal"
            onclick="resetForm()">
            Add New Ruang Kelas
        </button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ruang</th>
                    <th>Status</th>
                    <th>Lokasi</th>
                    <th>Kelas</th>
                    <th>History</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ruang_kelas as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->ruang }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->lokasi }}</td>
                        <td>{{ $item->kelas->id ?? 'N/A' }}</td>
                        <td>{{ $item->history ?? 'N/A' }}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#crudModal"
                                onclick="editRuangKelas({{ $item->id }}, '{{ $item->ruang }}', '{{ $item->status }}', '{{ $item->lokasi }}', '{{ $item->kelas_id }}', '{{ $item->history }}')">
                                Edit
                            </button>
                            <form action="{{ route('ruang_kelas.destroy', $item->id) }}" method="POST"
                                style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">
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
                    <h5 class="modal-title" id="crudModalLabel">Add/Edit Ruang Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="crudForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="ruang" class="form-label">Ruang</label>
                            <input type="text" class="form-control" id="ruang" name="ruang" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status" name="status">
                        </div>
                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control" id="lokasi" name="lokasi" required>
                        </div>
                        <div class="mb-3">
                            <label for="kelas_id" class="form-label">Kelas</label>
                            <select class="form-select" id="kelas_id" name="kelas_id">
                                <option value="">Pilih Kelas (Opsional)</option>
                                @foreach($kelas as $k)
                                    <option value="{{ $k->id }}">{{ $k->id }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="history" class="form-label">History</label>
                            <textarea class="form-control" id="history" name="history" rows="3"></textarea>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script>
        function resetForm() {
            $('#crudForm').attr('action', '{{ route("ruang_kelas.store") }}');
            $('#crudForm').find('input[name="_method"]').remove();
            $('#ruang').val('');
            $('#status').val('');
            $('#lokasi').val('');
            $('#kelas_id').val('');
            $('#history').val('');
            $('#crudModalLabel').text('Add New Ruang Kelas');
        }
        function editRuangKelas(id, ruang, status, lokasi, kelas_id, history) {
            $('#crudForm').attr('action', '{{ route("ruang_kelas.update", ":id") }}'.replace(':id', id));
            $('#crudForm').append('<input type="hidden" name="_method" value="PUT">');
            $('#ruang').val(ruang);
            $('#status').val(status);
            $('#lokasi').val(lokasi);
            $('#kelas_id').val(kelas_id);
            $('#history').val(history);
            $('#crudModalLabel').text('Edit Ruang Kelas');
        }
        $('#crudForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize(),
                success: function (response) {
                    $('#crudModal').modal('hide');
                    location.reload();
                },
                error: function (xhr) {
                    alert('Error: ' + xhr.responseText);
                }
            });
        });
    </script>
@endsection