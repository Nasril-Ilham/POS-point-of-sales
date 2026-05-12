@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('stok/' . $stok->stok_id) }}" class="form-horizontal">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Supplier</label>
                <div class="col-sm-10">
                    <select class="form-control @error('supplier_id') is-invalid @enderror" id="supplier_id" name="supplier_id">
                        <option value="">- Pilih Supplier -</option>
                        @foreach($supplier as $item)
                            <option value="{{ $item->supplier_id }}" {{ old('supplier_id', $stok->supplier_id) == $item->supplier_id ? 'selected' : '' }}>
                                {{ $item->supplier_nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kategori</label>
                <div class="col-sm-10">
                    <select class="form-control @error('kategori_id') is-invalid @enderror" id="kategori_id" name="kategori_id">
                        <option value="">- Pilih Kategori -</option>
                        @foreach($kategori as $item)
                            <option value="{{ $item->kategori_id }}" {{ old('kategori_id', $stok->kategori_id) == $item->kategori_id ? 'selected' : '' }}>
                                {{ $item->kategori_nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">User</label>
                <div class="col-sm-10">
                    <select class="form-control @error('user_id') is-invalid @enderror" id="user_id" name="user_id">
                        <option value="">- Pilih User -</option>
                        @foreach($user as $item)
                            <option value="{{ $item->user_id }}" {{ old('user_id', $stok->user_id) == $item->user_id ? 'selected' : '' }}>
                                {{ $item->user_nama }}
                            </option>
                        @endforeach
                    </select>
                    @error('user_id')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Tanggal Stok</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('stok_tanggal') is-invalid @enderror" id="stok_tanggal" name="stok_tanggal" value="{{ old('stok_tanggal', $stok->stok_tanggal) }}">
                    @error('stok_tanggal')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Jumlah Stok</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control @error('stok_jumlah') is-invalid @enderror" id="stok_jumlah" name="stok_jumlah" value="{{ old('stok_jumlah', $stok->stok_jumlah) }}" placeholder="Masukkan jumlah stok" min="1">
                    @error('stok_jumlah')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('stok') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
