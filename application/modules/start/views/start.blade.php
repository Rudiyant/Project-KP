<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="{{base_url('assets/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="{{base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{base_url('assets/dist/css/adminlte.min.cs')}}s">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><img src="{{base_url('assets/dist/img/Teladan.png')}}" alt="Teladan Logo" width="92" height="60"></a>
    </div>
    <!-- /.login-logo -->
    <br>
    <div class="card">
      <div class="card-body login-card-body">
        <h4 class="login-box-msg">Login</h4>

        <form action="{{base_url('start/authenticate')}}" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Username" name="username">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-4">
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Login</button>
            </div>
            <div class="col-4">
            </div>
          </div>
          <br>
          <div align="center">
            <?= $this->session->flashdata('failed'); ?>
            <?= $this->session->flashdata('logout'); ?>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="{{base_url('assets/plugins/jquery/jquery.min.js')}}"></script>
  <script src="{{base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{base_url('assets/dist/js/adminlte.min.js')}}"></script>

</body>

</html>