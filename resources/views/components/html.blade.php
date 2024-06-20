@props(['title' => 'restaurant']);
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}}</title>
    <link rel="stylesheet" href="{{asset('css/global.css')}}">
    <script src="https://kit.fontawesome.com/0062b0aa7f.js" crossorigin="anonymous"></script>
    @stack('links');
</head>

<body>
    {{ $slot }}
    @stack('modals');
    <script src="{{ asset('js/global.js') }}"></script>
</body>

</html>
