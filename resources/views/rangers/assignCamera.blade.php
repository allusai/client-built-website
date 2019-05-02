@extends('layout')

@section('title', 'Assign New Camera For Self')

@section('main')
  <h1>Assign Camera</h1>
  <form method="post">
    @csrf
    <div class="form-group">
      <label for="ranger">Ranger Name</label>
      <p></p>
        <select name="ranger">
            @foreach($rangers as $ranger)
              <option value="{{ $ranger['rangerId'] }}">{{ $ranger['firstName'] }} {{ $ranger['lastName'] }}</option>
            @endforeach
        </select>
      <p></p>
    </div>
    <div class="form-group">
      <label for="camera">Select Camera</label>
      <p></p>
      <select name="cameras_selected[]" id="inscompSelected" multiple="multiple" class="form-control multiple " size="10">
            @foreach($cameras as $cam)
              <option value="{{ $cam['deviceId'] }}">{{ $cam['deviceType'] }}</option>
            @endforeach
      </select>
    </div>
    <input type="submit" value="Submit" class="btn btn-primary">
  </form>
@endsection
