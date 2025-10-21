        @extends('layouts.app') {{-- memanggil layout utama --}}
        
        @section('title', 'pembuatan kelas')
        
        @section('content')
    <div class="container mt-5">
        <h1>CRUD Kelas Apa</h1>
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
            Add New Kelas Apa
        </button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Kelas Berapa</th>
                    <th>Jurusan</th>
                    <th>Kelas Ke Berapa</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kelas as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->kelas_berapa }}</td>
                        <td>{{ $item->jurusan->name ?? 'N/A' }}</td>
                        <td>{{ $item->kelas_ke_berapa }}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#crudModal"
                                onclick="editKelasApa({{ $item->id }}, '{{ $item->kelas_berapa }}', '{{ $item->kelas_jurusan_id }}', '{{ $item->kelas_ke_berapa_id }}')">
                                Edit
                            </button>
                            <form action="{{ route('kelas.apa.destroy', $item->id) }}" method="POST"
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
                        <td colspan="5" class="text-center">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="crudModal" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crudModalLabel">Add/Edit Kelas Apa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="crudForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="kelas_berapa" class="form-label">Kelas Berapa</label>
                            <input type="text" class="form-control" id="kelas_berapa" name="kelas_berapa" required>
                        </div>
                        <div class="mb-3">
                            <label for="kelas_jurusan_id" class="form-label">Jurusan</label>
                            <select class="form-select" id="kelas_jurusan_id" name="kelas_jurusan_id" required>
                                <option value="">Pilih Jurusan</option>
                                @foreach($jurusan as $j)
                                    <option value="{{ $j->id }}">{{ $j->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kelas_ke_berapa" class="form-label">Kelas Ke Berapa</label>
                            <input type="number" class="form-control" id="kelas_ke_berapa" name="kelas_ke_berapa"
                                required>
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
            $('#crudForm').attr('action', '{{ route("kelas.apa.store") }}');
            $('#crudForm').find('input[name="_method"]').remove();
            $('#kelas_berapa').val('');
            $('#kelas_jurusan_id').val('');
            $('#kelas_ke_berapa').val('');
            $('#crudModalLabel').text('Add New Kelas Apa');
        }
        function editKelasApa(id, kelas_berapa, kelas_jurusan_id, kelas_ke_berapa) {
            $('#crudForm').attr('action', '{{ route("kelas.apa.update", ":id") }}'.replace(':id', id));
            $('#crudForm').append('<input type="hidden" name="_method" value="PUT">');
            $('#kelas_berapa').val(kelas_berapa);
            $('#kelas_jurusan_id').val(kelas_jurusan_id);
            $('#kelas_ke_berapa').val(kelas_ke_berapa);
            $('#crudModalLabel').text('Edit Kelas Apa');
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