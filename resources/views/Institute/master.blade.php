{{-- @include('Institute.header')
@yield('content')
@include('Institute.sidebar') --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Institute Dashboard')</title>

    <!-- Google Font: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap/css/bootstrap.min.css') }}">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('adminlte/css/adminlte.min.css') }}">

    <!-- Your custom styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>

    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    @include('Institute.header')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="{{ url('/institute/dashboard') }}" class="brand-link text-center">
            <span class="brand-text font-weight-light">Institute Panel</span>
        </a>

        <!-- Sidebar -->
        @include('Institute.sidebar')
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="content pt-3">
            @yield('content')
        </section>
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer text-center small">
        {{-- <strong>&copy; {{ date('Y') }} PMA.</strong> All rights reserved. --}}
    </footer>

</div> <!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>

<!-- Allow child blades to add JS -->
@stack('scripts')

</body>
</html>

