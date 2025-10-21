@extends('layouts.app') {{-- memanggil layout utama --}}

@section('title', 'Data Pelajaran')

@section('content')
    <div class="container mt-5">
        <h1>CRUD Jadwal</h1>
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
            Add New Jadwal
        </button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Hari</th>
                    <th>Pelajaran</th>
                    <th>Waktu</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jadwals as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ ucfirst($item->hari) }}</td>
                        <td>{{ $item->pelajaran->nama ?? 'N/A' }}</td>
                        <td>{{ $item->waktu ? $item->waktu->format('H:i') : 'N/A' }}</td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#crudModal"
                                onclick="editJadwal({{ $item->id }}, '{{ $item->hari }}', '{{ $item->pelajaran_id }}', '{{ $item->waktu ? $item->waktu->format('H:i') : '' }}')">
                                Edit
                            </button>
                            <form action="{{ route('jadwal.destroy', $item->id) }}" method="POST" style="display: inline;">
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
                    <h5 class="modal-title" id="crudModalLabel">Add/Edit Jadwal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="crudForm" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="hari" class="form-label">Hari</label>
                            <select class="form-select" id="hari" name="hari" required>
                                <option value="">Pilih Hari</option>
                                <option value="senin">Senin</option>
                                <option value="selasa">Selasa</option>
                                <option value="rabu">Rabu</option>
                                <option value="kamis">Kamis</option>
                                <option value="jumat">Jumat</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="pelajaran_id" class="form-label">Pelajaran</label>
                            <select class="form-select" id="pelajaran_id" name="pelajaran_id" required>
                                <option value="">Pilih Pelajaran</option>
                                @foreach($pelajarans as $p)
                                    <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="waktu" class="form-label">Waktu</label>
                            <input type="time" class="form-control" id="waktu" name="waktu">
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
            $('#crudForm').attr('action', '{{ route("jadwal.store") }}');
            $('#crudForm').find('input[name="_method"]').remove();
            $('#hari').val('');
            $('#pelajaran_id').val('');
            $('#waktu').val('');
            $('#crudModalLabel').text('Add New Jadwal');
        }
        function editJadwal(id, hari, pelajaran_id, waktu) {
            $('#crudForm').attr('action', '{{ route("jadwal.update", ":id") }}'.replace(':id', id));
            $('#crudForm').append('<input type="hidden" name="_method" value="PUT">');
            $('#hari').val(hari);
            $('#pelajaran_id').val(pelajaran_id);
            $('#waktu').val(waktu);
            $('#crudModalLabel').text('Edit Jadwal');
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