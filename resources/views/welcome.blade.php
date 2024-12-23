

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    *{
        margin:0px;
        padding:0px;
    }
    .header{
        height:50px;
        width:100%;
        background-color:aqua;
    }
    .footer{
        height:130px;
        width:100%;
        background-color:aqua;
    }
    .body{
        height:600px;
        width:100%;
    }
</style>
<body>
    <div class="header">
<h1>Header</h1>
    </div>
    <div class="body">
@yield("content")

    </div>
    <div class="footer">
<h1>Footer</h1>
    </div>
</body>
</html>