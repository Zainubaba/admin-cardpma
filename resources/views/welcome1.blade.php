@extends('designMain.s')
@section('content')

<!-- Bootstrap 4 -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
      integrity="sha512-dXQkGgE/6o4sKzCVW1E9hHBo0gDsnj6GLzGl+iBsbw60Vh4XcO9N2fK3y4KJQKDXE1pAw4K1/5bGz1kck9XQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />
<style>



/* Other CSS */
.portal-heading-h {
    font-weight: 900 !important;
    font-size: 3.6rem;
    /* font-family: 'Jameel Noori Nastaleeq', serif; */
  }

.portal-heading {
    font-weight: 900 !important;
    font-size: 2.4rem;
    font-family: 'Jameel Noori Nastaleeq', serif;
  }

  .card-custom {
  position: relative;
  border-radius: 15px;
  overflow: visible;
  padding-top: 120px;
  text-align: center;
  direction: rtl; /* Urdu text alignment */
  font-family: 'Jameel Noori Nastaleeq', serif;
  box-shadow: 6px 6px 0 rgba(0, 0, 0, 0.15);
  transition: transform 0.2s ease;
   max-width: 200px; /* 👈 reduces card width */
  margin: 0 auto;
}
.card-custom:hover {
  transform: translateY(-5px);
}
.icon-circle {
  position: absolute;
  top: -25px;
  left: 50%;
  transform: translateX(-50%);
  background-color: #1e8057;
  color: white;
  border-radius: 50%;
  width: 50px;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  box-shadow: 0 0 5px rgba(0,0,0,0.2);
}
.card-custom h5 {
  margin-top: 15px;
  font-weight: 700;
}
.card-custom p {
  margin-bottom: 5px;
}
.see-more {
  color: #ffffff;
  background-color: #80a840;
  /* font-weight: 900; */
  padding: 2px 12px;         /* space around text */
  border-radius: 6px;        /* rounded edges */
  display: inline-block;     /* restricts background to text width */
  text-decoration: none;     /* removes underline */
  width: auto !important;    /* overrides Bootstrap’s link width */
  text-align: center;
  direction: rtl;            /* ensures Urdu alignment */
}


p {
  color: #000000;
  font-weight: 900;
}

.white{
color:white;

}

a:hover {
  color: #c9c9c9; /* A hex code for dark grey */
  text-decoration: none; /* Explicitly removes the underline on hover */
}


  /* media querry */
  @media screen and (max-width:600px){
    .fc h1 span a{
      font-size: 16px;
      margin-top: 10px;

    }

    
  }
/* body{
  background-image: url("/images/pic1.png");
  /* background-color: #013B7c; */
  background-repeat: no-repeat, repeat;
  background-size: cover;



/* } */

body {
            background: linear-gradient(to bottom, rgba(62, 54, 173, 0.6) 0%, rgba(62, 54, 173, 0.6) 100%), url(images/welcome.png) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            font-family: 'Poppins';

        }
.col-md-7{
    font-size: 60px;
    font-family: 'poppins-bold', sans-serif !important;
    padding-top:70px;
    padding-left:10px;

}





</style>


<body>

 {{-- Language toggle --}}
 <x-language-toggle />



{{-- {{ app()->getLocale() }} --}}
<div class="text-center">
<h1 class=" portal-heading-h text-body text-center" style="">{{ __('message.card_heading1') }}</h1>
  {{-- <h1 class="display-4 portal-heading-h text-body text-center" style="font-size:80px;">طلباء کے لیے ٹی کیش کارڈ پورٹل</h1> --}}
<p class="d-inline-block portal-heading text-white text-center  " style="font-size: {{ app()->getLocale() == 'en' ? '21px' : '36px' }}; background-color: #1e8057">{{ __('message.card_heading2') }}</p>
</div>

<div class="container mt-5">
  <div class="row">

    

    
    <!-- HED -->
    <div class="col-md-4 mb-4">
      <div class="card card-custom p-3" style="background-color:#1e8057;">
        <div class="icon-circle" style="background-color:white;"><i class="fas fa-university" style="background-color:#1e8057;"></i></div>
        <h5 class="white">{{ __('message.cardhed_heading') }}</h5>
        <p class="white">(Admin HED)</p>
        <p class="white">{{ __('message.cardhed_desc') }}</p>
        <div class="text-center">
        <a href="/login" class="see-more" style="background-color:#5dd198;">{{ __('message.view_more') }}</a>
      </div>
      </div>
    </div>

        <!-- SED -->
    <div class="col-md-4 mb-4">
      <div class="card card-custom p-3">
        <div class="icon-circle"><i class="fas fa-school"></i></div>
        <h5>{{ __('message.cardsed_heading') }}</h5>
        <p >(Admin SED)</p>
        <p>{{ __('message.cardsed_desc') }}</p>
        <div class="text-center">
        <a href="/login" class="see-more">{{ __('message.view_more') }}</a>
      </div>
      </div>
    </div>

    <!-- PVTC -->
    <div class="col-md-4 mb-4">
      <div class="card card-custom p-3">
        <div class="icon-circle"><i class="fas fa-briefcase"></i></div>
        <h5>{{ __('message.cardpvtc_heading') }}</h5>
        <p>(Admin PVTC)</p>
        <p>{{ __('message.cardpvtc_desc') }}</p>
        <div class="text-center">
        <a href="/login" class="see-more">{{ __('message.view_more') }}</a>
      </div>
      </div>
    </div>

    

    

    <!-- TEVTA -->
    <div class="col-md-4 mb-4">
      <div class="card card-custom p-3">
        <div class="icon-circle"><i class="fas fa-tools"></i></div>
        <h5>{{ __('message.cardtevta_heading') }}</h5>
        <p>(Admin TEVTA)</p>
        <p>{{ __('message.cardtevta_desc') }}</p>
        <div class="text-center">
        <a href="/login" class="see-more">{{ __('message.view_more') }}</a>
      </div>
      </div>
    </div>


    <!-- School -->
    <div class="col-md-4 mb-4">
      <div class="card card-custom p-3">
        <div class="icon-circle"><i class="fas fa-chalkboard-teacher"></i></div>
        <h5>{{ __('message.cardschool_heading') }}</h5>
        <p>(Admin School)</p>
        <p>{{ __('message.cardschool_desc') }}</p>
        <div class="text-center">
        <a href="/login" class="see-more">{{ __('message.view_more') }}</a>
      </div>
      </div>
    </div>
    

    <!-- College -->
    <div class="col-md-4 mb-4">
      <div class="card card-custom p-3">
        <div class="icon-circle"><i class="fas fa-building"></i></div>
        <h5>{{ __('message.cardcollege_heading') }}</h5>
        <p>(Admin College)</p>
        <p>{{ __('message.cardcollege_desc') }}</p>
        <div class="text-center">
        <a href="/login" class="see-more">{{ __('message.view_more') }}</a>
      </div>
      </div>
    </div>

    <div class="col-12">
<div class="row justify-content-center">
    <!-- University -->
    <div class="col-md-4 mb-4 d-flex justify-content-center">
      <div class="card card-custom p-3">
        <div class="icon-circle"><i class="fas fa-graduation-cap"></i></div>
        <h5>{{ __('message.carduni_heading') }}</h5>
        <p>(Admin University)</p>
        <p>{{ __('message.carduni_desc') }}</p>
        <div class="text-center">
        <a href="/login" class="see-more">{{ __('message.view_more') }}</a>
      </div>
      </div>
    </div>

    <!-- Others -->
    <div class="col-md-4 mb-4 ">
      <div class="card card-custom p-3">
        <div class="icon-circle"><i class="fas fa-ellipsis-h"></i></div>
        <h5> دیگر(Others)</h5>
        <p></p>
      </div>
    </div>

  </div>
</div>
 
              </div>
            </div>

          </div>
        </div>
      </section>

                    @if (session('status'))
                        
                            {{ session('status') }}
                        
                    @endif

                 
    </div>
</div>
</div>
</body>

 @endsection

