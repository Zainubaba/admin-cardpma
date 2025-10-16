@extends('design_main.master')
@section('content')

<head>
      <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
    <style>
        
      b{
        color: black;
        
      }
      /*  form media querry */
      @media screen and (max-width:900px){
        .form{
            margin-left: -25%;
           
            width: 150%;
        }
        
      }
   
      
 
    </style>
  
    <div class="" style="margin-left: 150px">
        <div class="col-md-12 mb-5 form">
            <div class="row sec ">
                <div class="col-md-1" style=""></div>
                <div class="col-md-10 bg-light " style="border: 5px solid rgb(0, 0, 0);">
                    <div class="">
                        <div class="row" style="background-color: white; border-bottom: 3px solid rgb(0, 0, 0);">
                            <div class="col-md-12" style="background-color:#B2BEB5">
                                <h2 class="mt-3 mb-3" style="text-align: center; color: rgb(0, 0, 0); ">
                                  <a style="color: rgb(0, 0, 0);">
                                    Personalized Smart Card Application Form - OLMRTS
                                  </a>
                                </h2>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="container">
                                  @foreach ($cardforms as $cardform)
                                  <div class="" style="border: 2px solid black; padding:7px; margin-top:3px; border-radius:20px">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <b>*Select the category:</b>
                                            <div class="form-check form-check-inline" style="margin-left:30px;">
                                                @foreach ($category as $categor)
                                                    @if ($cardform->category == $categor->id)
                                                        <td>{{ $categor->name }}</td>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <b>*Near_by station:</b>
                                            <span style="margin-left:30px;">

                                                {{ $cardform->near_station }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <b>*Select your preferred station from where you collect card and make
                                                payment:</b>
                                            <span style="margin-left: 30px;">
                                                {{ $cardform->pickup_station }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <b> Daily Visiting Routes: </b>
                                            <br>
                                            <div style=" margin-left:30px; line-height:2em;">
                                                <div>
                                                    <b> 1. </b>
                                                    To
                                                    <u>{{ $cardform->to_route1 }} </u>

                                                    From
                                                    <u>{{ $cardform->from_route1 }} </u>

                                                </div>

                                                <div>
                                                    <b> 2. </b>
                                                    To
                                                    <u>{{ $cardform->to_route2 }} </u>

                                                    From
                                                    <u>{{ $cardform->from_route2 }} </u>

                                                </div>

                                                <div>
                                                    <b> 3. </b>
                                                    To
                                                    <u>{{ $cardform->to_route3 }} </u>

                                                    From
                                                    <u>{{ $cardform->from_route3 }} </u>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col-md-3"><b> Card Name: </b></div>
                                        <div class="col-md-3"
                                            style="border: none; border-color: transparent; border-bottom: 1px solid black; width:110px;">
                                            {{ $cardform->card_name }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><b> Passenger Name: </b></div>
                                        <div class="col-md-3"
                                            style="border: none; border-color: transparent; border-bottom: 1px solid black; width:110px;">
                                            {{ $cardform->name }}</div>


                                        <div class="col-md-3">
                                            <b>CNIC:</b>
                                        </div>
                                        <div class="col-md-2"
                                            style="border: none; border-color: transparent; border-bottom: 1px solid black; width:110px;">
                                            {{ $cardform->cnic }}
                                        </div>
                                        <div class="col-md-1"></div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><b> Date of Birth: </b></div>
                                        <div class="col-md-3 col-sm-6" style="border-bottom: 1px solid black; width:110px;">
                                            {{ $cardform->dob }}</div>


                                        <div class="col-md-3">
                                            <b>CNIC Expiry Date:</b>
                                        </div>
                                        <div class="col-md-2 col-sm-6" style=" border-bottom: 1px solid black; width:110px;">
                                            {{ $cardform->cnic_expiry_date }}
                                        </div>
                                        <div class="col-md-1"></div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"><b> Gender: </b></div>
                                        <div class="col-md-3" style="border-bottom: 1px solid black; width:110px;">
                                            {{ $cardform->gender }}</div>


                                        <div class="col-md-3">
                                            <b>Contact #:</b>
                                        </div>
                                        <div class="col-md-2" style=" border-bottom: 1px solid black; width:110px;">
                                            {{ $cardform->phone_number }}
                                        </div>
                                        <div class="col-md-1"></div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <b>Institute/Organization Name:</b>
                                        </div>
                                        <div class="col-md-7"
                                            style="border: none; border-color: transparent; border-bottom: 1px solid black; width:110px;">
                                            {{ $cardform->org_name }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <b>Full Address:</b>
                                        </div>
                                        <div class="col-md-7"
                                            style="border: none; border-color: transparent; border-bottom: 1px solid black; width:110px;">
                                            {{ $cardform->faddress }}</a></div>
                                    </div>
                                </div>
                                    <div class="" style="border: 2px solid black; padding:7px; margin-bottom:6px; margin-top:6px;  border-radius:20px">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <b><u> Check List</u></b>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @if ($cardform->category == '3')
                                            <div class="col-md-3"><b> * Disability Certificate: </b></div>
                                            <div class="col-md-3" style=" width:110px; padding-left:10px;">
                                                {{ $cardform->disability_certificate }}</div>
                                                
                                            <div class="col-md-3 " style="margin-top: 1%; margin-left:20%;">
                                                <b >* PCRDP Number:</b>
                                            </div>
                                            <div class="col-md-3 " style=" border-bottom: 1px solid black; width:110px; margin-left: 71%;">
                                                {{ $cardform->pcrdp }}
                                            </div>
                                            <div class="col-md-1"></div>
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"> &nbsp;   &nbsp; * Photo (white background) </div>
                                        <div class="col-md-6">{{ $cardform->photo }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"> &nbsp;   &nbsp; * CNIC Front </div>
                                        <div class="col-md-6">{{ $cardform->cnic_front }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"> &nbsp;   &nbsp; * CNIC Back </div>
                                        <div class="col-md-6">{{ $cardform->cnic_back }}</div>
                                    </div>
                                    <div class="row">
                                      @if ($cardform->category == '1')
                                          <div class="col-md-4"> &nbsp;   &nbsp; * Student Identity Card Front </div>
                                          <div class="col-md-6">{{ $cardform->student_id_card_front }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"> &nbsp;   &nbsp; * Student Identity Card Back </div>
                                        <div class="col-md-6">{{ $cardform->student_id_card_back }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"> &nbsp;   &nbsp; * Student Certificate </div>
                                        <div class="col-md-6">{{ $cardform->student_affidavite }}</div>
                                      @endif
                                    </div>
                                    <div class="row">
                                      @if ($cardform->category == '4')
                                          <div class="col-md-4"> &nbsp;   &nbsp;* Employment Card </div>
                                          <div class="col-md-6">{{ $cardform->empolyee_card }}</div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4"> &nbsp;   &nbsp;* Empolyment Certificate </div>
                                        <div class="col-md-6">{{ $cardform->empolyee_affidavite }}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="" style="border: 2px solid black; padding:7px; margin-bottom:6px; margin-top:6px; border-radius:20px">
                                    <div class="row">
                                      <div class="col-md-12 ">
                                        <b> <u>Terms and Conditions:</b></u><br>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-12 col-sm-12">

                                        
                                <p style="">
                                    * A message alert will be sent for the collection of card from the selected station.<br>
                                    * The card will not be issued to passenger without  submission of application. <br>
                                    * Validity for Students and Working Women cards is one (01) year or till the validity of the tenure whichever &nbsp;&nbsp;is earlier.
                                      Cards are renewable upon request.<br>
                                    * Personalized cards are non-refundable.<br>
                                    * Committing any of the following shall be Punishable under<br>
                                    &nbsp; &nbsp;PMA Act.2015 with the fine upto Rs/500<br>
                                    &nbsp;  &nbsp;  &nbsp;  No 1. If applicant submits false information in his/her application.<br>
                                    &nbsp;  &nbsp;  &nbsp;  No 2. If applicant submits forged document with the application.<br>                                    
                                    *Once issued , cards can only be collected at the ticketing window of the preferred station.<br>
                                    <br>
                                    &nbsp;@if($cardform->t_c == "0")
    <input type="checkbox" name="t_c" value="0" readonly onclick="return false;">
    @else
    <input type="checkbox" name="t_c" value="1" checked onclick="return false;">
    @endif
                                    <label for="">   I underatake that all of the information in the application is true to best of my knowledge and i accept </label><br>
                                    &nbsp;  &nbsp; all of the above mentioned Terms and Conditions 
                                 </p><br>
                                          
                                          @if ($payment == 'No')
                                              <a class="btn btn-dark" style="margin-left:80%; margin-bottom:5%;" href="editform/{{ $cardform->id }}">Edit</a>
                                        <br>
                                              Remarks: {{ $cardform->remarks }}
                                         
                                              @endif
                                      </div>
                                    </div>
                                </div>
                                  @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
        
    </div>
    {{-- <div class="col-md-1"></div> --}}
    </div>
    
@endsection


