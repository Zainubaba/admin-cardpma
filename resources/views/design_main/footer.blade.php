<style>
/* Default styles (desktop) */
.logo-gop {
  width: 40px;
  margin-right: 10px;
}

.logo-main {
  width: 80px;
  margin-left: 10px;
}

.footer-text {
  font-size: 15px;
  margin-top: 10px;
  margin-left: 15px;
  display: inline-block;
  vertical-align: middle;
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
      <br>
      <div class="box" style="background-color: white">
        <img class="logo-gop" src="{!! asset('images/gop logo.png') !!}" />
        <small class="footer-text"><b>A Project of Government of Punjab</b></small>
        <img class="logo-main" src="{!! asset('images/logo.png') !!}" />
      </div>
    </div>
  </div>
</footer>



</html>


