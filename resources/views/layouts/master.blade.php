<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Book</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Custom styles for this template -->
    <style media="screen">
      body {
            padding-top: 54px;
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
    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
  </body>

</html>
