@extends('layouts.template')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-header">
        <h3 class="card-title">{{ $page->title }}</h3>
    </div>
    <div class="card-body">
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Kode Level</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ $level->level_kode }}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Nama Level</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" value="{{ $level->level_nama }}" disabled>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10 offset-sm-2">
                <a href="{{ url('level/' . $level->level_id . '/edit') }}" class="btn btn-primary">Edit</a>
                <a href="{{ url('level') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
