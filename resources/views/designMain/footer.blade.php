<style>
/* Default styles (desktop) */
.logo-gop {
  width: 70px;
  margin-right: 10px;
}

.logo-main {
  width: 110px;
  margin-left: 10px;
}

.footer-text {
  font-size: 15px;
  margin-top: 10px;
  margin-left: 15px;
  display: inline-block;
  vertical-align: middle;
}

.box {
  background-color: #1e8057;
  display: flex;
  align-items: center;
  justify-content: space-between; /* space between left and right groups */
  padding: 8px 20px;
}

.left-logos {
  display: flex;
  align-items: center;
}

body {
  margin: 0;
  padding: 0;
}

footer .col-sm-12 {
  padding-left: 0 !important;
  padding-right: 0 !important;
}


/* Tablet: 768px and below */
@media screen and (max-width: 768px) {
  .logo-gop {
    width: 35px;
  }

  .logo-main {
    width: 60px;
  }

  .footer-text {
    font-size: 13px;
    margin-top: 10px;
  }
}

/* Mobile: 500px and below */
@media screen and (max-width: 500px) {
  .logo-gop {
    width: 30px;
  }

  .logo-main {
    width: 45px;
  }

  .footer-text {
    font-size: 9px;
    margin-top: 5px;
    margin-left: 8px;
  }
}
</style>

<footer class="sticky-footer fixed bottom bg-white" style="color: #7d0000; margin-top:55px; width:100%">
  <div class="col-sm-12 pb-0px margin-bottom:0px">
    <div class="copyright text-center my-auto">
      {{-- <br> --}}
      <div class="box" style="background-color: #1e8057">
        <div class="left-logos">
        <img class="logo-gop" src="{!! asset('images/pitb.png') !!}" />
        <img class="logo-gop" src="{!! asset('images/bop.png') !!}" />
        <img class="logo-gop" src="{!! asset('images/Hed1.png') !!}" />
        </div>
        {{-- <img class="logo-gop" src="{!! asset('images/gop logo.png') !!}" /> --}}
        {{-- <small class="footer-text"><b>A Project of Government of Punjab</b></small> --}}
        {{-- <img class="logo-main" src="{!! asset('images/logo.png') !!}" /> --}}
        <div class="left-logos">
        <img class="logo-gop" src="{!! asset('images/schooledu.png') !!}" />
        <img class="logo-gop" src="{!! asset('images/pvtd.jpg') !!}" />
        <img class="logo-gop" src="{!! asset('images/tevta-logo.png') !!}" />
      </div>
      </div>
    </div>
  </div>
</footer>



</html>


