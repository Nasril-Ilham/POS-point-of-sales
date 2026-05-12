@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <button onclick="modelAction('{{ url('supplier/create_ajax') }}')" class="btn btn-sm btn-info mt-1">
                <i class="fas fa-plus"></i> Tambah (Ajax)
            </button>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped table-hover table-sm" id="table_supplier">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Supplier</th>
                    <th>Nama Supplier</th>
                    <th>Alamat Supplier</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal Container -->
<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>       
@endsection

@push('js')
<script>
    // Fungsi untuk memanggil Modal AJAX
    function modelAction(url) {
        $('#myModal').load(url, function() {
            $(this).modal('show');
        });
    }

    var dataSupplier; // Deklarasi variabel global agar bisa di-reload dari file edit_ajax
    $(document).ready(function() {
        dataSupplier = $('#table_supplier').DataTable({
            serverSide: true,
            ajax: {
                "url": "{{ url('supplier/list') }}",
                "dataType": "json",
                "type": "POST",
                "headers": {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    className: "text-center",
                    orderable: false,
                    searchable: false
                },
                { data: "supplier_kode", orderable: true, searchable: true },
                { data: "supplier_nama", orderable: true, searchable: true },
                { data: "supplier_alamat", orderable: true, searchable: true },
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