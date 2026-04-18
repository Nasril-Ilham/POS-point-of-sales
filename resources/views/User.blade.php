<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border="1" collpadding='2' collspasing='0'>
        <tr>
            <th>id</th>
            <th>usernama</th>
            <th>nama</th>
            <th>level id</th>
        </tr>
        
            <tr>
                <td>{{$data->user_id}}</td>
                <td>{{$data->user_nama}}</td>
                <td>{{$data->nama}}</td>
                <td>{{$data->level_id}}</td>
            </tr>
        
    </table>
</body>
</html>