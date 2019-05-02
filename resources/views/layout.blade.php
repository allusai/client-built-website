
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">

  <!-- This places a title specific to what the page is-->
  <!-- Yield tags are like copy and paste -->
  <title>@yield('title')</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
</head>
<body>
  <div class="container-fluid">
    <ul class="nav">
      @if (Auth::check())
        <li class="nav-item">
          <a href="/profile" class="nav-link">Profile</a>
        </li>
        <li class="nav-item">
          <a href="/tracks" class="nav-link">Tracks</a>
        </li>
        <li class="nav-item">
          <a href="/logout" class="nav-link">Logout</a>
        </li>
      @else
        <li class="nav-item">
          <a href="/login" class="nav-link">Login</a>
        </li>
        <li class="nav-item">
          <a href="/signup" class="nav-link">Sign Up</a>
        </li>
        <li class="nav-item">
          <a href="/headquarters" class="nav-link">Headquarters</a>
        </li>
        <li class="nav-item">
          <a href="/addDevice" class="nav-link">Register New Camera</a>
        </li>
        <li class="nav-item">
          <a href="/assignCamera" class="nav-link">Assign Camera to Ranger</a>
        </li>
        
      @endif
    </ul>

    @yield('main')
  </div>
</body>
</html>

<!--  So all this stuff it's basically like anythign that extends/implements 'layout' with a tag,
            it can use this template for other styling. So all the pages will look similar. -->
