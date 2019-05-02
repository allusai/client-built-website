@extends('layout')

@section('title', 'Create New Camera')

@section('main')
  <h1>Register a New Camera</h1>
  <form method="post">
    @csrf
    <div class="form-group">
      <label for="deviceType">Device Type</label>
      <input type="text" id="deviceType" name="deviceType" class="form-control">
    </div>
    <div class="form-group">
      <label for="xLocation">X Location</label>
      <input type="text" id="xLocation" name="xLocation" class="form-control">
    </div>
    <div class="form-group">
      <label for="yLocation">Y Location</label>
      <input type="text" id="yLocation" name="yLocation" class="form-control">
    </div>

    <div class="form-group">
      <label for="status">Status</label>
      <input type="text" id="status" name="status" class="form-control">
    </div>
    <div class="form-group">
      <label for="dataLinkType">Data Link Type</label>
      <input type="text" id="dataLinkType" name="dataLinkType" class="form-control">
    </div>
    <div class="form-group">
      <label for="dataLink">Data Link</label>
      <input type="text" id="dataLink" name="dataLink" class="form-control">
    </div>
    <input type="submit" value="Login" class="btn btn-primary">
  </form>
@endsection
