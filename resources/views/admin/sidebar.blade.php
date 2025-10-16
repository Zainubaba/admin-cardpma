<link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha512-10/jx2EXwxxWqCLX/hHth/vu2KY3jCF70dCQB8TSgNjbCVAC/8vai53GfMDrO2Emgwccf2pJqxct9ehpzG+MTw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    body {
      font-family: 'Poppins';
    }

    .sidebar {
        height: 90%;
        margin-top: 70px;
        width: 0;
        position: absolute;
        z-index: 1;
        top: 0;
        left: 0;
        /* background-color: #905352; */
        background: linear-gradient(to bottom, rgba(19, 14, 65, 0.6) 0%, rgba(19, 14, 65, 0.6)100%);
        overflow-x: hidden;
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
        background-color: blue;
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
        <a class="nav-link collapsed" style="display:block;" href="/createaccount" >
          {{-- <i class="fas fa-address-book-o" aria-hidden="true"></i> --}}
          <i class="fa-solid fa-address-book"></i>
          
          <span style="">Create Account</span>
        </a>
        <a class="nav-link collapsed" style="display:block;"  href="/adminstatus">
          <i class="fa fa-book"></i>
          <span style="">Status</span>
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
    <script src="https://kit.fontawesome.com/baf8bd21df.js" crossorigin="anonymous"></script>


    {{-- <div class="sidenav" id="mySidebar">

<!-- <a class="sidebar-brand-md d-flex align-items-center justify-content-center" href=""> -->
<a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a class="nav-link collapsed" style="display:block;" href="/createaccount" >
      <i class="fa fa-address-book-o" aria-hidden="true"></i>
      <span style="">Create Account</span>
    </a>

    <a class="nav-link collapsed" style="display:block;"  href="/adminstatus">
      <i class="fa fa-book"></i>
      <span style="">Status</span>
    </a>
  
  
</div>
    
  <button class="openbtn" id="main" onclick="openNav()" style = "">&#9776;</button>

<style>
    @media screen and (max-width: 2000px){

      .openbtn{
  display: none;
  
      }
      #mySidebar{
        display:block;
       
      }

    }


  @media screen and (max-width: 500px){
  #mySidebar a {
  text-decoration: none;
  font-size: 3px;
  color: #818181;

  

}

#mySidebar{
    height: 150px;
    width: 200px;
    margin-left:0px;
    position: absolute;
    background-color:#905352;
    display:none;
  
  }
  
.openbtn{
  background-color:#905352;
  margin-top:0px;
  display:block;
  


  
}
.closebtn{
  color: black;
  
  
}
.closebtn:hover{
  color: black;
  border: solid 1px #blue;
}
  .openbtn:hover {
  background-color: #444;
  color: red;
}
#mySidebar .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  left: 25px
  font-size: 36px;
  margin-left: 50px;
}
  }

  </style>
   <script>


    function openNav() {
   
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("main").style.display = "none";
   document.getElementById("main").style.marginLeft = "20px";
   
}

  function closeNav() {
    document.getElementById("mySidebar").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
    document.getElementById("main").style.display = "block";
}
    </script>


   --}}


  