<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Play the classic Top Trumps card game! Choose a game to play from this page.">

        <title>Top Trumps</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="bg-gray-100 text-black font-mono">
        <div class="container mx-auto md:px-24 lg:px-52">
            <h1 class="text-center text-3xl m-10">Top Trumps</h1>

            <h2 class="text-center text-2xl m-10">Please select a game from the themes below</h2>

            @foreach ($games as $themeKey => $theme)
                <h3 class="text-center text-xl m-10">{{ $theme['name'] }}</h3>

                <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                    @foreach ($theme['games'] as $gameKey => $game)
                        <div class="max-w-xs m-4">
                            <div class="bg-yellow-300 shadow-xl rounded-lg py-3">
                                <div class="p-2">
                                    <h4 class="text-center text-xl text-gray-900 font-medium leading-8">
                                        <a href="{{ $themeKey }}/{{ $gameKey }}/">{{ $game['name'] }}</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </body>
</html>
