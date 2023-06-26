@props(['pageTitle'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Larablog | {{ $pageTitle }}</title>
</head>
<body>    
    @include('partials._navbar')
    @if(request()->is('/'))
        @include('partials._hero')
    @endif
    <div class="container">
        {{ $slot }}
    </div>

    @include('partials._footer')
    <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script src="{{ asset('js/sweetalert2.js') }}"></script>
    @yield('scripts')
    <x-flash-message />
</body>
</html>