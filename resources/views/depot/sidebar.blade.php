<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<style>
    body {
      font-family: 'Poppins';
    }

    .sidebar {
        height: 150%;
        margin-top: 70px;
        width: 0;
        position: absolute;
        z-index: 1;
        top: 0;
        left: 0;
        /* background-color: #905352; */
        background: linear-gradient(to bottom, rgba(19, 14, 65, 0.6) 0%, rgba(19, 14, 65, 0.6)100%);
        overflow: hidden;
        border-radius: 0px 0px 20px;
        padding-top: 60px;
    }


    .sidebar a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 20px;
        color: #FFFFFF;
        display: block;

    }

    .sidebar a:hover {
        background-color: rgb(143, 169, 185);
    }
   

    .sidebar .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 20px;
        margin-left: 50px;
    }

    .openbtn {
        font-size: 20px;
        cursor: pointer;
        /* background-color: #8B0000; */
        background: transparent;
        color: white;
        border: none;
        margin-top: 10px;
        margin-left: 30px;
        position: relative;
        top: -90px;
        /* padding: 2px; */
        border-radius: 4px;
    }

    .openbtn:hover {
        background-color: rgb(56, 90, 141);
    }
    #main {
        transition: margin-left .5s;
        padding: 16px;
    }

    /* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
    @media screen and (max-height: 600px) {
        .sidebar {
            padding-top: 15px;
        }

        .sidebar a {
            font-size: 18px;
        }

        .sidebar {
            width: 30
        }
    }
</style>
</head>

<body>
    <button class="openbtn" onclick="openNav()">☰</button>
    <div id="mySidebar" class="sidebar" style="width:250px;">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
        <a class="nav-link collapsed" style="display:block;" href="/onlineform" >
          <i class="fa fa-address-book-o" aria-hidden="true"></i>
          <span style="">Form</span>
        </a>
        {{-- <a class="nav-link collapsed" style="display:block;"  href="/formlist">
          <i class="fa fa-book"></i>
          <span style="">Submitted Forms</span>
        </a> --}}
        <a class="nav-link collapsed" style="display:block;"  href="/verify">
          <i class="fa fa-book"></i>
          <span style="">Verification</span>
        </a>
        <a class="nav-link collapsed" style="display:block;"  href="/printcard">
          <i class="fa fa-book"></i>
          <span style="">Print Card</span>
        </a>
        <a class="nav-link collapsed" style="display:block;"  href="/dispatch">
          <i class="fa fa-book"></i>
          <span style="">Dispatch</span>
        </a>
        <a class="nav-link collapsed" style="display:block;" href="{{ route('logout') }}"
            onclick="event.preventDefault();  document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out"></i>
            <span style=""> {{ __('Logout') }}</span>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>

        </li>
    </div>






    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
            document.getElementById("main").style.marginLeft = "0";
        }
    </script>


