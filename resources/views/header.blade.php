<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      {{-- <a class="navbar-brand" href="#"><img src="/public/images/logo.png" alt="Logo"></a> --}}
      <a class="navbar-brand" href="#"><img src="{{ asset('images/logo.png') }}" height="75" width="150" alt="Logo"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/list">Employee List</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Dropdown
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>

        @if (session('admin'))
        <form class="d-flex m-1" action="/logout" method="POST">
            @csrf
            <button type="submit" class="btn btn-lg btn-warning">Admin Logout</button>
        </form>
        @elseif(!session("employee"))
          <form class="d-flex m-1" action="/login" method="get">
              @csrf
              <button type="submit" class="btn btn-lg btn-warning">Admin Login</button>
          </form>
        @endif
        @if (session('employee'))
        <form class="d-flex m-1" action="/employee/logout" method="POST">
          @csrf
          <button type="submit" class="btn btn-lg btn-info">Employee Logout</button>
        </form>
        @elseif(!session("employee") && !session("admin"))
        <form class="d-flex m-1" action="/employee/login" method="GET">
          @csrf
          <button type="submit" class="btn btn-lg btn-info">Employee Login</button>
        </form>
        @endif
      </div>
    </div>
  </nav>