<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>
      @foreach ($station as $s)
        <p>This is the {{ $s->name }} station</p>
        @foreach ($s->readings as $reading )
          <p>{{ $reading->cfs }} CFS</p>
        @endforeach
      @endforeach
    </body>
</html>
