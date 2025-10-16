<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\RegInstitute;
use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
use DB;

class PmaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function pmadashboard()
    {

         $submittedform = DB::table('basic_infos')
            ->where('confirmation', '1')
            ->count();


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

    $pending = DB::table('status')
    ->whereNull('deptist')
    ->count();


$maleCount = DB::table('basic_infos')
    ->where('gender', 'Male')
       ->where('confirmation', '1')
    ->count();

$femaleCount = DB::table('basic_infos')
    ->where('gender', 'Female')
       ->where('confirmation', '1')
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

$pendinginstitute = DB::table('status')
    ->whereNull('instittute')
    ->count();

    $handedover =  DB::table('status')
    ->whereNotNull('handover')
    ->count();

$districts = DB::table('trip_infos')
    ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->join('status', 'basic_infos.user_id', '=', 'status.user_id')
    ->join('districts', 'trip_infos.district', '=', 'districts.id')
    ->where('basic_infos.confirmation', '1')
    ->whereNull('status.deptist')
    ->select('districts.id', 'districts.name', DB::raw('COUNT(*) as total'))
    ->groupBy('districts.id', 'districts.name')
    ->orderBy('districts.name')
    ->get();

    $institute_districts = DB::table('trip_infos')
    ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->join('status', 'basic_infos.user_id', '=', 'status.user_id')
    ->join('districts', 'trip_infos.district', '=', 'districts.id')
    ->where('basic_infos.confirmation', '1')
    ->whereNull('status.instittute')
    ->select('districts.id', 'districts.name', DB::raw('COUNT(*) as total'))
    ->groupBy('districts.id', 'districts.name')
    ->orderBy('districts.name')
    ->get();

     $verified_districts = DB::table('trip_infos')
            ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
            ->join('status', 'basic_infos.user_id', '=', 'status.user_id')
            ->join('districts', 'trip_infos.district', '=', 'districts.id')
            ->where('basic_infos.confirmation', '1')
            ->where('status.deptist', '1')
            ->select('districts.id', 'districts.name', DB::raw('COUNT(*) as total'))
            ->groupBy('districts.id', 'districts.name')
            ->orderBy('districts.name')
            ->get();

        $station_districts = DB::table('trip_infos')
            ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
            ->join('status', 'basic_infos.user_id', '=', 'status.user_id')
            ->join('districts', 'trip_infos.district', '=', 'districts.id')
            ->where('basic_infos.confirmation', '1')
            ->where('status.station', '1')
            ->select('districts.id', 'districts.name', DB::raw('COUNT(*) as total'))
            ->groupBy('districts.id', 'districts.name')
            ->orderBy('districts.name')
            ->get();

            $handedover_districts = DB::table('trip_infos')
            ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
            ->join('status', 'basic_infos.user_id', '=', 'status.user_id')
            ->join('districts', 'trip_infos.district', '=', 'districts.id')
            ->where('basic_infos.confirmation', '1')
            ->where('status.handover', '1')
            ->select('districts.id', 'districts.name', DB::raw('COUNT(*) as total'))
            ->groupBy('districts.id', 'districts.name')
            ->orderBy('districts.name')
            ->get();

   $departments = DB::table('trip_infos')
        ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->join('status', 'basic_infos.user_id', '=', 'status.user_id')
        ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->join('hods', 'organizations.hod_id', '=', 'hods.id')
        ->join('districts', 'trip_infos.district', '=', 'districts.id')
        ->where('basic_infos.confirmation', '1')
        ->whereNull('status.deptist')
        ->select(
            'districts.id',
            'districts.name',
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('districts.id', 'districts.name')
        ->orderBy('districts.name')
        ->get();

        return view('pma.pmadashboard', compact('districts','handedover_districts','station_districts','verified_districts','institute_districts','pendinginstitute','handedover','departments','submittedform','verifiedbyinstitute', 'forward','rejected','station','handover','pending','maleCount','femaleCount','lahoreCount',
    'multanCount','rawalpindiCount','peprisCount','hedGovCount','hedPrivateCount','tevtaCount','sedCount','pvtcCount','madrassaCount'));

    }

    public function statusbar(){


        $submittedform = DB::table('basic_infos')
            ->where('confirmation', '1')
            ->count();

             $verified = DB::table('basic_infos')
            ->where('verified_users', '1')
            ->count();

             $pending = DB::table('basic_infos')
            ->where('verified_users', '0')
            ->count();

              $forward = DB::table('basic_infos')
            ->where('forward', 'Yes')
            ->count();


            return view('pma.statusbar')->with(compact('submittedform', 'pending', 'verified', 'forward'));


    }

    protected function regappli()
    {

    $data = DB::table('basic_infos')
    ->select('basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact', 'basic_infos.user_id as uid','organizations.org_name','tehsils.tehsil_name as teh_name', 'districts.name as dname') // Corrected select
    ->leftJoin('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
    ->leftJoin('tehsils', 'tehsils.id', '=', 'trip_infos.tehsil')
    ->leftJoin('organizations', 'trip_infos.org_name', '=', 'organizations.id')
    ->whereNotNULL('basic_infos.confirmation')
    ->get();

        return view('pma.regappli', compact('data'));
    }

        protected function pendingappli()
    {

    $data = DB::table('basic_infos')
    ->select('basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact', 'basic_infos.user_id as uid','organizations.org_name','tehsils.tehsil_name as teh_name', 'districts.name as dname') // Corrected select
    ->leftJoin('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
    ->leftJoin('tehsils', 'tehsils.id', '=', 'trip_infos.tehsil')
    ->leftJoin('organizations', 'trip_infos.org_name', '=', 'organizations.id')
    ->whereNotNULL('basic_infos.confirmation')
    ->whereNULL('basic_infos.verified_users')

    ->get();

        return view('pma.pendingappli', compact('data'));
    }

        protected function verifyappli()
    {

    $data = DB::table('basic_infos')
    ->select('basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact', 'basic_infos.user_id as uid','organizations.org_name','tehsils.tehsil_name as teh_name', 'districts.name as dname') // Corrected select
    ->leftJoin('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
    ->leftJoin('tehsils', 'tehsils.id', '=', 'trip_infos.tehsil')
    ->leftJoin('organizations', 'trip_infos.org_name', '=', 'organizations.id')
    ->whereNotNULL('basic_infos.confirmation')
    ->where('basic_infos.verified_users', '1')
    ->whereNULL('basic_infos.forward')

    ->get();

        return view('pma.verifyappli', compact('data'));
    }


        protected function rejectedappli()
    {

    $data = DB::table('basic_infos')
    ->select('basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact', 'basic_infos.user_id as uid','organizations.org_name','tehsils.tehsil_name as teh_name', 'districts.name as dname') // Corrected select
    ->leftJoin('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
    ->leftJoin('tehsils', 'tehsils.id', '=', 'trip_infos.tehsil')
    ->leftJoin('organizations', 'trip_infos.org_name', '=', 'organizations.id')
    ->whereNotNULL('basic_infos.confirmation')
    ->where('basic_infos.verified_users', '0')
    ->get();

        return view('pma.rejectappli', compact('data'));
    }

        protected function forwardtobop()
    {

    $data = DB::table('basic_infos')
    ->select('basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact', 'basic_infos.user_id as uid','organizations.org_name','tehsils.tehsil_name as teh_name', 'districts.name as dname') // Corrected select
    ->leftJoin('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
    ->leftJoin('tehsils', 'tehsils.id', '=', 'trip_infos.tehsil')
    ->leftJoin('organizations', 'trip_infos.org_name', '=', 'organizations.id')
    ->whereNotNULL('basic_infos.confirmation')
    ->where('basic_infos.forward', 'Yes')

    ->get();

        return view('pma.forwardtobop', compact('data'));
    }

     protected function viewapplidetail($id)
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
                'basic_infos.user_id as uid',
                'basic_infos.passenger_name',
                'basic_infos.cnic',
                'basic_infos.contact',
                'basic_infos.dob',
                'basic_infos.forward',
                'basic_infos.feedback',
                'basic_infos.gender',
                'basic_infos.cnic_type',
                'basic_infos.cnic_expiry',
                'basic_infos.category',
                'basic_infos.confirmation',
                'basic_infos.verified_users',
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
            ->get();


    return view('pma.viewdetail', compact('data'));
}

     protected function forwardapplitobop($id)
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
                'basic_infos.user_id as uid',
                'basic_infos.passenger_name',
                'basic_infos.cnic',
                'basic_infos.contact',
                'basic_infos.dob',
                'basic_infos.forward',
                'basic_infos.feedback',
                'basic_infos.gender',
                'basic_infos.cnic_type',
                'basic_infos.cnic_expiry',
                'basic_infos.category',
                'basic_infos.confirmation',
                'basic_infos.verified_users',
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
            ->get();


    return view('pma.forwardapplications', compact('data'));
}


    public function storeforward(Request $request)
    {

        $verify = $request->validate([

            'user_id' => '',
            'forward' => '',
            'feedback' => '',


        ]);


        $info = DB::table('basic_infos')->updateOrInsert(

                        ['user_id' => $request->user_id],

            $verify
        );

                return redirect()->back()->with('success', 'Forwarded successfully');


    }


   
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
    return view('pma.pmashowform')->with(compact(
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

public function showhod()
{
 $hods = DB::SELECT("SELECT * from hods");

 $organizations = DB::table('organizations')->select('id', 'org_name')->get();

        return view('pma.addheadofinstitute', compact('hods','organizations'));
    }



public function addhod(Request $request)
{

    // dd($request->all());
    
    
    $validatedUser = $request->validate([
        'name'          => 'required|string|max:255',
        'email'         => 'required|email|unique:users,email',
        'phone_number'  => 'required|string|max:15|unique:users,phone_number',
        'cnic'          => 'required|string|max:15|unique:users,cnic',
        'password'      => 'required|string|min:8|confirmed',
        'role'          => 'required|integer',
        // 'new_org_name'  => 'nullable|string|max:255',
        'org_name'       => 'required',
        //   'new_org_name'  => 'required_if:org_name,other|string|max:255',
        'new_org_name'  => 'required_if:org_name,other|nullable|string|max:255',
        'district'       => 'required|integer',
        'tehsil'         => 'required|integer',
        'institute_type' => 'required|integer',
        'edu_level'      => 'required|integer',
        // 'hod_institute'  => 'required|string',
    ]);

//    dd('Validation passed', $validatedUser);
    $otp = rand(10000, 99999);

    
    $validatedUser['password'] = Hash::make($validatedUser['password']);
    $validatedUser['otp'] = $otp;
    $validatedUser['verify'] = 0; // default 0 = not verified
    $validatedUser['city'] = $request->district ?? null;
    // $validatedUser['hod_institute'] = $request->org_name ?? null;
    // $validatedUser['hod_institute'] = $request->hod_institute ?? null;

 $user = User::create($validatedUser);

  if ($request->org_name === 'other' ) {
        // Add new organization
        $newOrg = DB::table('organizations')->insertGetId([
            'district_id'     => $request->district,
            'tehsil_id'       => $request->tehsil,
            'institute_type'  => $request->institute_type,
            'edu_level'       => $request->edu_level,
            'org_name'        => $request->new_org_name,
            'hod_id'          => $user->id, // will update later if needed
            'created_by'      => auth()->id(),
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        $user->update(['hod_institute' => $newOrg]);

    } else {

        $selectedOrgId = intval($request->org_name);

        DB::table('organizations')
            ->where('id', $selectedOrgId)
            ->update(['hod_id' => $user->id]);

        $user->update(['hod_institute' => $selectedOrgId]);
    }

        
        
    //     $validatedUser['hod_institute'] = $newOrg;
    // } else {
        
    //     $validatedUser['hod_institute'] = intval($request->org_name); 
    // }

//     dd([
//     'org_name' => $request->org_name,
//     'new_org_name' => $request->new_org_name,
//     'condition_matched' => $request->org_name === 'other'
// ]);

       
   

    // if (isset($newOrgId)) {
    //     DB::table('organizations')
    //         ->where('id', $newOrgId)
    //         ->update(['hod_id' => $user->id]);
    // }

    //  DB::table('organizations')
    // ->where('id', $validatedUser['hod_institute'])
    // ->update(['hod_id' => $user->id]);

   
    $securityKey = config('services.messagepitb.securityKey');
    $smsText     = 'Your verification code is ' . $otp;
    $dataNumber  = $request->phone_number;

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
    curl_close($ch);

    
    // if ($request->has('org_name')) {
    //     $regInput = [
    //         'user_id' => $user->id,
    //         'org_name' => $request->org_name,
    //         'district' => $request->district,
    //         'institute_type' => $request->institute_type,
    //     ];
    //     RegInstitute::create($regInput);
    // }

    
    return redirect()->back()->with('success', 'Head of Institute added successfully! OTP sent to the provided phone number.');
}





}
