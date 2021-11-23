<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{route('upload')}}" enctype="multipart/form-data" method="POST">
        @csrf
        <input type="file" name="file" id="">
        <button type="submit">Upload</button>
    </form>
</body>
</html>