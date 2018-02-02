<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Book</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Custom styles for this template -->
    <style media="screen">
      body {
            padding-top: 54px;
            font-size: 1.3rem;
          }

          @media (min-width: 992px) {
            body {
              padding-top: 56px;
            }
          }
    </style>

  </head>
  <body>

    @include('partials.menu')

    <div class="container">

      <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-10 mx-auto">
          @yield('content')
        </div>





    <!-- Bootstrap core JavaScript -->
    <!-- Ici le show, au lieu de fermer la section, on dit que c'est le contenu par default de la section('scripts')
    Si un autre blade fait appel a cette meme section alors il supprimera le contenu et le remplacera par le sien
    Si on veux garder le contenu du 'parent' on fait un @parent lors de l'utilisation de cette section dans
    un autre blade / Voir exemple dans index.blade.php -->
    @section('scripts')
    <script src="{{asset('js/app.js')}}"></script>
    @show
  </body>

</html>
