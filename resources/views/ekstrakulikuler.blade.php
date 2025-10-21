@extends('layouts.app') {{-- memanggil layout utama --}}

@section('title', 'Data Pelajaran')

@section('content')
    <div class="container mt-5">
        <h1>CRUD Ekstrakulikuler</h1>
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
            Add New Ekstrakulikuler
        </button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ruang</th>
                    <th>Lab</th>
                    <th>Status</th>
                    <th>Siswa</th>
                    <th>Guru</th>
                    <th>History</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ekstrakulikuler as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->ruangKelas->ruang ?? 'N/A' }}</td>
                        <td>{{ $item->lab->lab ?? 'N/A' }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->siswa->name ?? 'N/A' }}</td>
                        <td>{{ $item->guru->name ?? 'N/A' }}</td>
                        <td>{{ $item->history ?? 'N/A' }}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#crudModal"
                                onclick="editEkstrakulikuler({{ $item->id }}, '{{ $item->ruang_id }}', '{{ $item->lab_id }}', '{{ $item->status }}', '{{ $item->siswa_id }}', '{{ $item->guru_id }}', '{{ $item->history }}')">
                                Edit
                            </button>
                            <form action="{{ route('ekstra.destroy', $item->id) }}" method="POST" style="display: inline;">
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
                    <h5 class="modal-title" id="crudModalLabel">Add/Edit Ekstrakulikuler</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="crudForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="ruang_id" class="form-label">Ruang</label>
                            <select class="form-select" id="ruang_id" name="ruang_id">
                                <option value="">Pilih Ruang (Opsional)</option>
                                @foreach($ruang_kelas as $r)
                                    <option value="{{ $r->id }}">{{ $r->ruang }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="lab_id" class="form-label">Lab</label>
                            <select class="form-select" id="lab_id" name="lab_id">
                                <option value="">Pilih Lab (Opsional)</option>
                                @foreach($labs as $l)
                                    <option value="{{ $l->id }}">{{ $l->lab }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status" name="status" required>
                        </div>
                        <div class="mb-3">
                            <label for="siswa_id" class="form-label">Siswa</label>
                            <select class="form-select" id="siswa_id" name="siswa_id" required>
                                <option value="">Pilih Siswa</option>
                                @foreach($siswa as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="guru_id" class="form-label">Guru</label>
                            <select class="form-select" id="guru_id" name="guru_id" required>
                                <option value="">Pilih Guru</option>
                                @foreach($guru as $g)
                                    <option value="{{ $g->id }}">{{ $g->name }}</option>
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
            $('#crudForm').attr('action', '{{ route("ekstra.store") }}');
            $('#crudForm').find('input[name="_method"]').remove();
            $('#ruang_id').val('');
            $('#lab_id').val('');
            $('#status').val('');
            $('#siswa_id').val('');
            $('#guru_id').val('');
            $('#history').val('');
            $('#crudModalLabel').text('Add New Ekstrakulikuler');
        }
        function editEkstrakulikuler(id, ruang_id, lab_id, status, siswa_id, guru_id, history) {
            $('#crudForm').attr('action', '{{ route("ekstra.update", ":id") }}'.replace(':id', id));
            $('#crudForm').append('<input type="hidden" name="_method" value="PUT">');
            $('#ruang_id').val(ruang_id);
            $('#lab_id').val(lab_id);
            $('#status').val(status);
            $('#siswa_id').val(siswa_id);
            $('#guru_id').val(guru_id);
            $('#history').val(history);
            $('#crudModalLabel').text('Edit Ekstrakulikuler');
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