<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Poster</title>
        <link href="{{mix('main.css', 'build')}}" rel="stylesheet" type="text/css">
    </head>
    <body>
    <h2 style="text-align: center"> Front </h2>
        <div id="root"></div>
        <script src="{{mix('main.js', 'build')}}" ></script>
    </body>
</html>
