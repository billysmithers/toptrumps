@foreach ($cards as $card)
    <div>
        <h2>{{ $card->name }}</h2>
        <dl>
            @foreach ($card->capabilities as $capability)
                <dt>{{ $capability->key }}</dt>
                <dd>{{ $capability->value }}</dd>
            @endforeach
        </dl>
    </div>
@endforeach
