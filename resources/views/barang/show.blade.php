@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kategori</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ $barang->kategori->kategori_nama }}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kode Barang</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ $barang->barang_kode }}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Barang</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ $barang->barang_nama }}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Harga Beli</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" value="{{ $barang->harga_beli }}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Harga Jual</label>
            <div class="col-sm-10">
                <input type="number" class="form-control" value="{{ $barang->harga_jual }}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <a href="{{ url('barang/' . $barang->barang_id . '/edit') }}" class="btn btn-primary">Edit</a>
                <a href="{{ url('barang') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
