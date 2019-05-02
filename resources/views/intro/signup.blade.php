@extends('layout')

@section('title', 'Sign Up')

@section('main')
  <h1>Sign Up</h1>
  <p>Already have an account? Please <a href="/login">Login</a></p>
  <form method="post">
    @csrf
    <div class="form-group">
      <label for="firstName">First Name</label>
      <input type="text" id="firstName" name="firstName" class="form-control">
    </div>
    <div class="form-group">
      <label for="lastName">Last Name</label>
      <input type="text" id="lastName" name="lastName" class="form-control">
    </div>
    <div class="form-group">
      <label for="username">Username</label>
      <input type="text" id="username" name="username" class="form-control">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" id="password" name="password" class="form-control">
    </div>
    <input type="submit" value="Sign Up" class="btn btn-primary">
  </form>
@endsection
