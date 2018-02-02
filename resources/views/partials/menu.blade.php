<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <!-- <a class="navbar-brand" href="{{asset('index.php')}}">Book</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> -->
    <div class="collapse navbar-collapse" id="navbarResponsive" style="font-size:1.5rem;">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{asset('index.php')}}">Accueil
            <span class="sr-only">(current)</span>
          </a>
        </li>
        @if(Route::is('book.*') == false)
        @forelse($genres as $id => $name)
        <li class="nav-item">
          <a class="nav-link" href="{{url('genre' , $id)}}">{{ucfirst($name)}}</a>
        </li>
        @empty
        <li class="nav-item">
          Aucun genre pour l'instant
        </li>
        @endforelse
        @endif
      </ul>
    </div>
    <div class="collapse navbar-collapse" style="font-size:1.5rem;">
      <ul class="navbar-nav ml-auto">
        @if(Auth::check())
        <li class="nav-item">
          <a class="nav-link" href="{{route('book.index')}}">Dashboard
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </li>
          @else
          <li class="nav-item">
            <a class="nav-link" href="{{route('login')}}">Login
            </a>
          </li>
          @endif
      </ul>
    </div>
  </div>
</nav>
