<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{$title}}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="{{base_url('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{base_url('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <link rel="stylesheet" href="{{base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{base_url('assets/plugins/jqvmap/jqvmap.min.css')}}">
  <link rel="stylesheet" href="{{base_url('assets/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{base_url('assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <link rel="stylesheet" href="{{base_url('assets/plugins/daterangepicker/daterangepicker.css')}}">
  <link rel="stylesheet" href="{{base_url('assets/plugins/summernote/summernote-bs4.css')}}">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="shortcut icon" href="<?= base_url('assets/dist/img/Teladan.png'); ?>">
  <!-- <link rel="stylesheet" href="{{base_url('assets/DataTables/datatables.min.css')}}"> -->
  @yield('scripts-css')
  <!-- PANGGIL UNTUK INJEK CSS KE TEMPAT INI -->
</head>

<body class="hold-transition text-sm sidebar-mini layout-fixed">
  <script src="{{base_url('assets/DataTables/datatables.min.js')}}"></script>
  <div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <form class="form-inline ml-3">
      </form>
    </nav>
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <a href="{{base_url('admin')}}" class="brand-link">
        <img src="{{base_url('assets/dist/img/TeladanPutih.png')}}" alt="Teladan Logo" width="50" height="30" style="opacity: .8">
        <span class="brand-text font-weight-light">&ensp;Sekolah Teladan Yogyakarta</span>
      </a>
      <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="{{base_url('assets/dist/img/user.png')}}" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <?php if ($this->session->userdata('logged_in')) : ?>
              <a href="#" class="d-block"><?= $this->session->userdata('nama'); ?></a>
            <?php endif; ?>
          </div>
        </div>
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat" data-widget="treeview" role="menu" data-accordion="false">
            @include('template/menu/admin/menu')
          </ul>
        </nav>
      </div>
    </aside>
    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div align="center">
            <br>
            <h1 class="m-0 text-dark">{{$title}}</h1>
            <br>
          </div>
        </div>
      </div>
      <section class="content">
        <div class="container-fluid">
          @yield('content')
          <!-- PANGGIL UNTUK INJEK CONTENT KE TEMPAT INI -->
        </div>
      </section>
    </div>
    <footer class="main-footer">
      <strong>Copyright &copy; 2020 <a href="#">Sekolah Teladan Yogyakarta</a></strong>
      <div class="float-right d-none d-sm-inline-block">
      </div>
    </footer>
  </div>
  <script src="{{base_url('assets/plugins/jquery/jquery.min.js')}}"></script>
  <script src="{{base_url('assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <script src="{{base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{base_url('assets/plugins/moment/moment.min.js')}}"></script>
  <script src="{{base_url('assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <script src="{{base_url('assets/dist/js/adminlte.js')}}"></script>
  <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
  <script type="text/javascript">
    $(function() {
      $(":text.form-control").response(function() {
        $("#formDirektur").hide()
        if ($(this).val() != NULL) {
          $("#formDirektur").show();
        } else {
          $("#formDirektur").hide();
        }
      });
    });
  </script>
  <script src="{{base_url('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
  
  @yield('scripts-js')
</body>

</html>