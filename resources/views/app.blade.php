<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <title>Dogebank</title>
</head>
<body class="antialiased">
    <div id="app" class="h-screen w-full bg-gray-800 flex flex-col items-stretch justify-items-stretch"></div>

<script src="{{mix('js/app.js')}}"></script>
</body>
</html>
