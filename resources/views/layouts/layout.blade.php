<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="{{asset('assets/bootstrap/bootstrap.min.css')}}">

    <title>{{auth()->user()->role == 1 ? 'Admin' : 'Student'}} - Attendance</title>
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top ">
        <div class="container">
          <a class="navbar-brand" href="{{route('home')}}">Attendance System</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
              </li>
              @if (auth()->user()->role == 1)
              <li class="nav-item">
                <a class="nav-link" href="{{route('attendance.index')}}">Attendance</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('leave.index')}}">Leave</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('students.index')}}">Students</a>
              </li>
              @else
              <li class="nav-item">
                <a class="nav-link" href="{{route('std.leave.index')}}">Leave</a>
              </li>
              @endif
              
            </ul>
            <a href="{{route('profile.index')}}" class="btn btn-primary me-2 ">{{auth()->user()->name}} - Profile</a>
            <a href="{{route('logout')}}" class="btn btn-danger">Logout</a>
          </div>
        </div>
      </nav>
      
@yield('content')

    <script src="{{asset('assets/bootstrap/bootstrap.bundle.min.js')}}"></script>
</body>
</html>