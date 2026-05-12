@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('supplier/' . $supplier->supplier_id) }}" class="form-horizontal">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode Supplier</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('supplier_kode') is-invalid @enderror" id="supplier_kode" name="supplier_kode" value="{{ old('supplier_kode', $supplier->supplier_kode) }}" placeholder="Kode Supplier">
                    @error('supplier_kode')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Supplier</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('supplier_nama') is-invalid @enderror" id="supplier_nama" name="supplier_nama" value="{{ old('supplier_nama', $supplier->supplier_nama) }}" placeholder="Nama Supplier">
                    @error('supplier_nama')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Alamat Supplier</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('supplier_alamat') is-invalid @enderror" id="supplier_alamat" name="supplier_alamat" value="{{ old('supplier_alamat', $supplier->supplier_alamat) }}" placeholder="Alamat Supplier">
                    @error('supplier_alamat')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('supplier') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
