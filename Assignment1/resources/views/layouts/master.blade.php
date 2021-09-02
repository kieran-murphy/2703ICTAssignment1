<!doctype html>
<html>
<head>
    <title>@yield('title')</title>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
   
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar navbar-success bg-success">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Fleet</a>
    <button
      class="navbar-toggler"
      type="button"
      data-mdb-toggle="collapse"
      data-mdb-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Create</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Details</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <div class="content">
        @yield('content')
    </div>
    
</body>
</html>