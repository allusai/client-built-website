<!doctype html>
<html>
    <head>
        <meta charset="utf-8">

    </head>
    <body>
          @extends('layout')

    @section('title', 'Dashboard')
    @section('main')

    <h1 text-align="center"> Ranger Dashboard </h1>
    
          <table class="table">
            <tr>
              <th>Camera</th>
            </tr>
                @forelse($cameras as $camera)
              <tr>
                <td>

                    {{$camera->deviceId}}
                    {{$camera->dataLink}}

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
