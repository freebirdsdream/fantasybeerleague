<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

	<link href="https://cdn.jsdelivr.net/npm/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/dragula.min.css') }}" type="text/css">
</head>
<body class="bg-grey-lighter">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js'></script>
    <script src="{{ asset('js/typeahead.min.js') }}" type="text/javascript"></script>
    Welcome, @if(Auth::user()){{ Auth::user()->name }}@endif
    <div class="w-3/5 mx-auto mt-6">
        @if(session('message'))
            @if(session('status'))
                <div class="bg-red-lightest border border-red-light text-green-red px-4 py-3 rounded relative m-2" role="alert">
                  <span class="font-bold">Error!</span>
                  <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @else
                <div class="bg-green-lightest border border-green-light text-green-dark px-4 py-3 rounded relative m-2" role="alert">
                  <span class="block sm:inline">{{ session('message') }}</span>
                </div>
            @endif
        @endif
        
        <div class="bg-white shadow-md rounded mb-4">
            @yield('body')
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
        @stack('scripts')
        <p class="text-center text-grey text-xs">
            ©2018 Acme Corp. All rights reserved.
        </p>
    </div>
</body>
</html>
