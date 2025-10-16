<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Cardform;
use Auth;
use DB;

class PaymentController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {      
        $user = Auth::user()->id;
       
        $cardforms= DB::select("SELECT * from cardforms where user_id=$user");
        $station = DB::select("SELECT * from stations");
    
        $to = date("Y-m-d");
        try {  
          
        $payment= DB::select("SELECT receipt from payments where user_id='$user'")[0]->receipt;
        
        if($payment != null){
            $date= DB::select("SELECT date from payments where user_id='$user'")[0]->date;
          
            $futureDate=date('Y-m-d', strtotime('+1 year', strtotime($date)) );
        
        }
        }
        catch (\Exception $payment) {
          $payment = 0;
          $futureDate = 0;
             
        }

        return view('payment',compact('station','user','to','payment','futureDate','cardforms'));

    }


public function store(Request $request)
    {   
          
        $input= request()->validate( [

            'cardform_id'=>'',
            'form_id'=>'',
            'user_id'=>'',
            'date' => '', 
            'receipt'=>'',
           
         
        ]);
       
        $user = auth()->user();
        $input['user_id']=$user->id;
    
        
            $datanum = DB::select("SELECT phone_number from cardforms where id =  $request->cardform_id")[0]->phone_number;
      
    
          $securityKey    = config('services.messagepitb.securityKey');
          
          $dataNumber     = $datanum;
    
          
          // $smsText        = 'آپ کی اپوائنٹمنٹ نیچے دی گئ تاریخ پر بُک ہو چکی ہے، میڈیکل معائنے کے لیے اپنے متعلقہ ہسپتال میں تشریف لے جائیں۔ '.$request['ddate'].'';
      $smsText = 'پرسنلائزڈکارڈ فارم کی فیس وصول ہو گئی ہےشکریہ۔
      فارم نمبر یہ ہے '.$request->form_id.'
       cards-pma.punjab.gov.pk اس لنک پر کلک کر کے آپ اپنے ای میل اور پاسورڈ کے ذریعے اپنی درخواست کی ٹریکنگ کر سکتے ہیں۔
      
    ';  
    
        
      // Your Account SID and Auth Token from twilio.com/console
          $model  = array(
              'phone_no'	=> $dataNumber,
              'sms_text'	=> $smsText,
              'sec_key'	=> $securityKey,
              'sms_language'	=>'urdu'
          );
          
                  
          $post_string    = http_build_query($model);
                   
          $url    = config('services.messagepitb.url');
          
          $ch     = curl_init();// or die("Cannot init");
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST,"POST");                                                                     
          curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: '.strlen($post_string)) );
          
          $curl_response= curl_exec($ch);
          $gr =$curl_response;
          $res_txt = json_decode($gr);
          DB::table('messages')
          ->where('id', 1)
          ->update([
              'sms_2' => DB::raw('sms_2 + 1'),
          
          ]);
        
        
        $payment = Payment::create($input);

        return redirect()->route('list.payment');


    
    }
    public function edit(Payment $payment, $id)
    {
       
    
        return view('editpay');
    }

    public function show(Payment $payment)
    {   
        $user = Auth::user()->id;
        $to = date("Y-m-d");

        $cardforms= DB::select("SELECT * from cardforms where user_id=$user");
            $payment= DB::select("SELECT * from payments where user_id=$user");
        try {  
          
          $pa = DB::select("SELECT user_id from payments where user_id=$user")[0]->user_id;
        
            return view('showpayment',compact('cardforms','to','payment'));
            
            
        }   

            catch (\Exception $payment) {
                
    
     
        return view('payment',compact('cardforms'));
       
        }
    }


}