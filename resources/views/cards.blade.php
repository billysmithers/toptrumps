<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Top Trumps - {{ $game }}</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="bg-black font-mono">
        <h1 class="text-center text-3xl text-white m-10">{{ $game }}</h1>

        <div class="grid sm:grid-cols-1 md:grid-cols-4 lg:grid-cols-6">
            @foreach ($cards as $card)
                <div class="max-w-xs m-4">
                    <div class="bg-white shadow-xl rounded-lg py-3">
                        @if (! empty($card->imageUrl))
                            <div class="photo-wrapper p-2">
                                <img
                                    class="w-32 h-32 rounded-full mx-auto"
                                    src="{{ $card->imageUrl }}"
                                    alt="Image of {{ $card->name }}"
                                >
                            </div>
                        @endif
                        <div class="p-2">
                            <h3 class="text-center text-xl text-gray-900 font-medium leading-8">
                                {{ $card->name }}
                            </h3>
                            <table class="text-xs my-3">
                                <tbody>
                                    @foreach ($card->capabilities as $capability)
                                        <tr>
                                            <td class="px-2 py-2 text-gray-500 font-semibold{{ $loop->index % 2 === 0 ? ' bg-gray-100' : '' }}">
                                                {{ $capability->key }}
                                            </td>
                                            <td class="px-2 py-2{{ $loop->index % 2 === 0 ? ' bg-gray-100' : '' }}">
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
    </body>
</html>