<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <a class="navbar-brand" href="{{asset('index.php')}}">Book</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="{{asset('index.php')}}">Accueil
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('genre' , 1)}}">{{ucfirst($genres[1])}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('genre', 2)}}">{{ucfirst($genres[2])}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('genre', 3)}}">{{ucfirst($genres[3])}}</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
