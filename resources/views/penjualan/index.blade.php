@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <span class="badge badge-info" style="margin-left: 10px; padding: 8px 12px; font-size: 14px;">{{ $penjualanCount }}</span>
        <div class="card-tools">
            <button onclick="modelAction('{{ url('penjualan/create') }}')" class="btn btn-sm btn-info mt-1">
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

        <table class="table table-bordered table-striped table-hover table-sm" id="table_penjualan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Penjualan</th>
                    <th>User ID</th>
                    <th>penjualan kode</th>
                    <th>Pembeli</th>
                    <th>penjualan tanggal</th>
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

    var dataPenjualan; // Deklarasi variabel global agar bisa di-reload dari file create/edit ajax
    $(document).ready(function() {
        dataPenjualan = $('#table_penjualan').DataTable({
            serverSide: true,
            processing: true,
            ajax: {
                "url": "{{ url('penjualan/list') }}",
                "dataType": "json",
                "type": "POST",
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
                    // data harus sesuai dengan th yang ada di thead kalau tidak maka akan error
                    data: "penjualan_id",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "user_id",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "penjualan_kode",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "pembeli",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "penjualan_tanggal",
                    className: "",
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
    });
</script>
@endpush