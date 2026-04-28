@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('level') }}" class="form-horizontal">
            @csrf
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Kode Level</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('level_kode') is-invalid @enderror" id="level_kode" name="level_kode" value="{{ old('level_kode') }}" placeholder="Masukkan kode level">
                    @error('level_kode')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label">Nama Level</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control @error('level_nama') is-invalid @enderror" id="level_nama" name="level_nama" value="{{ old('level_nama') }}" placeholder="Masukkan nama level">
                    @error('level_nama')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ url('level') }}" class="btn btn-secondary">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
