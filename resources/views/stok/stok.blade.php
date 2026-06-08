@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('stok/create') }}">
                <i class="fas fa-plus"></i> Tambah
            </a>
            <button onclick="modelAction('{{ url('stok/create_ajax') }}')" class="btn btn-sm btn-info mt-1">
                <i class="fas fa-plus"></i> Tambah (Ajax)
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
                        <select class="form-control" id="kategori_id" name="kategori_id">
                            <option value="">- Semua Kategori -</option>
                            @foreach($kategori as $item)
                                <option value="{{ $item->kategori_id }}">
                                    {{ $item->kategori_nama }}
                                </option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Kategori</small>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-bordered table-striped table-hover table-sm" id="table_stok">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Supplier</th>
                    <th>Kategori</th>
                    <th>User</th>
                    <th>Tanggal Stok</th>
                    <th>Jumlah</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal Container -->
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>  
@endsection

@push('css')
@endpush

@push('js')
<script>
    // Fungsi untuk memanggil Modal AJAX
    function modelAction(url) {
        $('#myModal').load(url, function() {
            $(this).modal('show');
        });
    }

    // pelajari ini juga karna ini awal dari reload nya dan menampung modal 
    // var datastok ini akan di panggil pada edit 

    var dataStok; // Deklarasi variabel global agar bisa di-reload dari file create/edit ajax
    $(document).ready(function() {
        dataStok = $('#table_stok').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                "url": "{{ url('stok/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function(d) {
                    d.kategori_id = $('#kategori_id').val();
                },
                "headers": {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>t<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                {
                    data: "supplier",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "kategori",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "user",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "stok_tanggal",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "stok_jumlah",
                    className: "text-right",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "aksi",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                }
            ]
        });

        // Trigger reload saat filter kategori berubah
        $('#kategori_id').change(function() {
            dataStok.ajax.reload();
        });
    });
</script>
@endpush