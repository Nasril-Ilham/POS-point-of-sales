@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">ID Stok</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ $stok->stok_id }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Supplier</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ $stok->supplier->supplier_nama ?? '-' }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ $stok->kategori->kategori_nama ?? '-' }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">User</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ $stok->user->user_nama ?? '-' }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Tanggal Stok</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ $stok->stok_tanggal }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Jumlah Stok</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ $stok->stok_jumlah }}" readonly>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <a href="{{ url('stok/' . $stok->stok_id . '/edit') }}" class="btn btn-primary">Edit</a>
                <form action="{{ url('stok/' . $stok->stok_id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</button>
                </form>
                <a href="{{ url('stok') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
