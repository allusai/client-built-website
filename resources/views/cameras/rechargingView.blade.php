<!doctype html>
<html>
    <head>
        <meta charset="utf-8">

    </head>
    <body>
          @extends('layout')

    @section('title', 'Currently Charging Cameras')
    @section('main')

    <h1 text-align="center"> Currently Charging Cameras </h1>
    
          <table class="table">
            <tr>
              <th>Camera</th>
            </tr>
                @forelse($rechargeList as $cam)
              <tr>
                <td>
                   {{ $cam['deviceType'] }}
                   {{ $cam['status'] }}

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
