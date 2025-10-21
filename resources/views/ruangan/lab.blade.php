    @extends('layouts.app') {{-- memanggil layout utama --}}
    
    @section('title', 'Data Pelajaran')
    
    @section('content')
    <div class="container mt-5">
        <h1>CRUD Lab</h1>
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
            Add New Lab
        </button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Lab</th>
                    <th>Status</th>
                    <th>Lokasi</th>
                    <th>Kelas</th>
                    <th>Guru Lab</th>
                    <th>Guru</th>
                    <th>History</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($labs as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->lab }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ $item->lokasi }}</td>
                        <td>{{ $item->kelas->id ?? 'N/A' }}</td>
                        <td>{{ $item->guruLab->name ?? 'N/A' }}</td>
                        <td>{{ $item->guru->name ?? 'N/A' }}</td>
                        <td>{{ $item->history ?? 'N/A' }}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#crudModal"
                                onclick="editLab({{ $item->id }}, '{{ $item->lab }}', '{{ $item->status }}', '{{ $item->lokasi }}', '{{ $item->kelas_id }}', '{{ $item->guru_id_lab }}', '{{ $item->guru_id }}', '{{ $item->history }}')">
                                Edit
                            </button>
                            <form action="{{ route('lab.destroy', $item->id) }}" method="POST" style="display: inline;">
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
                        <td colspan="9" class="text-center">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="crudModal" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crudModalLabel">Add/Edit Lab</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="crudForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="lab" class="form-label">Lab</label>
                            <input type="text" class="form-control" id="lab" name="lab" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status" name="status" required>
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
                            <label for="guru_id_lab" class="form-label">Guru Lab</label>
                            <select class="form-select" id="guru_id_lab" name="guru_id_lab">
                                <option value="">Pilih Guru Lab (Opsional)</option>
                                @foreach($gurus as $g)
                                    <option value="{{ $g->id }}">{{ $g->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="guru_id" class="form-label">Guru</label>
                            <select class="form-select" id="guru_id" name="guru_id">
                                <option value="">Pilih Guru (Opsional)</option>
                                @foreach($gurus as $g)
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
            $('#crudForm').attr('action', '{{ route("lab.store") }}');
            $('#crudForm').find('input[name="_method"]').remove();
            $('#lab').val('');
            $('#status').val('');
            $('#lokasi').val('');
            $('#kelas_id').val('');
            $('#guru_id_lab').val('');
            $('#guru_id').val('');
            $('#history').val('');
            $('#crudModalLabel').text('Add New Lab');
        }
        function editLab(id, lab, status, lokasi, kelas_id, guru_id_lab, guru_id, history) {
            $('#crudForm').attr('action', '{{ route("lab.update", ":id") }}'.replace(':id', id));
            $('#crudForm').append('<input type="hidden" name="_method" value="PUT">');
            $('#lab').val(lab);
            $('#status').val(status);
            $('#lokasi').val(lokasi);
            $('#kelas_id').val(kelas_id);
            $('#guru_id_lab').val(guru_id_lab);
            $('#guru_id').val(guru_id);
            $('#history').val(history);
            $('#crudModalLabel').text('Edit Lab');
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