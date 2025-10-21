@extends('layouts.app') {{-- memanggil layout utama --}}

@section('title', 'Data Pelajaran')

@section('content')
    <div class="container mt-5">
        <h1>CRUD Kelas</h1>
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
            Add New Kelas
        </button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Count Siswa</th>
                    <th>Ruang</th>
                    <th>Siswa Utama</th>
                    <th>Kelas Apa</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($kelas as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->count_siswa }}</td>
                        <td>{{ $item->ruangKelas->ruang ?? 'N/A' }}</td>
                        <td>{{ $item->siswa->name ?? 'N/A' }}</td>
                        <td>{{ $item->kelasApa->kelas_berapa  ?? 'N/A' }}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#crudModal"
                                onclick="editKelas({{ $item->id }}, '{{ $item->count_siswa }}', '{{ $item->ruang_id }}', '{{ json_encode($item->siswas->pluck('id')->toArray()) }}', '{{ $item->kelas_apa_id }}')">
                                Edit
                            </button>
                            <form action="{{ route('kelas.destroy', $item->id) }}" method="POST" style="display: inline;">
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
                        <td colspan="6" class="text-center">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="crudModal" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crudModalLabel">Add/Edit Kelas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="crudForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="count_siswa" class="form-label">Count Siswa</label>
                            <input type="number" class="form-control" id="count_siswa" name="count_siswa" readonly required
                                min="0"> <!-- Readonly agar otomatis -->
                        </div>
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
                            <label for="siswa_id" class="form-label">Siswa (Pilih Multiple)</label>
                            <select class="form-select" id="siswa_id" name="siswa_id[]" multiple> <!-- Multiple select -->
                                @foreach($siswas as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kelas_apa_id" class="form-label">Kelas Apa</label>
                            <select class="form-select" id="kelas_apa_id" name="kelas_apa_id">
                                <option value="">Pilih Kelas Apa (Opsional)</option>
                                @foreach($kelas_apas as $ka)
                                    <option value="{{ $ka->id }}">{{ $ka->kelas_berapa }}</option>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script>
        function resetForm() {
            $('#crudForm').attr('action', '{{ route("kelas.store") }}');
            $('#crudForm').find('input[name="_method"]').remove();
            $('#count_siswa').val('0');
            $('#ruang_id').val('');
            $('#siswa_id').val([]); // Reset multiple select
            $('#kelas_apa_id').val('');
            $('#crudModalLabel').text('Add New Kelas');
        }
        function editKelas(id, count_siswa, ruang_id, siswa_ids, kelas_apa_id) {
            $('#crudForm').attr('action', '{{ route("kelas.update", ":id") }}'.replace(':id', id));
            $('#crudForm').append('<input type="hidden" name="_method" value="PUT">');
            $('#count_siswa').val(count_siswa);
            $('#ruang_id').val(ruang_id);
            $('#siswa_id').val(siswa_ids); // Set selected options dari array
            $('#kelas_apa_id').val(kelas_apa_id);
            $('#crudModalLabel').text('Edit Kelas');
        }
        // Hitung count_siswa otomatis saat siswa dipilih
        $('#siswa_id').on('change', function () {
            var selectedCount = $(this).val().length;
            $('#count_siswa').val(selectedCount);
        });
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