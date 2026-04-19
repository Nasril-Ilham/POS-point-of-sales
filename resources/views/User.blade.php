<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ url('/user/tambah') }}">tambah data</a>
    <br>
    <br>
    <table border="1" collpadding='2' collspasing='0'>
        <tr>
            <th>id</th>
            <th>usernama</th>
            <th>nama</th>
            <th>level id</th>
            <th>aksi</th>
        </tr>
        @foreach ($data as $data )
            <tr>
                <td>{{$data->user_id}}</td>
                <td>{{$data->user_nama}}</td>
                <td>{{$data->nama}}</td>
                <td>{{$data->level_id}}</td>
                <td><a href="{{ url('/user/ubah/' . $data->user_id) }}">ubah</a> | <a href="{{ url('/user/delete/' . $data->user_id) }}">hapus</a></td>
                
            </tr>
         @endforeach
    </table>
</body>
</html>