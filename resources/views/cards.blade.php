<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Play the classic Top Trumps card game! This card set is based on {{ $game }}.">

        <title>Top Trumps - {{ $game }}</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="bg-gray-100 font-mono text-black">
        <div class="container mx-auto md:px-24 lg:px-52">
            <a href="/" class="p-4 block">Games</a>
            <h1 class="text-center text-3xl m-10">{{ $game }}</h1>

            <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                @foreach ($cards as $card)
                    <div class="max-w-xs m-4">
                        <div class="bg-white shadow-xl rounded-lg py-3">
                            <h2 class="text-center text-xl text-gray-900 font-medium leading-8">
                                {{ $card->name }}
                            </h2>
                            @if (! empty($card->imageUrl))
                                <div class="photo-wrapper p-2">
                                    <img
                                        class="w-48 h-48 mx-auto"
                                        src="{{ $card->imageUrl }}"
                                        alt="Image of {{ $card->name }}"
                                    >
                                </div>
                            @endif
                            <div class="p-2">
                                <table class="text-xs my-3">
                                    <tbody>
                                        @foreach ($card->capabilities as $capability)
                                            <tr class="{{ $loop->index % 2 === 0 ? ' bg-yellow-300' : 'bg-yellow-100' }}">
                                                <td class="px-2 py-2 text-black font-semibold">
                                                    {{ $capability->capability }}
                                                </td>
                                                <td class="px-2 py-2 text-black">
                                                    {{ $capability->value }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <footer class="text-center">{{ $credits }}</footer>
        </div>
    </body>
</html>
