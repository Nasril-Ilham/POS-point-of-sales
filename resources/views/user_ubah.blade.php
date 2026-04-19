<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>update data</h1>
    <a href="{{ url('/user') }}">kembali</a>
    <br>
    <br>

    <form action="{{ url('/user/ubah_simpan/' . $data->user_id) }}" method="post">
     @csrf
     @method('PUT')
        <label for="">usernama</label>
        <input type="text" name="user_nama" id="user_nama" placeholder="masukkan user nama .." value="{{ $data->user_nama}}">
        <br>
        <br>
        <label for="">nama</label>
        <input type="text" name="nama" id="nama" placeholder="masukkan nama .." value="{{ $data->nama}}">
        <br>
        <br>
        <label for="">password</label>
        <input type="password" name="password" id="password" placeholder="masukkan password .." value="{{ $data->password}}">
        <br>
        <br>
        <label for="">level id</label>
        <input type="number" name="level_id" id="level_id" placeholder="masukkan user nama .." value="{{ $data->level_id}}">
        <button type="submit">simpan</button>
    </form>
</body>
</html>