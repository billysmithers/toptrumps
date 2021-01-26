<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Top Trumps</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="bg-black font-mono">
        <h1 class="text-center text-3xl text-white m-10">Top Trumps</h1>

        <h2 class="text-center text-2xl text-white m-10">Please select a game</h2>

        <div class="max-w-xs m-4">
            <div class="bg-white shadow-xl rounded-lg py-3">
                <div class="p-2">
                    <h3 class="text-center text-xl text-gray-900 font-medium leading-8">
                        <a href="{{ route('star-wars.starships') }}">Star Wars Starships</a>
                    </h3>
                </div>
            </div>
        </div>
    </body>
</html>
