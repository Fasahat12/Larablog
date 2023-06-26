<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-md">
      <a id="logo" class="navbar-brand" href="/">Larablog</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          @guest
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/login">Login</a>
          </li>             
          <li class="nav-item">
            <a class="nav-link" href="/register">Register</a>
          </li>
          @endguest
          @auth
          @if (request()->is('/'))
          <li class="nav-item">
            @php
              $firstName = explode(" ",auth()->user()->name)[0];   
            @endphp
            <a class="nav-link" href="#" style="font-style:italic;">Welcome, {{ $firstName }}</a>
          </li>              
          @endif
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="/posts/manage">Manage Post</a>
          </li>
          <li class="nav-item">
              <form action="/logout" method="POST">
                @csrf
                <a href="#" class="nav-link" onclick="document.querySelector('form').submit();">Logout</a>
              </form>            
          </li>                                 
          @endauth
        </ul>
      </div>
    </div>
  </nav>
