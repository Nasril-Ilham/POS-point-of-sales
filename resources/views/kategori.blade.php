<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>data kategori</title>
</head>
<body>
    <h1>data informasi untuk kategori</h1>
<table border="1" cellpadding="2" cellspasing="0">
    <tr>
        <th>kategori id</th>
        <th>kode kategori</th>
        <th>kategori name</th>
    </tr>
    @foreach ($data as $categori)   
    <tr>
     <td>{{$categori->kategori_id}}</td>
     <td>{{$categori->kategori_kode}}</td>
     <td>{{$categori->kategori_nama}}</td>
    </tr>
    @endforeach
</table>
</body>
</html>