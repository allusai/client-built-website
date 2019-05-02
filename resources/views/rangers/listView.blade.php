<!doctype html>
<html>
    <head>
        <meta charset="utf-8">

    </head>
    <body>
          @extends('layout')

    @section('title', 'Ranger List')
    @section('main')

    <h1 text-align="center"> Active Rangers </h1>
    
          <table class="table">
            <tr>
              <th>Camera</th>
            </tr>
                @forelse($rangers as $ranger)
              <tr>
                <td>
                   {{ $ranger['firstName'] }}
                    

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
