<!doctype html>
<html>
    <head>
        <meta charset="utf-8">

    </head>
    <body>
          @extends('layout')

    @section('title', 'Single Camera View')
    @section('main')

    <h1 text-align="center"> Individual Camera View </h1>
          
          <iframe width="420" height="315"
            src="{{$camera[0]['dataLink']}}">
          </iframe>

          @endsection
    </body>
</html>
