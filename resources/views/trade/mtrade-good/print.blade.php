<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print Page</title>
</head>
<body>
<div class="container">
    <div style="margin-left: 20px">
        {!! QrCode::size(100)->generate('A basic example of QR code!'); !!}<br>
        <i>Кросовка : </i><br>
        <i>Размер : 40</i><br>
        <i>Цвет : Чёрный</i><br>
        <i>Страна : Китай</i><br>
    </div>
{{--    <h2>ШТРИХ КОД : 12345</h2>--}}
{{--    <p>АТРИБУТ ТОВАРА : Цвет</p>--}}
{{--    <p>АТРИБУТ : info</p>--}}
</div>
</body>
</html>
