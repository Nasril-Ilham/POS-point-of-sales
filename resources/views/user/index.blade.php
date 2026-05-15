@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('user/create') }}">
                <i class="fas fa-plus"></i> Tambah
            </a>
            <button onclick="modelAction('{{ url('user/create_ajax') }}')" class="btn btn-sm btn-info mt-1">
                <i class="fas fa-plus"></i> Tambah (Ajax)
            </button>
            <button onclick="modelAction('{{ url('user/import_foto') }}')" class="btn btn-sm btn-info mt-1">
    <i class="bi bi-camera-fill"></i> Upload Foto
</button>
        </div>
    </div>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="row">
    <div class="col-md-12">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Filter:</label>
            <div class="col-sm-4">
                <select class="form-control" id="level_id" name="level_id">
                    <option value="">- Semua -</option>
                    @foreach($levels as $item)
                        <option value="{{ $item->level_id }}" {{ (isset($selected_id) && $selected_id == $item->level_id) ? 'selected' : '' }}>
                            {{ $item->level_nama }}
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Level Pengguna</small>
            </div>
        </div>
    </div>
</div>

        <table class="table table-bordered table-striped table-hover table-sm" id="table_user">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>Level Pengguna</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-
backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>

@endsection

@push('css')
@endpush

@push('js')
<script>
    function modelAction(url) {
        $('#myModal').load(url, function() {
            $(this).modal('show');
        });
    }
    $(document).ready(function() {
        window.dataUser = $('#table_user').DataTable({
            serverSide: true, // Menggunakan server side processing
            ajax: {
                "url": "{{ url('user/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function(d) {
                    d.level_id = $('#level_id').val(); // Mengirim data filter level_id
                },
                "headers": {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Penting untuk method POST di Laravel
                }
            },
            columns: [
                {
                    // Nomor urut dari laravel datatable addIndexColumn()
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "user_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "nama",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    // Mengambil data level hasil dari ORM berelasi
                    data: "level.level_nama",
                    className: "",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "aksi",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }
            ]
        });

        $('#level_id').change(function() {
            dataUser.ajax.reload(); // Reload data ketika filter berubah
        });
        
    });
</script>
@endpush