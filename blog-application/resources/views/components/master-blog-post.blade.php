<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Blog Post - Start Bootstrap Template</title>

  <!-- Bootstrap core CSS -->
  <link href="{{asset('css/app.css')}}" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="{{asset('css/blog-post.css')}}" rel="stylesheet">

</head>

<body>

  <!-- Navigation -->
  
  <x-nav></x-nav>

  <!-- Page Content -->
  <div class="container">

    <div class="row">

      <div class="col-lg-8">
      <!-- Post Content Column -->
           
          @yield('content')

      </div>


    </div>
           <!-- Sidebar Widgets Column -->
  <div class="col-md-4">

        <!-- Search Widget -->

          <x-search></x-search>


        <!-- Categories Widget -->
        <x-categories></x-categories>

        <!-- Side Widget -->
        <x-side-widget></x-side-widget>

      </div>

    </div>
    <!-- /.row -->

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2019</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
