<!doctype html>
<html>
    <head>
        <meta charset="utf-8">

    </head>
    <body>
          @extends('layout')

    @section('title', 'Multiple Cameras View')
    @section('main')

    <h1 text-align="center"> Multiple Cameras View </h1>
          

          <table class="table">

                @forelse($cameras as $camera)
              <tr>
                <td>

                    <iframe width="420" height="315"
                      src="{{$camera['dataLink']}}">
                    </iframe>

                </td>
                <td>
                    <a href="/move/{{$camera['deviceId']}}"> Move </a>

                    <form action="/recharge/{{$camera['deviceId']}}" method="POST">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <a href="#" onclick="this.parentNode.submit()">Recharge</a>
                    </form>

                    <a href="/remove/{{$camera['deviceId']}}"> Remove </a>
                </td>
              </tr>


            @empty
              <tr>
                <td colspan="1">No cameras found</td>
              </tr>

                @endforelse
          </table>

          @endsection
    </body>
</html>
