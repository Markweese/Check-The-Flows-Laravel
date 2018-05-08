<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>
      @foreach ($states as $state)
        <p>This is state: {{ $state->name }}</p>

        @foreach ($state->stations as $station )
          <p>{{ $station->name }}</p>
        @endforeach

      @endforeach
    </body>
</html>
