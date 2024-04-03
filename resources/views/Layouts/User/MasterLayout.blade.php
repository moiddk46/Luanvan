<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
    <header class="bg-light">
        @if (isset($count))
            <x-User.Header :prop="$header" :title="$title" :order="$count['order']" :priceRequest="$count['priceRequest']" />
        @else
            <x-User.Header :prop="$header" :title="$title" />
        @endif
    </header>
    <main role="main">
        <div class="mt-5">
            @yield('content')
        </div>
        {{--  @extends('Pages.User.Home', compact('data'))  --}}
    </main>
    <footer class="bg-secondary">
        <x-User.footer />
    </footer>
</body>
<script src="{{ asset('assets/js/popper.js') }}"></script>
<script src="{{ asset('assets/js/bootstap.js') }}"></script>
<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('assets/js/ajax.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

</html>
