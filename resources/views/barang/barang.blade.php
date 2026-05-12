@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-primary mt-1" href="{{ url('barang/create') }}">
                <i class="fas fa-plus"></i> Tambah
            </a>
            <button onclick="modelAction('{{ url('barang/create_ajax') }}')" class="btn btn-sm btn-info mt-1">
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
                <select class="form-control" id="barang_id" name="barang_id">
                    <option value="">- Semua -</option>
                    @foreach($barang as $item)
                        <option value="{{ $item->barang_id }}" {{ (isset($selected_id) && $selected_id == $item->barang_id) ? 'selected' : '' }}>
                            {{ $item->barang_nama }}
                        </option>
                    @endforeach
                </select>
                <small class="form-text text-muted">Barang</small>
            </div>
        </div>
    </div>
</div>

        <table class="table table-bordered table-striped table-hover table-sm" id="table_barang">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori ID</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div id="myModal" class="modal fade animate shake" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" data-width="75%" aria-hidden="true"></div>  
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
        var dataBarang = $('#table_barang').DataTable({
            serverSide: true, // Menggunakan server side processing
            ajax: {
                "url": "{{ url('barang/list') }}",
                "dataType": "json",
                "type": "POST",
                "data": function(d) {
                    d.barang_id = $('#barang_id').val(); // Mengirim data filter barang_id
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
                    // Mengambil data dari ORM berelasi
                    data: "kategori.kategori_id",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "barang_kode",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "barang_nama",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "harga_beli",
                    className: "",
                    orderable: true,
                    searchable: true
                },
                {
                    data: "harga_jual",
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

        $('#barang_id').change(function() {
            dataBarang.ajax.reload(); // Reload data ketika filter berubah
        });
        
    });
</script>
@endpush