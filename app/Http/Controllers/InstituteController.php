<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\RegInstitute;
use App\Models\Status;
use DB;
use Log;
use Auth;

class InstituteController extends Controller
{
    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.userdashboard');
    }

      public function newUser()
    {
        $hods = DB::SELECT("SELECT * from hods");

        return view('Institute.registeruser', compact('hods'));
    }

    public function storeinstitute(Request $request)
    {
        //   dd($request->all());
          
                // Validate and create RegInstitute
                $input =  $this->validate($request, [
                    'user_id' => '',
                    'name' => '',
                    'phone_number'=>'',
                    'cnic' => '',
                    'email' => '',
                    'district' => '',
                    'tehsil' => '',
                    'institute_type' => '',
                    // 'edu_level' => '',
                    'edu_level' => 'required|array',
                    'edu_level.*' => 'integer',   
                    'hod_id' => '',
                    'emis' => '',
                    // 'org_name' => '',
                    'org_name' => 'required',
                    'other_org_name' => 'required_if:org_name,other|nullable|string|max:255',

                ]);


                  
                 if ($request->has('edu_level')) {
            $input['edu_level'] = implode(',', $request->edu_level);
        }

                $regInput = $input;
                unset($regInput['user_id']);

                $rand = rand(0, 99999);

                // Send SMS
                $securityKey = config('services.messagepitb.securityKey');
                $dataNumber  = $request->phone_number;
                $smsText     = 'Your Verification code is ' . $rand;

                $model = [
                    'phone_no' => $dataNumber,
                    'sms_text' => $smsText,
                    'sec_key'  => $securityKey,
                    'sms_language' => 'english'
                ];

                $post_string = http_build_query($model);
                $url = config('services.messagepitb.url');

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
                curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Length: ' . strlen($post_string)]);
                $curl_response = curl_exec($ch);
                $res_txt = json_decode($curl_response);

                // Validate and create User
                $input2 =  $this->validate($request, [
                    'name' => '',
                    'email'=>'',
                    'role' => '',
                    'cnic' => '',
                    'city' => '',
                    'org_name' => '',
                    'phone_number' => '',
                    'password' => 'required|string|min:8',
                    'otp' => '',
                ]);

                

                $input2['password'] = Hash::make($input2['password']);
                $input2['otp'] = $rand;
                $input2['city'] = $request->district;
                // $input2['hod_institute'] = $request->org_name;

                $data2 = User::create($input2);

                if ($request->org_name === 'other' && !empty($request->other_org_name)) {
    // Insert new organization first
    $newOrgId = DB::table('organizations')->insertGetId([
        'district_id'    => $request->district,
        'tehsil_id'      => $request->tehsil,
        'institute_type' => $request->institute_type,
        'edu_level'      => isset($input['edu_level']) ? $input['edu_level'] : null,
        'org_name'       => $request->other_org_name,
        'hod_id'         => $data2->id,
        'created_by'     => auth()->id() ?? null,
        'created_at'     => now(),
        'updated_at'     => now(),
    ]);


$data2->update(['hod_institute' => $newOrgId]); //Assign org to user

} else {
    $data2->update(['hod_institute' => intval($request->org_name)]); // Existing org
}

// Step 3: Create RegInstitute
$regInput['user_id'] = $data2->id;
unset($regInput['other_org_name']);

if ($request->org_name === 'other' && !empty($request->other_org_name)) {
    $regInput['org_name'] = $newOrgId; // or use $request->other_org_name if you want to store name
} else {
    $regInput['org_name'] = intval($request->org_name);
}

$data = RegInstitute::create($regInput);

    //     $input2['hod_institute'] = $newOrgId; // Assign the new ID
// } else {
//     $input2['hod_institute'] = intval($request->org_name); // Use selected ID
// }


                  
                // $data2 = User::create($input2);

                // $regInput['user_id'] = $data2->id;
                // $data = RegInstitute::create($regInput);

        return redirect()->back()->with('success','Institute Registered Successfully, Now Login Your Account!');

    }
    
    // public function storeinstitute(Request $request)
    // {
    //     //   dd($request->all());
          
    //             // Validate and create RegInstitute
    //             $input =  $this->validate($request, [
    //                 'user_id' => '',
    //                 'name' => '',
    //                 'phone_number'=>'',
    //                 'cnic' => '',
    //                 'email' => '',
    //                 'district' => '',
    //                 'tehsil' => '',
    //                 'institute_type' => '',
    //                 // 'edu_level' => '',
    //                 'edu_level' => 'required|array',
    //                 'edu_level.*' => 'integer',   
    //                 'hod_id' => '',
    //                 'emis' => '',
    //                 'org_name' => '',
    //             ]);


                  
    //              if ($request->has('edu_level')) {
    //         $input['edu_level'] = implode(',', $request->edu_level);
    //     }

    //             $regInput = $input;
    //             unset($regInput['user_id']);

    //             $rand = rand(0, 99999);

    //             // Send SMS
    //             $securityKey = config('services.messagepitb.securityKey');
    //             $dataNumber  = $request->phone_number;
    //             $smsText     = 'Your Verification code is ' . $rand;

    //             $model = [
    //                 'phone_no' => $dataNumber,
    //                 'sms_text' => $smsText,
    //                 'sec_key'  => $securityKey,
    //                 'sms_language' => 'english'
    //             ];

    //             $post_string = http_build_query($model);
    //             $url = config('services.messagepitb.url');

    //             $ch = curl_init();
    //             curl_setopt($ch, CURLOPT_URL, $url);
    //             curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //             curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    //             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //             curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    //             curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
    //             curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Length: ' . strlen($post_string)]);
    //             $curl_response = curl_exec($ch);
    //             $res_txt = json_decode($curl_response);

    //             // Validate and create User
    //             $input2 =  $this->validate($request, [
    //                 'name' => '',
    //                 'email'=>'',
    //                 'role' => '',
    //                 'cnic' => '',
    //                 'city' => '',
    //                 'org_name' => '',
    //                 'phone_number' => '',
    //                 'password' => 'required|string|min:8',
    //                 'otp' => '',
    //             ]);

    //             $input2['password'] = Hash::make($input2['password']);
    //             $input2['otp'] = $rand;
    //             $input2['city'] = $request->district;
    //             $input2['hod_institute'] = $request->org_name;

                  
    //             $data2 = User::create($input2);

    //             $regInput['user_id'] = $data2->id;
    //             $data = RegInstitute::create($regInput);

    //     return redirect()->back()->with('success','Institute Registered Successfully, Now Login Your Account!');

    // }


    public function storeuser(Request $request)
    {

                $rand = rand(0, 99999);
        $verify = '0';
        // dd($data);


            $securityKey    = config('services.messagepitb.securityKey');
            $dataNumber     = $request->phone_number;
            $rand = rand(0, 99999);


            $smsText        = 'Your Verfificcation code is ' . $rand . '';

            // Your Account SID and Auth Token from twilio.com/console
            $model  = array(
                'phone_no'    => $dataNumber,
                'sms_text'    => $smsText,
                'sec_key'    => $securityKey,
                'sms_language'    => 'english'
            );


            $post_string    = http_build_query($model);

            $url    = config('services.messagepitb.url');

            $ch     = curl_init(); // or die("Cannot init");
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post_string);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: ' . strlen($post_string)));

            $curl_response = curl_exec($ch);
            $gr = $curl_response;
            $res_txt = json_decode($gr);


       $input =  $this->validate($request, [
            'name' => '',
            'email'=>'',
            'role' => '',
            'cnic' => '',
            'city' => '',
            'phone_number' => '',
            'password' => 'required|string|min:8',
            'otp' => '',
        ]);

        $input['password'] = Hash::make($input['password']);
        $input['otp'] =  $rand;


        $data = User::create($input);


        return view('Institute.selectregistration')->with('success','Focal Person Created Successfully!');
        
        // redirect()->back()->with('success','User Created Successfully!');

    }

    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function showForm($id)
{
    // Fetch joined user data
    $data = DB::table('basic_infos')
        ->leftJoin('trip_infos', 'basic_infos.user_id', '=', 'trip_infos.user_id')
        ->leftJoin('attachments', 'basic_infos.user_id', '=', 'attachments.user_id')
        ->leftJoin('districts', 'trip_infos.district', '=', 'districts.id')
        ->leftJoin('tehsils', 'trip_infos.tehsil', '=', 'tehsils.id')
        ->leftJoin('institute_types', 'trip_infos.institute_type', '=', 'institute_types.id')
        ->leftJoin('edu_levels', 'trip_infos.edu_level', '=', 'edu_levels.id')
        ->leftJoin('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->select(
            'basic_infos.id',
            'basic_infos.user_id',
            'basic_infos.passenger_name',
            'basic_infos.cnic',
            'basic_infos.contact',
            'basic_infos.dob',
            'basic_infos.gender',
            'basic_infos.cnic_type',
            'basic_infos.cnic_expiry',
            'basic_infos.category',
            'basic_infos.confirmation',
            'basic_infos.verified_users',
            'basic_infos.rejection_reason',
            'basic_infos.feedback',
            'trip_infos.card_type',
            'districts.name as district',
            'tehsils.tehsil_name as tehsil',
            'institute_types.name as institute_type',
            'edu_levels.name as edu_level',
            'organizations.org_name',
            'trip_infos.address',
            'attachments.photo',
            'attachments.cnic_front',
            'attachments.cnic_back',
            'attachments.bform',
            'attachments.student_id_card'
        )
        ->where('basic_infos.user_id', $id)
        ->first(); // get single record

    // Initialize defaults
    $form = $payment = $verification = $card = '';
    $confirmation = null;
    $deptbg = $bopbg = $stationbg = $dept2bg = $tcashbg = $handoverbg = $step5bg = 0;
    $inst_tick = false;

    try {
        // Get user info from basic_infos
        $userData = DB::table('basic_infos')->where('user_id', $id)->first();
        $confirmation = $userData ? $userData->confirmation : null;

        $form = $confirmation !== null ? $confirmation : '';
        $payment = $confirmation === '1' ? $confirmation : '';
        $verification = $userData && $userData->verified_users === '1' ? $userData->verified_users : '';
        $card = $verification;

        // Fetch status table values
        $status = DB::table('status')->where('user_id', $id)->first();

        if ($status) {
            $deptbg = ($status->deptist == 1) ? 1 : 0;
            $bopbg = ($status->BOP == 1) ? 1 : 0;
            $stationbg = ($status->station == 1) ? 1 : 0;
            $dept2bg = ($status->dept2 == 1) ? 1 : 0;
            $tcashbg = ($status->{'t-cash'} == 1) ? 1 : 0;
            $handoverbg = ($status->handover == 1) ? 1 : 0;
            $inst_tick = ($status->instittute == 1);
        }

        // Step5 background
        $step5bg = is_null($userData->verified_users) ? null : ($userData->verified_users == 1 ? 1 : 0);

    } catch (\Exception $ex) {
        // Optionally log the exception
        // Log::error($ex->getMessage());
    }

    // Background flags
    $formbg = !empty($form) ? 1 : 0;
    $paymentbg = !empty($payment) ? 1 : 0;
    $verificationbg = !empty($verification) ? 1 : 0;
    $cardbg = !empty($card) ? 1 : 0;

    // Return to your showform view with all variables
    return view('Institute.showform')->with(compact(
        'data',
        'form',
        'payment',
        'verification',
        'card',
        'formbg',
        'paymentbg',
        'verificationbg',
        'cardbg',
        'confirmation',
        'deptbg',
        'bopbg',
        'stationbg',
        'dept2bg',
        'handoverbg',
        'tcashbg',
        'step5bg',
        'inst_tick'
    ));
}


    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function showDashboard()
    {

       $id = Auth::user()->hod_institute;

                $submittedformc = DB::select("Select count(basic_infos.user_id) as total  from basic_infos left join trip_infos on basic_infos.user_id = trip_infos.user_id 
                    left join organizations on trip_infos.org_name = organizations.id left join status on status.user_id = basic_infos.user_id
                    where confirmation = '1' and  organizations.id = '$id' and deptist is  not null ");
                $submittedform = $submittedformc[0]->total ?? 0;

                 $pendingc = DB::select("Select count(basic_infos.user_id) as total  from basic_infos left join trip_infos on basic_infos.user_id = trip_infos.user_id 
                    left join organizations on trip_infos.org_name = organizations.id left join status on status.user_id = basic_infos.user_id
                    where confirmation = '1' and  organizations.id = '$id' and deptist is  not null and instittute is  null");
                $pending = $pendingc[0]->total ?? 0;

              $verifiedbyinstitute = DB::table('basic_infos')
            ->where('verified_users', '1')
            // ->whereNULL('forward')
            ->count();

             $rejected = DB::table('basic_infos')
            ->where('verified_users', '0')
            ->count();

              $forward = DB::table('basic_infos')
            ->where('forward', 'Yes')
            ->count();

            $station = DB::table('status')
    ->where('station', '1')
    ->count();

    $handover = DB::table('status')
    ->where('handover', '1')
    ->count();

 

$maleCount = DB::table('basic_infos')
->join('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
      ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
    ->where('confirmation', '1')
    ->where('organizations.id', $id)
    ->where('gender', 'Male')
    
    ->count();

$femaleCount = DB::table('basic_infos')
->join('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
      ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
    ->where('confirmation', '1')
    ->where('organizations.id', $id)
    ->where('gender', 'Female')
     
    ->count();

   $lahoreCount = DB::table('trip_infos')
    ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->where('basic_infos.district', '1')
    ->where('confirmation', '1')
    ->count();


$multanCount = DB::table('trip_infos')
    ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->where('basic_infos.district', '2')
    ->where('confirmation', '1')
    ->count();

$rawalpindiCount = DB::table('trip_infos')
    ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->where('basic_infos.district', '3')
    ->where('confirmation', '1')
    ->count();

    $peprisCount = DB::table('hods')->where('name', 'PEPRIS')->count();
$hedGovCount =  DB::table('trip_infos')
    ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
   
    ->where('confirmation', '1')
    ->where('organizations.hod_id', '2')
    ->count();

$hedPrivateCount = DB::table('hods')->where('name', 'HED Private')->count();
$tevtaCount = DB::table('trip_infos')
    ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
   
    ->where('confirmation', '1')
    ->where('organizations.hod_id', '4')
    ->count();
$sedCount = DB::table('trip_infos')
    ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
    
    ->where('confirmation', '1')
    ->where('organizations.hod_id', '5')
    ->count();
$pvtcCount = DB::table('trip_infos')
    ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
   
    ->where('confirmation', '1')
    ->where('organizations.hod_id', '6')
    ->count();
$madrassaCount = DB::table('hods')->where('name', 'Madrassa')->count();

        return view('Institute.Institutedashboard', compact('submittedform','verifiedbyinstitute', 'forward','rejected','station','handover','pending','maleCount','femaleCount','lahoreCount',
    'multanCount','rawalpindiCount','peprisCount','hedGovCount','hedPrivateCount','tevtaCount','sedCount','pvtcCount','madrassaCount'));

    }
    

    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function index1()
    {
         $id = Auth::user()->hod_institute;
         $data = DB::table('basic_infos')
    ->select('basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact', 'basic_infos.user_id as uid','organizations.org_name','tehsils.tehsil_name as teh_name', 'districts.name as dname') // Corrected select
    ->leftJoin('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
    ->leftJoin('tehsils', 'tehsils.id', '=', 'trip_infos.tehsil')
    ->leftJoin('organizations', 'organizations.id', '=', 'trip_infos.org_name')
       ->leftJoin('status','basic_infos.user_id','=','status.user_id')
    // ->whereNotNULL('basic_infos.confirmation')     not in the showDashboard function's submittedformc, it'sconfirmation = 1 
    // ->whereNULL('basic_infos.verified_users')      not in the showDashboard function's submittedformc
    ->where('basic_infos.confirmation', '1')
    ->where('trip_infos.org_name',$id)
    ->whereNotNULL('deptist')
    ->get();


        return view('Institute.ViewUsers', compact('data'));
    }

    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function verifiedUsers()
    {
         $id = Auth::user()->hod_institute;
         $data = DB::table('basic_infos')
    ->select('basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact', 'basic_infos.user_id as uid','organizations.org_name','tehsils.tehsil_name as teh_name', 'districts.name as dname') // Corrected select
    ->leftJoin('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
    ->leftJoin('tehsils', 'tehsils.id', '=', 'trip_infos.tehsil')
    ->leftJoin('organizations', 'organizations.id', '=', 'trip_infos.org_name')
    // ->whereNotNULL('basic_infos.confirmation')
    ->where('basic_infos.verified_users', '1')
    // ->where('trip_infos.org_name',$id)
    ->get();

        return view('Institute.Verified', compact('data'));
    }

    public function pendingUsers()
{
    $id = Auth::user()->hod_institute;

    $data = DB::table('basic_infos')
        ->select(
            'basic_infos.passenger_name',
            'basic_infos.cnic',
            'basic_infos.contact',
            'basic_infos.user_id as uid',
            'organizations.org_name',
            'tehsils.tehsil_name as teh_name',
            'districts.name as dname'
        )
        ->leftJoin('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
        ->leftJoin('tehsils', 'tehsils.id', '=', 'trip_infos.tehsil')
        ->leftJoin('organizations', 'organizations.id', '=', 'trip_infos.org_name')
        ->leftJoin('status','basic_infos.user_id','=','status.user_id')
        ->where('basic_infos.confirmation', '1')
        ->where('organizations.id', $id)
        ->whereNotNull('deptist')
        ->whereNull('instittute')
        ->get();

    return view('Institute.pending', compact('data'));
}


    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function rejectedUsers()
    {
        $data = DB::table('basic_infos')
    ->select('basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact', 'basic_infos.user_id as uid','organizations.org_name','tehsils.tehsil_name as teh_name', 'districts.name as dname') // Corrected select
    ->leftJoin('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
    ->leftJoin('tehsils', 'tehsils.id', '=', 'trip_infos.tehsil')
        ->leftJoin('organizations', 'organizations.id', '=', 'trip_infos.org_name')
    ->whereNotNULL('basic_infos.confirmation')
    ->where('basic_infos.verified_users', '0')
    ->get();


        return view('Institute.Rejected', compact('data'));
    }

    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function viewUsers()
    {
        $data = DB::table('basic_infos')
    ->select('basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact', 'basic_infos.user_id as uid','trip_infos.org_name','tehsils.tehsil_name as teh_name', 'districts.name as dname') // Corrected select
    ->leftJoin('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
    ->leftJoin('tehsils', 'tehsils.id', '=', 'trip_infos.tehsil')
    ->whereNotNULL('basic_infos.confirmation')
    ->get();


        return view('Institute.ViewUsers', compact('data'));
    }

    /**
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verifyUser(Request $request, $user_id)
    {
        try {
            Log::info("Attempting to verify user with user_id: {$user_id}");
            $user = DB::table('basic_infos')->where('user_id', $user_id)->first();
            if (!$user) {
                Log::warning("User not found for user_id: {$user_id}");
                return redirect()->back()->with('error', 'User not found');
            }
            if ($user->verified_users) {
                Log::info("User already verified for user_id: {$user_id}");
                return redirect()->back()->with('error', 'User is already verified');
            }

            $updated = DB::table('basic_infos')
                ->where('user_id', $user_id)
                ->update([
                    'verified_users' => 1,
                    'end_year'=>$request->end_year,
                ]);
                 Status::updateOrCreate(
    ['user_id' => $user_id], // find by user_id
    [
        
        'instittute'=> '1',
    ]
);

            if ($updated) {
                Log::info("User verified successfully for user_id: {$user_id}");
                return redirect()->back()->with('success', 'User verified successfully');
            } else {
                Log::warning("Failed to update verified_users for user_id: {$user_id}");
                return redirect()->back()->with('error', 'Failed to verify user');
            }
        } catch (\Exception $e) {
            Log::error("Error verifying user_id {$user_id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }

    /**
     *
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $user_id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rejectUser(Request $request, $user_id)
    {

        // dd($request->all(), $user_id);
        
        try {
            Log::info("Attempting to reject user with user_id: {$user_id}");
          
             $request->validate([
        'end_year' => 'required|date_format:Y-m',
        'rejection_reason' => 'nullable|string|max:1000'
    ]);

            $user = DB::table('basic_infos')->where('user_id', $user_id)->first();
            // dd($user);
            if (!$user) {
                Log::warning("User not found for user_id: {$user_id}");
                return redirect()->back()->with('error', 'User not found');
            }

            // if ($user->verified_users) {
            //     Log::info("User already verified for user_id: {$user_id}");
            //     return redirect()->back()->with('error', 'User is already verified');
            // }

                        $updated = DB::table('basic_infos')
                ->where('user_id', $user_id)
                ->update([
                    'verified_users' => 0,
                    'end_year'=>$request->end_year,
                    'rejection_reason' => $request->rejection_reason ?? $user->rejection_reason
                ]);

                
// dd($updated, DB::table('basic_infos')->where('user_id', $user_id)->first());
                  Status::updateOrCreate(
    ['user_id' => $user_id], // find by user_id
    [
        
        'instittute'=> '0',
    ]
);

            if ($updated) {
                Log::info("User rejected successfully for user_id: {$user_id}");
                return redirect()->back()->with('success', 'User rejected successfully');
            } else {
                Log::warning("Failed to update confirmation for user_id: {$user_id}");
                return redirect()->back()->with('error', 'Failed to reject user');
            }
        } catch (\Exception $e) {
            Log::error("Error rejecting user_id {$user_id}: " . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }

         
    }


    public function viewdetail($id)
{

        $data = DB::table('basic_infos')
            ->leftJoin('trip_infos', 'basic_infos.user_id', '=', 'trip_infos.user_id')
            ->leftJoin('attachments', 'basic_infos.user_id', '=', 'attachments.user_id')
            ->leftJoin('districts', 'trip_infos.district', '=', 'districts.id')
            ->leftJoin('tehsils', 'trip_infos.tehsil', '=', 'tehsils.id')
            ->leftJoin('edu_levels', 'edu_levels.id', '=', 'trip_infos.edu_level')
            ->leftJoin('organizations', 'trip_infos.org_name', '=', 'organizations.id')
            ->leftJoin('institute_types', 'trip_infos.institute_type', '=', 'institute_types.id')
            ->select(
                'basic_infos.id',
                'basic_infos.user_id',
                'basic_infos.passenger_name',
                'basic_infos.cnic',
                'basic_infos.contact',
                'basic_infos.dob',
                'basic_infos.gender',
                'basic_infos.cnic_type',
                'basic_infos.cnic_expiry',
                'basic_infos.category',
                'basic_infos.confirmation',
                'basic_infos.verified_users',
                'basic_infos.feedback',
                'trip_infos.card_type',
                'districts.name as district',
                'tehsils.tehsil_name as tehsil',
                'institute_types.name as institute_type',
                'edu_levels.name as edu_level',
                'organizations.org_name',
                'trip_infos.address',
                'attachments.photo',
                'attachments.cnic_front',
                'attachments.cnic_back',
                'attachments.bform',
                'attachments.student_id_card'
            )
            ->where('basic_infos.user_id', $id)
            ->first();

// dd($id, $data);

    return view('Institute.viewdetail', compact('data'));
}


public function saveReject(Request $request, $user_id)
{
    $request->validate([
        'rejection_reason' => 'required|string|max:1000'
    ]);

    DB::table('basic_infos')
        ->where('user_id', $user_id)
        ->update([
            'rejection_reason' => $request->rejection_reason,
            'confirmation' => 0 
        ]);

    if ($request->expectsJson()) {
        return response()->json(['success' => true, 'message' => 'Rejection reason saved.']);
    }

    return back()->with('success', 'Rejection reason saved.');
}

public function editReject(Request $request, $user_id)
{
    $request->validate([
        'rejection_reason' => 'required|string|max:1000'
    ]);

    DB::table('basic_infos')
        ->where('user_id', $user_id)
        ->update(['rejection_reason' => $request->rejection_reason]);

    if ($request->expectsJson()) {
        return response()->json(['success' => true, 'message' => 'Rejection reason updated.']);
    }

    return back()->with('success', 'Rejection reason updated.');
}

public function deleteReject(Request $request, $user_id)
{
    DB::table('basic_infos')
        ->where('user_id', $user_id)
        ->update(['rejection_reason' => null,
    'confirmation' => 1 
    ]);

    if ($request->expectsJson()) {
        return response()->json(['success' => true, 'message' => 'Rejection reason deleted.']);
    }

    return back()->with('success', 'Rejection reason deleted.');
}



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Institute  $institute
     * @return \Illuminate\Http\Response
     */
    public function show(Institute $institute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Institute  $institute
     * @return \Illuminate\Http\Response
     */
    public function edit(Institute $institute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Institute  $institute
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Institute $institute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Institute  $institute
     * @return \Illuminate\Http\Response
     */
    public function destroy(Institute $institute)
    {
        //
    }
}
