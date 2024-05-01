
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/') }}plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/') }}dist/css/adminlte.min.css">
  <link rel="stylesheet" href="{{ asset('style/style.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.min.css') }}"
</head>
<body onload="initClock()" class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-primary navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link text-white ml-4">
            <span id="dayname">Day</span>,
            <span id="daynum">00</span>
            <span id="month">Month</span>
            <span id="year">Year</span>
            </a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a class="nav-link text-white">
            <span id="hour">00</span>:
            <span id="minutes">00</span>:
            <span id="seconds">00</span>
            <span id="period">AM</span>
            </a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <div class="icon ml-auto">
        <h5>
            <i class="fa-solid fa-user mr-3" style="color: #e6e6e6;"></i>
            <a class="navbar-brand text" href="#">Admin</a>
        </h5>
    </div>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ asset('/') }}index3.html" class="brand-link">
      <img src="{{ asset('img/LogoPolinema.png') }}" alt="Polinema Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-bold">SPI POLINEMA</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      @if (auth()->check())
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <i class="fa-solid fa-user img-circle elevation-2" style="color: #e6e6e6;" alt="User Image"></i>
        </div>
        <div class="info">
          <a class="text-bold text-primary" href="#" class="d-block">
            {{ auth()->user()->name }}
          </a>
        </div>
      </div>
      @endif



      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview"
        role="menu" data-accordion="false">
            @include('layout.menu')
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    {{-- <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
                @yield('judul')
            </h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section> --}}

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      @yield('isi')
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer bg-primary">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright © 2024 <a class="ml-2" href="#">Satuan Pengawas Internal - Politeknik Negeri Malang</a></strong>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-primary">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

<!-- Date Time -->
<script type="text/javascript">
    function updateClock(){
       var now = new Date();
       var dname = now.getDay(),
           mo = now.getMonth(),
           dnum = now.getDate(),
           yr = now.getFullYear(),
           hou = now.getHours(),
           min = now.getMinutes(),
           sec = now.getSeconds(),
           pe = "AM";

           if(hou == 0){
               hou = 12;
           }
           if(hou > 12){
               hou = hou - 12;
               pe = "PM";
           }

           Number.prototype.pad = function(digits){
               for(var n = this.toString(); n.length < digits; n = 0 + n);
               return n;
           }

           var months = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
           var week = ["Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
           var ids = ["dayname","month","daynum","year","hour","minutes","seconds","period"];
           var values = [week[dname], months[mo], dnum.pad(2), yr, hou.pad(2), min.pad(2), sec.pad(2), pe];
           for(var i = 0; i < ids.length; i++)
           document.getElementById(ids[i]).firstChild.nodeValue = values[i];
    }
    function initClock(){
       updateClock();
       window.setInterval("updateClock()", 1);
    }
    </script>

<!-- jQuery -->
<script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/') }}dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/') }}dist/js/demo.js"></script>
</body>
</html>
