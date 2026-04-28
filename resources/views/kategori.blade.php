@extends('layouts.template')


@section('content')
    <h1>data informasi untuk kategori</h1>
    <table border="1" cellpadding="2" cellspasing="0">
        <tr>
            <th>id</th>
            <th>kode kategori</th>
            <th>kode name</th>
        </tr>
        @foreach ($data as $item)   
        <tr>
            <td>{{$item->kategori_id}}</td>
            <td>{{$item->kategori_kode}}</td>
            <td>{{$item->kategori_nama}}</td>
        </tr>
        @endforeach
    </table>
@endsection