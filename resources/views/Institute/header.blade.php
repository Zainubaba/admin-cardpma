<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="/img/C favicon-01.png" />
  <title>Institute Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
    <!-- Google Font: Inter -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    {{-- link for bootstrap icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

  <style>
    /* :root {
      --primary-bg: #3cbcca;
      --accent-color: #f8fdff;
      --text-dark: #1A2C34;
      --text-light: #FFFFFF;
    } */

    body {
      font-family: 'Inter', sans-serif;
      /* background-color: var(--primary-bg); */
      /* color: var(--text-dark); */
      font-size: 14px;
        background-color: #f4f6f9;
        color: #333;
    }

    .navbar {
        min-height: 64px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
         box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    z-index: 1030;
    }

    .navbar .navbar-nav .nav-link {
        font-weight: 500;
        color: #fff !important;
    }

    .navbar-brand-title {
        font-size: 18px;
        font-weight: 600;
        color: #fff;
        margin-bottom: 0;
    }

    .navbar-subtitle {
        font-size: 8px;
        font-weight: 400;
        color: #e0e0e0;
    }

    .navbar-center-title {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        flex-grow: 1;
        pointer-events: none; /* So it doesn't block clicks on other elements */
    }

    .form-control-navbar {
        border-radius: 20px;
        padding: 0.375rem 0.75rem;
        font-size: 13px;
    }

    .input-group-append .btn {
        border-radius: 20px;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light bg-success text-white">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars"></i></a>
          
        </li>
      </ul>

      {{-- <div class="navbar-title">Institute Dashboard</div> --}}

  <div class="navbar-center-title">
      <span  class="navbar-brand-title" >{{Auth::user()->name}}</span>
   
  
</div>

      <ul class="navbar-nav ml-auto">
        <!-- Optional right nav items -->
      </ul>
    </nav>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://www.amcharts.com/lib/4/core.js"></script>
    <script src="https://www.amcharts.com/lib/4/charts.js"></script>
    <script src="https://www.amcharts.com/lib/4/themes/animated.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="../../plugins/chart.js/Chart.min.js"></script>
<!-- overlayScrollbars -->
    <script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
  <script>
    // $(document).ready(function () {
    //   $('[data-widget="pushmenu"]').on('click', function (e) {
    //     e.preventDefault();
    //     $('body').toggleClass('sidebar-collapse');
    //   });
    // });
  </script>
</body>


