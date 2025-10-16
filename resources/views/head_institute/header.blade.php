
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/img/C favicon-01.png" />
    <title>Dashboard</title>

    <!-- Google Font: Inter -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
    <style>
        /* :root {
            --primary-bg: #3cbcca;
            --accent-color: #f8fdff;
            --text-dark: #1A2C34;
            --text-light: #FFFFFF;
        } */

    body {
        font-family: 'Inter', sans-serif;
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
    .navbar-center {
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    align-items: center;
    gap: 10px;
}


        /* .navbar-title {
            flex-grow: 1;
            text-align: center;
            font-size: 2rem;
            font-weight: 800;
            color: var(--primary-bg);
        } */
    </style>
</head>
<body class="sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-light bg-success text-white">
            
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                        <i class="fas fa-bars"></i>
                    </a>
                    
                    </li>
         
                    <li class="nav-item ">
                        
                                           @if(Auth::user()->name == 'SED')
       <img src="/images/HEDD.png" alt="Government of Punjab Logo" class="navbar-logo" style="height: 30px; margin-top:6px;">
    @elseif(Auth::user()->name == 'HED')
       <img src="/images/HEDD.png" alt="Government of Punjab Logo" class="navbar-logo">
    @elseif(Auth::user()->name == 'TEVTA')
     <img src="/TEVTA.png" alt="Government of Punjab Logo" class="navbar-logo">
    @endif
                </li>
            
                

                 {{-- <div class="navbar-title">Head Institute Dashboard</div> --}}
                <li class="nav-item">
                    <div class="navbar-title">
         
                    </div>
                </li>
            </ul>
            <div class="navbar-center">
             @if(Auth::user()->name == 'SED')
     <div class="navbar-title">School Education Department</div>
    @elseif(Auth::user()->name == 'HED')
       <div class="navbar-title">Higher Education Department</div>
    @elseif(Auth::user()->name == 'TEVTA')
      <div class="navbar-title">TEVTA</div>
    @endif
            </div>
            
            <ul class="navbar-nav ml-auto">
                <!-- Fullscreen expander removed -->
            </ul>
        </nav>
    </div>

    <!-- Scripts -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../dist/js/adminlte.min.js"></script>
    <script>
        // $(document).ready(function() {
        //     // Ensure pushmenu toggle works only on click
        //     $('[data-widget="pushmenu"]').on('click', function(e) {
        //         e.preventDefault();
        //         $('body').toggleClass('sidebar-collapse');
        //     });
        // });
    </script>
</body>
</html>
