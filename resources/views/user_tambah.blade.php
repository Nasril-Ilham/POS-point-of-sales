<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>tambahkan data </h1>
    <form action="{{ url('/user/tambah_simpan') }}" method="POST">
        @csrf

        <label for="">usernama</label>
        <input type="text" name="user_nama" id="user_nama" placeholder="masukkan user nama ..">
        <br>
        <br>
        <label for="">nama</label>
        <input type="text" name="nama" id="nama" placeholder="masukkan nama ..">
        <br>
        <br>
        <label for="">password</label>
        <input type="password" name="password" id="password" placeholder="masukkan password ..">
        <br>
        <br>
        <label for="">level id</label>
        <input type="number" name="level_id" id="level_id" placeholder="masukkan user nama ..">
        <button type="submit">simpan</button>
    </form>
</body>
</html>