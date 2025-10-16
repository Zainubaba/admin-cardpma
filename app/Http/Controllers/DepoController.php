<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Cardform;
use App\Models\Payment;
use DB;
use setasign\Fpdi\Fpdi;
use Carbon\Carbon;

class DepoController extends Controller
{
    
    public function show()
    {
        $id= Auth::user()->id;
        
        
        return view('depot.depodashboard');
    
    }

    public function form()
    {
       
        $sta = DB::select("SELECT * from stations");
        $category = DB::select("SELECT * from category_id");
        
        
        return view('depot.onlineform',compact('sta','category'));
    
    }
    public function list(Request $request)
    {
    
        // $cardforms = DB::select("SELECT cardforms.verify_form as vcf, cardforms.id as cid, cardforms.user_id as uid, cardforms.name as name, cardforms.cnic as cnic, cardforms.near_station as near_station,cardforms.form_id from cardforms where cardforms.verify_form IS NULL ");
        
        $cardforms = DB::table('cardforms')->select('cardforms.verify_form as vcf','cardforms.id as cid','cardforms.user_id as uid','cardforms.name as name','cardforms.cnic as cnic','cardforms.pickup_station as pickup_station','cardforms.form_id')->where('verify_form', '=', NULL)->simplepaginate(10)->appends(request()->query());
        // dd($cardforms);
        $sta = DB::select("SELECT * from stations");
        return view('depot.verifylist',compact('cardforms','sta'))->with('i',($request->input('page',1) - 1) *10);
    
    }

    public function verifysearch(Request $request)
    {
        // dd($request->all());
        $sta = DB::select("SELECT * from stations");
        $cardforms = DB::table('cardforms')->select('cardforms.verify_form as vcf','cardforms.id as cid','cardforms.user_id as uid','cardforms.name as name','cardforms.cnic as cnic','cardforms.pickup_station as pickup_station','cardforms.form_id')->where('cnic', '=', $request->search)->where('verify_form', '=', NULL)->simplepaginate(10)->appends(request()->query());
        return view('depot.verifylist',compact('cardforms','sta'))->with('i',($request->input('page',1) - 1) *10);
    
    }
    public function stationsort(Request $request)
    {
        // dd($request->all());
        $sta = DB::select("SELECT * from stations");
        $cardforms = DB::table('cardforms')->select('cardforms.verify_form as vcf','cardforms.id as cid','cardforms.user_id as uid','cardforms.name as name','cardforms.cnic as cnic','cardforms.pickup_station as pickup_station','cardforms.form_id')
        ->where('pickup_station', '=', $request->station)
        ->where('verify_form', '=', NULL)->simplepaginate(10)->appends(request()->query());
        return view('depot.verifylist',compact('cardforms','sta'))->with('i',($request->input('page',1) - 1) *10);
    }

    public function verifypay(Request $request,$id)
    {
        $user = Auth::user()->id;
        $id = $id;
        $payment = DB::select("SELECT * from payments where id=$id");
        $cardforms = DB::select("SELECT * from cardforms where id=$id");

        
        
        return view('depot.verifypay',compact('payment','cardforms','id'));
    
    }

    public function verifypayupdate(Request $request,$id)
    {
 
   
        $payment = cardforms::find($id);

        $datanum = DB::select("SELECT phone_number from cardforms where id = $payment->form_id ")[0]->phone_number;
  



        $securityKey    = config('services.messagepitb.securityKey');
        
        $dataNumber     = $datanum;
      
        
        // $smsText        = 'آپ کی اپوائنٹمنٹ نیچے دی گئ تاریخ پر بُک ہو چکی ہے، میڈیکل معائنے کے لیے اپنے متعلقہ ہسپتال میں تشریف لے جائیں۔ '.$request['ddate'].'';
    $smsText = ' پرسنلائزڈکارڈ فارم کی فیس وصول ہو گئی ہےشکریہ۔ cards-pma.punjab.gov.pk اس لنک پر کلک کر کے آپ اپنے ای میل اور پاسورڈ کے ذریعے اپنی درخواست کی ٹریکنگ کر سکتے ہیں۔';
      
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
      
        
        $payment->update($input);
        
        return redirect()->route('list.payment');

       
    }

    public function verifyform(Request $request,$id)
    {
        $user = Auth::user()->id; 
        $id = $id;
    
        $payment = DB::select("SELECT * from payments where id=$id");
        $cardforms = DB::select("SELECT * from cardforms where id=$id");
        $sta = DB::select("SELECT * from stations");
        $category = DB::select("SELECT * from category_id");
        
       
        $ca = DB::select("SELECT category from cardforms where id=$id")[0]->category;
        $dob = DB::select("SELECT dob,created_at from cardforms where id=$id");
        if($ca == '2'){
        
            $dateOfBirth = $dob[0]->dob;
            $today = date("Y-m-d");
        $years = date_diff(date_create($dateOfBirth), date_create($dob[0]->created_at));
            
        }
        else{
            $years = 'not needed';
        }

        if($ca == '3'){

        
            $pcr =DB::select("SELECT pcrdp from cardforms where id=$id")[0]->pcrdp;
            
            $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://dpmis.punjab.gov.pk/api/'.$pcr,  [
          
          'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'secret'=>  config('services.pcrdpkey.apisk'),
          ],
        ]);
        
        $za = json_decode($response->getBody());
        
        // echo $response->getBody();
$pccheck =$za->verified;


        }else{
            $pccheck = 'Not select pwds';
        }
        return view('depot.verifyform',compact('payment','cardforms','category','sta','id','pccheck','dob','years'));
    
    }

    public function verifyformupdate(Request $request,$id)
    {
        $this->validate($request, [
            'verify_form' => '',
            'remarks' => '',
            'remarks2' => '',
            'verify_payment'=> '',
            'photo'=> '',
            'cnic_front'=> '',
            'cnic_back'=> '',
            'student_id_card_front'=> '',
            'student_id_card_back'=> '',
            'student_affidavite'=> ''
        ]);
        $datanum = DB::select("SELECT phone_number from cardforms where id = $id ")[0]->phone_number;
  


        $securityKey    = config('services.messagepitb.securityKey');
        
        $dataNumber     = $datanum;
if($request->verify_form == 'No'){
    $smsText = 'پرسنلائزڈکارڈ فارم کی فیس وصول ہو گئی ہےشکریہ۔لیکن آپ کے فارم میں کچھ غلطی ہے، براہ کرم اسے درست کریں۔ اس لنک پر کلک کر کے آپ اپنے ای میل اور پاسورڈ کے ذریعے اپنی درخواست کی ٹریکنگ کر سکتے ہیں۔https://cards-pma.punjab.gov.pk';
}
   else{   
        
        // $smsText        = 'آپ کی اپوائنٹمنٹ نیچے دی گئ تاریخ پر بُک ہو چکی ہے، میڈیکل معائنے کے لیے اپنے متعلقہ ہسپتال میں تشریف لے جائیں۔ '.$request['ddate'].'';
    $smsText = 'پرسنلائزڈکارڈ فارم کی فیس وصول ہو گئی ہےشکریہ۔ اس لنک پر کلک کر کے آپ اپنے ای میل اور پاسورڈ کے ذریعے اپنی درخواست کی ٹریکنگ کر سکتے ہیں۔https://cards-pma.punjab.gov.pk';
}
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
        // dd($request->all());
        $input = $request->all();
   
        $cardform = Cardform::find($id);
        $cardform->update($input);
        
        return redirect()->route('list.payment');
       
    }

    public function formlist(Request $request)
    {
        // dd($request->all());
        $user = Auth::user()->id;
        
        $cardforms = DB::table("cardforms")->select('id as cid', 'category as category', 'user_id as uid', 'name as name', 'cnic as cnic', 'near_station as station_name')->whereNotIn('id',function($query) {

   $query->select('cardform_id')->from('payments');

})->simplepaginate(5);

        $category = DB::select("SELECT * from category_id");
        
        return view('depot.submittedformslist',compact('cardforms','category'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    public function depopay(Request $request,$id)
    {
        $user = Auth::user()->id;
        $id = $id;
        $payment = DB::select("SELECT * from payments where id=$id");
        $cardforms = DB::select("SELECT * from cardforms where id=$id");
       
        
        return view('depot.depopay',compact('cardforms','id'));
    
    }

    public function printcard(Request $request)
    {
       
        $cardforms = 
       DB::table('cardforms')->select('*')->where('cardforms.verify_form', '=', 'Yes')->simplepaginate(10)->appends(request()->query());
    //    dd($cardforms);
        $category = DB::select("SELECT * from category_id");
        $sta = DB::select("SELECT * from stations");

       
        
        return view('depot.printcard',compact('cardforms','category','sta'))->with('i',($request->input('page',1) - 1) *10);
    
    }
    
    public function printcardsearch(Request $request)
    {
        // dd($request->all());
              
        $cardforms = 
       DB::table('cardforms')->join('payments', 'cardforms.id', '=', 'payments.cardform_id')->select('*')->where('cardforms.verify_form', '=', 'Yes')->where('cnic')->simplepaginate(2)->appends(request()->query());
    //    dd($cardforms);
        $category = DB::select("SELECT * from category_id");

       
        
        return view('depot.printcard',compact('cardforms','category'))->with('i',($request->input('page',1) - 1) *10);
    
    
    }
    public function printcardstationsort(Request $request)
    {
        // dd($request->all());
        $sta = DB::select("SELECT * from stations");
        $cardforms = DB::table('cardforms')->select('cardforms.verify_form as vcf','cardforms.id as cid','cardforms.user_id as uid','cardforms.name as name','cardforms.cnic as cnic','cardforms.near_station as near_station','cardforms.form_id')
        ->where('near_station', '=', $request->station)
        ->where('verify_form', '=', NULL)->simplepaginate(10)->appends(request()->query());
        return view('depot.verifylist',compact('cardforms','sta'))->with('i',($request->input('page',1) - 1) *10);
    }
    

    public function card($id)
    {
        $user = Auth::user()->id;
    

        $cardforms = DB::select("SELECT * from cardforms where id=$id" );

        $category = DB::select("SELECT * from category_id");
        
        return view('depot_bl.card',compact('cardforms','category'));
    
    }

    public function dispatchcard()
    {
    
        $user = Auth::user()->id;

        $cardforms = DB::select("SELECT * from cardforms where cardnumber IS NOT NULL and cardnumber!=''" );
        $category = DB::select("SELECT * from category_id");
        $sta = DB::select("SELECT * from stations");
        
        
        return view('depot.dispatch',compact('cardforms','category','sta'));
    
    }
    public function dispachstationsort(Request $request)
    {
        // dd($request->all());
        $sta = DB::select("SELECT * from stations");
        $cardforms = DB::table('cardforms')->select('cardforms.verify_form as vcf','cardforms.id as cid','cardforms.user_id as uid','cardforms.name as name','cardforms.cnic as cnic','cardforms.near_station as near_station','cardforms.form_id')
        ->where('near_station', '=', $request->station)
        ->where('verify_form', '=', NULL)->simplepaginate(10)->appends(request()->query());
        return view('depot.verifylist',compact('cardforms','sta'))->with('i',($request->input('page',1) - 1) *10);
    }
    public function dispatchupdate(Request $request,$id)
    {
   
         $this->validate($request, [
            'dispatch' => '',
            
           
        ]);
        
        $input = $request->all();
   
        $cardform = Cardform::find($id);
        $cardform->update($input);

        $datanum = DB::select("SELECT phone_number from cardforms where id = $id ")[0]->phone_number;
  



        $securityKey    = config('services.messagepitb.securityKey');
        
        $dataNumber     = $datanum;
      
        
        // $smsText        = 'آپ کی اپوائنٹمنٹ نیچے دی گئ تاریخ پر بُک ہو چکی ہے، میڈیکل معائنے کے لیے اپنے متعلقہ ہسپتال میں تشریف لے جائیں۔ '.$request['ddate'].'';
    $smsText = 'پرسنلائزڈکارڈ تیار ہو کر آپ کے متعلقہ اسٹیشن پر بھیج دیا گیا ہے .جلد از جلدوصول کر لیں شکریہ۔' ;
      
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
        dd($res_txt);
        DB::table('messages')
        ->where('id', 1)
        ->update([
            'sms_3' => DB::raw('sms_3 + 1'),
        
        ]);
        
        return redirect()->route('dispatch.card');
       
    }


    


    public function fillPDF(Request $request,$id)
    {
        $filePath = public_path("1 card.pdf");
        $outputFilePath = public_path("1 card_o.pdf");
        $this->fillPDFFile($filePath, $outputFilePath,$id);
          
        return response()->file($outputFilePath);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function fillPDFFile($file, $outputFilePath,$id)
    {
        
        $cnic = DB::select("SELECT * from cardforms where id=$id" )[0]->cnic;
        $name = DB::select("SELECT * from cardforms where id=$id" )[0]->card_name;
        $category = DB::select("SELECT * from cardforms where id=$id" )[0]->category;
        $categoryid = DB::select("SELECT * from category_id");
        $photo = DB::select("SELECT * from cardforms where id=$id" )[0]->photo;
        $fpdi = new FPDI;

          
        $count = $fpdi->setSourceFile($file);
  
        for ($i=1; $i<=$count; $i++) {
  
            $template = $fpdi->importPage($i);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
            $fpdi->useTemplate($template);
              
            $fpdi->SetFont("Arial", "B", 16);
            $fpdi->SetTextColor(0,0,0);
  
            $left = 120;
            $top = 42;
            $text = $cnic;
            $fpdi->Text($left,$top,$text);
            $left1 = 30;
            $top1 = 45;
            foreach($categoryid as $categoryi){
                if($categoryi->id==$category){
            $text1 = $categoryi->name;
                }
            }
            $fpdi->SetFont("Arial", "", 16);
            $fpdi->SetTextColor(0,0,0);
            $fpdi->Text($left1,$top1,$text1);
            $left2 = 20;
            $top2 = 40;
            $text2 = $name;
            $fpdi->SetFont("Arial", "B", 16);
            $fpdi->SetTextColor(0,0,0);
            $fpdi->Text($left2,$top2,$text2);
             
             $result = url('/uploads/photo/'.$photo);
       
            $fpdi->Image($result,  90, 27,20);
        }
  
        return $fpdi->Output($outputFilePath, 'F');
    }
    public function fillbPDF(Request $request,$id)
    {
        $filePath = public_path("2 card.pdf");
        $outputFilePath = public_path("2 card_o.pdf");
        $this->fillbPDFFile($filePath, $outputFilePath,$id);
          
        return response()->file($outputFilePath);
    }
  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function fillbPDFFile($file, $outputFilePath,$id)
    {
        $cnic = DB::select("SELECT * from cardforms where id=$id" )[0]->cnic;
        $name = DB::select("SELECT * from cardforms where id=$id" )[0]->card_name;
        $category = DB::select("SELECT * from cardforms where id=$id" )[0]->category;
        $photo = DB::select("SELECT * from cardforms where id=$id" )[0]->photo;
        
        $categoryid = DB::select("SELECT * from category_id");
        $fpdi = new FPDI;
          
        $count = $fpdi->setSourceFile($file);
  
        for ($i=1; $i<=$count; $i++) {
  
            $template = $fpdi->importPage($i);
            $size = $fpdi->getTemplateSize($template);
            $fpdi->AddPage($size['orientation'], array($size['width'], $size['height']));
            $fpdi->useTemplate($template);
              
             $fpdi->SetFont("Arial", "B", 16);
            $fpdi->SetTextColor(0,0,0);
  
            $left = 110;
            $top = 100;
            $text = $cnic;
            $fpdi->Text($left,$top,$text);
            $left1 = 110;
            $top1 = 28;
            foreach($categoryid as $categoryi){
                if($categoryi->id==$category){
            $text1 = substr($categoryi->name, 0, 20);
                }
            }
             $fpdi->SetFont("Arial", "", 12);
            $fpdi->SetTextColor(0,0,0);
            $fpdi->Text($left1,$top1,$text1);
            $left2 = 104;
            $top2 = 23;
            $text2 = substr($name, 0, 20);
             $fpdi->SetFont("Arial", "", 12);
            $fpdi->SetTextColor(0,0,0);
            $fpdi->Text($left2,$top2,$text2);
             $result = url('/uploads/photo/'.$photo);
              // $result = 'https://cards-pma.punjab.gov.pk/uploads/photo/default-avatar-profile-image-vector-social-media-user-icon-potrait-182347582.jpg';
            $fpdi->Image($result, 155, 10,20,);
      
       
        }
  
        return $fpdi->Output($outputFilePath, 'F');
    }
       
    public function cardnum(Request $request)
    {
        
        $date = date('Y-m-d');
    $id = $request->cardid;
    
         $this->validate($request, [
            'cardnumber' => '',
            
          
           
        ]);
        
        
        $input = $request->all();
   $input['cardissuedate']=$date;

        $payment = Cardform::find($id);
        $payment->update($input);
    
              
        return redirect()->route('depo.printcard');

       
    }
}
