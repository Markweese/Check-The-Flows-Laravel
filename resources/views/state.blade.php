<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

    </head>
    <body>
      @foreach ($state as $s)
        <h2>This is state: {{ $s->name }}</h2>
        @foreach ($s->stations as $station )
          <a href="/stations/{{$station->id}}">{{ $station->name }}</a>
          @foreach($station->readings as $reading)
            <p>{{$reading->cfs}} CFS at {{$reading->reading_time}}</p>
          @endforeach
        @endforeach
      @endforeach
    </body>
</html>
