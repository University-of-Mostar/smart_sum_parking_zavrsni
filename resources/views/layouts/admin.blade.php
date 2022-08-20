<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Smart SUM parking - Admin panel</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('/admin_dashboard/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('/admin_dashboard/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/admin_dashboard/dist/css/adminlte.min.css') }}">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{ asset('/admin_dashboard/dist/img/faks_logo.png') }}" alt="AdminLTELogo" height="300" width="300">
  </div>
{{--  --}}
@if (Route::has('login'))
<div class="hidden fixed top-0 right-0 px-6 sm:block">
    @auth
        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
          </form>
    @else
        <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
        @endif
    @endauth
</div>
@endif
{{--  --}}
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>

      @auth
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
      </li>
      <li>
          <li class="nav-item d-none d-sm-inline-block">

            <a href="{{ route('logout') }}" class="nav-link" role="button">Logout</a>

      </li>
      @else
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('login') }}" class="nav-link">Log in</a>
      </li>
      @if (Route::has('register'))
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('register') }}">Register</a>
        @endif
        @endauth
    </ul>


  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('/admin_dashboard/dist/img/faks_logo.png') }}" alt="FPMOZ Logo" class="brand-image img-circle elevation-12" width="500" style="opacity: .8">
      <span class="brand-text font-weight-light">SMART SUM PARKING</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">

        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }} - {{ Auth::user()->user_type }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Pretraži" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item">
                <a href="{{ route('admin.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-th"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
          <li class="nav-item menu-closed">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-parking"></i>
              <p>
                Parkinzi
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('parking1.data') }}" class="nav-link">
                  <i class="fas fa-car nav-icon"></i>
                  <p>Parking - Sveučilište 1</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('parking2.data') }}" class="nav-link">
                  <i class="fas fa-car nav-icon"></i>
                  <p>Parking - Sveučilište 2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('parking3.data') }}" class="nav-link">
                  <i class="fas fa-car nav-icon"></i>
                  <p>Parking - Sveučilište 3</p>
                </a>
              </li>
            </ul>
          </li>

          {{-- <li class="nav-item">
            <a href="{{route('statisticsAll.index')}}" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Statistika
              </p>
            </a>
          </li> --}}
          <li class="nav-item menu-closed">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                Parkinzi - statistika
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('statistics1.index') }}" class="nav-link">
                  <i class="fas fa-car nav-icon"></i>
                  <p>Sveučilište 1 - statistika</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('statistics2.index') }}" class="nav-link">
                  <i class="fas fa-car nav-icon"></i>
                  <p>Sveučilište 2 - statistika</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('statistics3.index') }}" class="nav-link">
                  <i class="fas fa-car nav-icon"></i>
                  <p>Sveučilište 3 - statistika</p>
                </a>
              </li>
            </ul>
          </li>
          @if (Auth::user()->user_type=='admin' || Auth::user()->user_type=='super_admin')
          <li class="nav-item">
            <a href="{{ route('users.index') }}" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Korisnici
              </p>
            </a>
          </li>
          @endif
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    @yield('content')

  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2021 &nbsp;&nbsp;&nbsp;<a href="#">Mirko Miličić - završni rad ->  Implementacija programske podrške za praćenje aktivnosti parking senzora na pametnom parkingu</a></strong>
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1.1
    </div>
  </footer>
</div>
<!-- ./wrapper -->


<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('/admin_dashboard/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('/admin_dashboard/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/admin_dashboard/dist/js/adminlte.js') }}"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('/admin_dashboard/plugins/jquery-mousewheel/jquery.mousewheel.js') }}"></script>
<script src="{{ asset('/admin_dashboard/plugins/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('/admin_dashboard/plugins/jquery-mapael/jquery.mapael.min.js') }}"></script>
<script src="{{ asset('/admin_dashboard/plugins/jquery-mapael/maps/usa_states.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('/admin_dashboard/plugins/chart.js/Chart.min.js') }}"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/admin_dashboard/dist/js/demo.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('/admin_dashboard/dist/js/pages/dashboard2.js') }}"></script>

<script>
    /** add active class and stay opened when selected */
  var url = window.location;

  // for sidebar menu entirely but not cover treeview
  $('ul.nav-sidebar a').filter(function() {
      return this.href == url;
  }).addClass('active');

  // for treeview
  $('ul.nav-treeview a').filter(function() {
      return this.href == url;
  }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');
   </script>

</body>
</html>
