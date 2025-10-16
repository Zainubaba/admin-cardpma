<?php

namespace App\Http\Controllers;
use App\Models\User;

use App\Models\Cardform;
use App\Models\Regdt;
use App\Models\Regd;
use App\Models\Regb;
use App\Models\BasicInfo;
use App\Models\TripInfo;
use App\Models\Attachment;
use App\Models\Guardian;
use App\Models\District;


use Validator,Redirect,Response,File;
use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Hash;


class CardformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('user.userdashboard');

    }

    public function getinfobycnic($cnic)
    {

            $basicInfo = DB::select("SELECT basic_infos.user_id as useid,basic_infos.*,trip_infos.*,attachments.* FROM basic_infos
            left join trip_infos on basic_infos.user_id = trip_infos.user_id
            left join attachments on basic_infos.user_id = attachments.user_id
            where cnic = $cnic");

    if ($basicInfo) {
        return response()->json([
            'success' => true,
            'data' => $basicInfo
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'No record found'
        ]);
    }


    }


      public function districtwisedata()
    {

         $students = DB::table('trip_infos')
            ->select('districts.name as district_name', 'districts.id as d_id',
                DB::raw("COUNT(basic_infos.id) as count"),

            )
            ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
            ->leftJoin('basic_infos', 'basic_infos.user_id', '=', 'trip_infos.user_id')

            ->whereNotNull('basic_infos.confirmation')
            ->groupby('districts.name', 'districts.id')
            ->get();

        return view('dashboard_design.districtwisedata', compact('students'));

    }

     public function districtwiseverifieddata()
    {

         $students = DB::table('trip_infos')
            ->select('districts.name as district_name', 'districts.id as d_id',
                DB::raw("COUNT(basic_infos.id) as count"),

            )
            ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
            ->leftJoin('basic_infos', 'basic_infos.user_id', '=', 'trip_infos.user_id')

            ->whereNotNull('basic_infos.confirmation')
            ->where('basic_infos.verified_users', '1')
            ->groupby('districts.name', 'districts.id')
            ->get();

        return view('dashboard_design.districtwiseverified', compact('students'));

    }

     public function districtwiseforwardeddata()
    {

         $students = DB::table('trip_infos')
            ->select('districts.name as district_name', 'districts.id as d_id',
                DB::raw("COUNT(basic_infos.id) as count"),

            )
            ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
            ->leftJoin('basic_infos', 'basic_infos.user_id', '=', 'trip_infos.user_id')

            ->whereNotNull('basic_infos.confirmation')
            ->where('basic_infos.forward', 'Yes')
            ->groupby('districts.name', 'districts.id')
            ->get();

        return view('dashboard_design.districtwiseforwarded', compact('students'));

    }

     public function totalsubmitteddata($id)
    {

         $data = DB::table('basic_infos')
                    ->select('basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact', 'basic_infos.user_id as uid','trip_infos.org_name','tehsils.tehsil_name as teh_name', 'districts.name as dname') // Corrected select
                    ->leftJoin('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
                    ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
                    ->leftJoin('tehsils', 'tehsils.id', '=', 'trip_infos.tehsil')
                    ->whereNotNULL('basic_infos.confirmation')
                    ->where('trip_infos.district', $id)
                    ->get();

        return view('dashboard_design.applicantslist', compact('data'));

    }

     public function totalverifieddata($id)
    {

         $data = DB::table('basic_infos')
                    ->select('basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact', 'basic_infos.user_id as uid','trip_infos.org_name','tehsils.tehsil_name as teh_name', 'districts.name as dname') // Corrected select
                    ->leftJoin('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
                    ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
                    ->leftJoin('tehsils', 'tehsils.id', '=', 'trip_infos.tehsil')
                    ->whereNotNULL('basic_infos.confirmation')
                    ->where('basic_infos.verified_users', '1')
                    ->where('trip_infos.district', $id)
                    ->get();

        return view('dashboard_design.applicantslist', compact('data'));

    }

     public function totalforwardeddata($id)
    {

         $data = DB::table('basic_infos')
                    ->select('basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact', 'basic_infos.user_id as uid','trip_infos.org_name','tehsils.tehsil_name as teh_name', 'districts.name as dname') // Corrected select
                    ->leftJoin('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
                    ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
                    ->leftJoin('tehsils', 'tehsils.id', '=', 'trip_infos.tehsil')
                    ->whereNotNULL('basic_infos.confirmation')
                    ->whereNotNULL('basic_infos.forward', 'Yes')
                    ->where('trip_infos.district', $id)
                    ->get();

        return view('dashboard_design.applicantslist', compact('data'));

    }

    public function viewstudetail($id)
{

        $data = DB::table('basic_infos')
            ->leftJoin('trip_infos', 'basic_infos.user_id', '=', 'trip_infos.user_id')
            ->leftJoin('attachments', 'basic_infos.user_id', '=', 'attachments.user_id')
            ->leftJoin('districts', 'trip_infos.district', '=', 'districts.id')
            ->leftJoin('tehsils', 'trip_infos.tehsil', '=', 'tehsils.id')
            ->leftJoin('service_providers', 'service_providers.id', '=', 'trip_infos.system_name')
            ->leftJoin('stations', 'trip_infos.station_name', '=', 'stations.id')
            ->leftJoin('stops', 'trip_infos.stop_name', '=', 'stops.id')
            ->select(
                'basic_infos.id',
                'basic_infos.user_id as uid',
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
                'trip_infos.institute_type',
                'trip_infos.edu_level',
                'trip_infos.org_name',
                'trip_infos.address',
                'stations.name as nearby_station',
                'service_providers.name as system_name',
                'stops.name as stop',
                'trip_infos.bop_branch',
                'attachments.photo',
                'attachments.cnic_front',
                'attachments.cnic_back',
                'attachments.bform',
                'attachments.student_id_card'
            )
            ->where('basic_infos.user_id', $id)
            ->get();


    return view('dashboard_design.viewstudetail', compact('data'));
}


     public function dashboard()
    {

          $submittedappli = DB::table('basic_infos')
            ->whereNotNull('confirmation')
            ->count();

        $verified = DB::table('basic_infos')
            ->where('verified_users', '1')
            ->count();


            $forwardtobop = DB::table('basic_infos')
            ->where('forward' , '=', 'Yes')

            ->count();

              $genderCounts = DB::table('basic_infos')
            ->whereNotNull('basic_infos.confirmation')
            ->select(
                DB::raw("SUM(CASE WHEN basic_infos.gender = 'Male'  THEN 1 ELSE 0 END) as male"),
                DB::raw("SUM(CASE WHEN basic_infos.gender = 'Female' THEN 1 ELSE 0 END) as female"),
            )
            ->get();

        $labels = ["Male", "Female"];
        $dataValues = [0, 0, 0];
        foreach ($genderCounts as $genderCount) {
            $dataValues[0] = $genderCount->male;
            $dataValues[1] = $genderCount->female;
        }

        // Count applicants by religion
        $OrgCounts = DB::table('trip_infos')
            ->select(
                DB::raw("SUM(CASE WHEN trip_infos.edu_level = 'Primary' or edu_level = 'Elementary' or edu_level = 'Matric' THEN 1 ELSE 0 END) as school"),
                DB::raw("SUM(CASE WHEN trip_infos.edu_level = 'Intermediate' or trip_infos.edu_level = 'BS' or edu_level = 'MS' or edu_level = 'PhD' THEN 1 ELSE 0 END) as college_uni"),
                DB::raw("SUM(CASE WHEN edu_level = 'Technical Education' THEN 1 ELSE 0 END) as tech_edu"),
                DB::raw("SUM(CASE WHEN trip_infos.edu_level = 'Mudrisa' THEN 1 ELSE 0 END) as mudrisa"),
                DB::raw("SUM(CASE WHEN trip_infos.edu_level = 'Medical' THEN 1 ELSE 0 END) as medical"),


            )
            ->leftJoin('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
            ->whereNotNull('basic_infos.confirmation')
            ->get();

        $rlabels = ["School", "College/University", "Technical Education", "Mudrisa", "Medical"];
        $rdataValues = [0, 0, 0, 0];
        foreach ($OrgCounts as $OrgCount) {
            $rdataValues[0] = $OrgCount->school;
            $rdataValues[1] = $OrgCount->college_uni;
            $rdataValues[2] = $OrgCount->tech_edu;
            $rdataValues[3] = $OrgCount->mudrisa;
            $rdataValues[4] = $OrgCount->medical;

        }

        //count for cities
                $CityCounts = DB::table('trip_infos')
            ->select(
                DB::raw("SUM(CASE WHEN trip_infos.district = '1' THEN 1 ELSE 0 END) as lahore"),
                DB::raw("SUM(CASE WHEN trip_infos.district = '2' THEN 1 ELSE 0 END) as multan"),
                DB::raw("SUM(CASE WHEN trip_infos.district = '3' THEN 1 ELSE 0 END) as rawalpindi"),

            )
            ->leftJoin('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
            ->whereNotNull('basic_infos.confirmation')
            ->get();

        $clabels = ["Lahore", "Multan", "Rawalpindi"];
        $cdataValues = [0, 0, 0, 0];
        foreach ($CityCounts as $CityCount) {
            $cdataValues[0] = $CityCount->lahore;
            $cdataValues[1] = $CityCount->multan;
            $cdataValues[2] = $CityCount->rawalpindi;

        }

        return view('dashboard_design.maindashboard', compact('submittedappli', 'verified', 'forwardtobop', 'labels',
        'dataValues',
        'rlabels',
        'rdataValues',
        'clabels',
        'cdataValues',
));

    }

    public function verify(Request $request)
    {
        $phoneno = Auth::user()->phone_number;
        $otp = $request->otp;

        // Check if the phone number and OTP match a user in the database
        $check = DB::select("SELECT * FROM users WHERE phone_number = ? AND otp = ?", [$phoneno, $otp]);
        if (!empty($check)) {
            // Update the verify status to 1
            User::where("phone_number", $phoneno)->update(["verify" => "1"]);

            // Redirect based on the user role
            if (Auth::user()->role == '1') {
                return redirect('/pmaform');
            } else {
                return redirect('/');
            }
        } else {
            // If OTP is incorrect, redirect back with an error message
            return Redirect::back()->withErrors(['msg' => 'YOUR OTP IS INCORRECT']);
        }
    }

    public function showForm()
{
    $data = DB::table('basic_infos')
        ->leftJoin('trip_infos', 'basic_infos.user_id', '=', 'trip_infos.user_id')
        ->leftJoin('attachments', 'basic_infos.user_id', '=', 'attachments.user_id')
        ->select(
            'basic_infos.id',
            'basic_infos.passenger_name',
            'basic_infos.cnic',
            'basic_infos.contact',
            'basic_infos.dob',
            'basic_infos.gender',
            'basic_infos.cnic_type',
            'basic_infos.cnic_expiry',
            'basic_infos.category',
            'basic_infos.confirmation',
            'trip_infos.card_type',
            'trip_infos.district',
            'trip_infos.tehsil',
            'trip_infos.institute_type',
            'trip_infos.edu_level',
            'trip_infos.org_name',
            'trip_infos.address',
            'trip_infos.bop_branch',
            'trip_infos.to_route1',
            'trip_infos.from_route1',
            'trip_infos.to_route2',
            'trip_infos.from_route2',
            'trip_infos.to_route3',
            'trip_infos.from_route3',
            'trip_infos.round_trip',
            'attachments.photo',
            'attachments.cnic_front',
            'attachments.cnic_back',
            'attachments.bform',
            'attachments.student_id_card'
        )
        ->get()
        ->toArray();

    $total_count = count($data);
    \Log::info('ShowForm Data:', ['data' => $data]);


    return view('Institute.showform', compact('data', 'total_count'));
}

   public function usershowForm($id)
{
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
            ->get();

    return view('user.showform', compact('data'));
}

    public function showDashboard()
    {
        return view('Institute.Institutedashboard');
    }


public function index1()
{
    $users = DB::table('basic_infos')
        ->leftJoin('trip_infos', 'basic_infos.user_id', '=', 'trip_infos.user_id')
        ->leftJoin('districts', 'trip_infos.district', '=', 'districts.id')
        // ->leftJoin('tehsils', 'trip_infos.tehsil', '=', 'tehsils.id')
        ->select(
            'basic_infos.id',
            'basic_infos.passenger_name as name',
            'basic_infos.cnic as cnic',
            'basic_infos.contact as phone',
            'districts.name as district',
            // 'tehsils.tehsil_name as tehsil',
            'trip_infos.org_name as organization'
        )
        ->get();

    $total_count = $users->count();

    $user_list = $users->map(function ($user) {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'cnic' => $user->cnic,
            'phone' => $user->phone,
            'district' => $user->district,
            // 'tehsil' => $user->tehsil,
            'organization' => $user->organization,
        ];
    })->toArray();

    return view('Institute.ViewUsers', compact('user_list', 'total_count'));
}









    // public function index1()
    // {

    //     $users = User::all();

    //     $total_count = $users->count();




    //     $user_list = $users->map(function ($user) {
    //         return [
    //             'id' => $user->id,
    //             'name' => $user->name,
    //             'cnic' => $user->CNIC,
    //             'phone' => $user->phone_number,
    //             'city' => $user->city,

    //         ];
    //     })->toArray();
    //     // dd($user_list, $total_count);

    //     return view('Institute.ViewUsers', compact('user_list', 'total_count'));
    // }

    public function viewUsers()
    {
        return view('Institute.ViewUsers');
    }
    public function message(){
        $securityKey    = config('services.messagepitb.securityKey');

        $dataNumber     = '03116076326';


        // $smsText        = 'آپ کی اپوائنٹمنٹ نیچے دی گئ تاریخ پر بُک ہو چکی ہے، میڈیکل معائنے کے لیے اپنے متعلقہ ہسپتال میں تشریف لے جائیں۔ '.$request['ddate'].'';
    $smsText = 'پی ایم اے نے آج کامیابی سے ایک ارب مسافروں کی نقل مکانی کا ہدف پورا کر لیا ہے۔ اس سلسلے میں حکومت پنجاب عوام کی بےحد مشکور ہے کہ آپ نے پاکستان میٹروبس سسٹم پے اعتماد کیا اور اس پراجیکٹ کو کامیاب بنایا۔ ہم آپ کے آرام دہ سفر کے لئیے ہمہ وقت کوشاں ہیں۔
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
        print_r($res_txt);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        $userId = Auth::id();

            $guardian = DB::table('guardians')
    ->where('user_id', $userId)
    ->first();
     $tripInfo = DB::table('trip_infos')->where('user_id', $userId)->first(); 
    $eduLevels = DB::table('edu_levels')->get();
    $districts = District::orderBy('name')->get(['id','name']);

    $userId = Auth::id();

// Check active basic_infos
$active = DB::table('basic_infos')->where('user_id', $userId)->first();

$showReapplyPrompt = false;
$archived = null;

if (!$active) {
    // If no active basic_infos, check for archived snapshot
    $archived = DB::table('archived_applications')
                 ->where('user_id', $userId)
                 ->orderByDesc('archived_at')
                 ->first();

    if ($archived) {
        $showReapplyPrompt = true;
    }
}




    // dd($tripInfo);

        try {


            $basicInfo = DB::table('basic_infos')
                ->where('user_id', $userId)
                ->whereNotNull('confirmation')
                ->first();

                $rejectionComment = null;

if ($basicInfo && $basicInfo->rejection_reason) {
    $rejectionComment = $basicInfo->rejection_reason;
}

            if ($basicInfo) {
                $confirmation = $basicInfo->confirmation;

                $data = DB::table('basic_infos')
        ->leftJoin('trip_infos', 'basic_infos.user_id', '=', 'trip_infos.user_id')
        ->leftJoin('attachments', 'basic_infos.user_id', '=', 'attachments.user_id')
        ->select(
            'basic_infos.id',
            'basic_infos.passenger_name',
            'basic_infos.cnic',
            'basic_infos.contact',
            'basic_infos.dob',
            'basic_infos.gender',
            'basic_infos.cnic_type',
            'basic_infos.cnic_expiry',
            'basic_infos.category',
            'basic_infos.confirmation',
            'trip_infos.card_type',
            'trip_infos.district',
            'trip_infos.tehsil',
            'trip_infos.institute_type',
            'trip_infos.edu_level',
            'trip_infos.org_name',
            'trip_infos.address',
            'trip_infos.nearby_station',
            'trip_infos.bop_branch',
            'trip_infos.to_route1',
            'trip_infos.from_route1',
            'trip_infos.to_route2',
            'trip_infos.from_route2',
            'trip_infos.to_route3',
            'trip_infos.from_route3',
            'trip_infos.round_trip',
            'attachments.photo',
            'attachments.cnic_front',
            'attachments.cnic_back',
            'attachments.bform',
            'attachments.student_id_card'
        )
        ->get()
        ->toArray();

    $total_count = count($data);
    \Log::info('ShowForm Data:', ['data' => $data]);


                return view('user.showform', compact('confirmation','data','guardian','districts','tripInfo','rejectionComment'));
            }

              $eduLevels = DB::table('edu_levels')->get();

            return view('design_main.form', compact('eduLevels','guardian','districts','tripInfo','rejectionComment','showReapplyPrompt', 'archived'));
        } catch (\Exception $e) {
            // Optional: log the error for debugging
            // Log::error($e->getMessage());

             $eduLevels = DB::table('edu_levels')->get();
            return view('design_main.form', compact('eduLevels', 'guardian','districts','tripInfo','rejectionComment','showReapplyPrompt', 'archived'));
        }
    }


 public function opcreate()
    {


        try {


             $userId = auth()->id(); 
        $eduLevels = DB::table('edu_levels')->get();
         $districts = DB::table('districts')->orderBy('name')->get();
         $provinces = DB::table('provinces')->orderBy('name')->get();

            $basicInfo = DB::table('basic_infos')
                ->where('user_id', $userId)
                ->whereNotNull('confirmation')
                ->first();

            if ($basicInfo) {
                $confirmation = $basicInfo->confirmation;

                $data = DB::table('basic_infos')
        ->leftJoin('trip_infos', 'basic_infos.user_id', '=', 'trip_infos.user_id')
        ->leftJoin('attachments', 'basic_infos.user_id', '=', 'attachments.user_id')
        ->select(
            'basic_infos.id',
            'basic_infos.passenger_name',
            'basic_infos.cnic',
            'basic_infos.contact',
            'basic_infos.dob',
            'basic_infos.gender',
            'basic_infos.cnic_type',
            'basic_infos.cnic_expiry',
            'basic_infos.category',
            'basic_infos.confirmation',
            'trip_infos.card_type',
            'trip_infos.district',
            'trip_infos.tehsil',
            'trip_infos.institute_type',
            'trip_infos.edu_level',
            'trip_infos.org_name',
            'trip_infos.address',
            'trip_infos.nearby_station',
            'trip_infos.bop_branch',
            'trip_infos.to_route1',
            'trip_infos.from_route1',
            'trip_infos.to_route2',
            'trip_infos.from_route2',
            'trip_infos.to_route3',
            'trip_infos.from_route3',
            'trip_infos.round_trip',
            'attachments.photo',
            'attachments.cnic_front',
            'attachments.cnic_back',
            'attachments.bform',
            'attachments.student_id_card'
        )
        ->get()
        ->toArray();

        


    $total_count = count($data);
    \Log::info('ShowForm Data:', ['data' => $data]);

    


                return view('user.showform', compact('confirmation','data'));
            }
            

           return view('openform', compact('eduLevels','districts','provinces')); // include $eduLevels even here
    } catch (\Exception $e) {
        \Log::error($e->getMessage());
        return view('openform', compact('eduLevels','districts','provinces')); // also in the catch
    }
        
    }
    /**
     * Store a newly created resource in storage.
     *
      *@param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


     public function storecheck(Request $request)

{


    $check = $request->validate([

        'confirmation' => '',
        'user_id' => '',

    ]);

    $check ['user_id'] = Auth::user()->id;

    BasicInfo::updateOrCreate(
        ['user_id' => $check['user_id']],
        $check
    );


    $role = Auth::user()->role;
    $user = Auth::user()->id;


    if(Auth::user()->role == '1'){
       $datanum = DB::select("SELECT phone_number from users where id = $user ")[0]->phone_number;



     $securityKey    = config('services.messagepitb.securityKey');

     $dataNumber     = $datanum;


 $smsText = 'آپ کی درخواست جمع ہو چکی ہے۔ مزید معلومات کے لیے students-t-cash.punjab.gov.pk اس لنک پر کلک کر کے آپ اپنے قومی شناختی کارڈ اور پاسورڈ کے ذریعے اپنی درخواست کو ٹریک کر سکتے ہیں۔';

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


   }

    return redirect()->route('user.showform', $check ['user_id']);


}

 public function opstorecheck(Request $request)

{


    $check = $request->validate([

        'confirmation' => '',
        'user_id' => '',

    ]);


    BasicInfo::updateOrCreate(
        ['user_id' => $check['user_id']],
        $check
    );

        $userId = $check['user_id'];

    $role = DB::SELECT("SELECT role from users where id = $userId")[0]->role;
    $user = $userId;


    if($role == '1'){
       $datanum = DB::select("SELECT phone_number from users where id = $user")[0]->phone_number;



     $securityKey    = config('services.messagepitb.securityKey');

     $dataNumber     = $datanum;


 $smsText = 'آپ کی درخواست جمع ہو چکی ہے۔ مزید معلومات کے لیے students-t-cash.punjab.gov.pk اس لنک پر کلک کر کے آپ اپنے قومی شناختی کارڈ اور پاسورڈ کے ذریعے اپنی درخواست کو ٹریک کر سکتے ہیں۔';

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


   }

        return redirect()->route('login')->with('success','You have registered successfully. Please log in to your account!');


}

public function opstoreform(Request $request)
     {

        $userId = $request->input('user_id');

    
    if (!$userId && auth()->check()) {
        $userId = auth()->id();
    }

    $confirmation = DB::table('basic_infos')->where('user_id', $userId)->value('confirmation');

    if ($confirmation === 1) {
        return response()->json([
            'success' => false,
            'message' => 'You cannot update this form. It has already been confirmed.'
        ], 403);
    }

         $step = $request->input('step');

         switch ($step) {
             case 1:
                 // Validate and process data for step 1
                 $basic = $request->validate([
                     'user_id' => '',
                     'category' => 'required',
                     'passenger_name' => 'required|string|max:20',
                     'gender' => 'required',
                     'district' => '',
                     'cnic_type' => 'required',
                     'cnic' => 'required',
                     'cnic_expiry'=>'',
                      'cnic_issuance_date'=>'',
                     'contact'=>'required',
                     'dob'=>'required',
                     'punjab_domicile'=>'required',
                    //  'guardian_relation' => 'nullable|string|max:20',
                    //  'appointment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',

                 ]);

//                  $appointmentPath = null;
// if ($request->hasFile('appointment')) {
//     $file = $request->file('appointment');
//     $filename = time() . '_' . $file->getClientOriginalName();
//     $appointmentPath = $file->storeAs('uploads/guardians', $filename, 'public');

    
// }
                 $rand = rand(0, 99999);
        $verify = '0';
               $user =   User::updateOrCreate(
                     ['cnic' => $basic['cnic']],
                     [

            'name' => $basic['passenger_name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'phone_number' => $basic['contact'],
            'otp' => $rand,
            'verify' => $verify,

        ]);
               $basic['user_id'] = $user->id;
                $basicInfo = BasicInfo::updateOrCreate(
                     ['cnic' => $basic['cnic']],
                     $basic
                 );
                if($basic['cnic_type'] == 'Bform'){
                    Guardian::updateOrCreate(
    ['user_id' => $basicInfo->user_id], // find by user_id
    [
        'guardian_name'       => $request->guardian_name,
        'guardian_cnic'       => $request->guardian_cnic,
        'guardian_cnic_issue' => $request->guardian_cnic_issue,
        'guardian_cnic_expiry'=> $request->guardian_cnic_expiry,
        'guardian_relation'     => $request->guardian_relation,
        // 'appointment'         => $appointmentPath,
    ]
);

                }
 return response()->json([
        'success' => true,
        'data' => [
            'user_id' => $basicInfo->user_id,

        ],
    ]);
                 break;

             case 2:
                 // Validate and process data for step 2
                 $trip = $request->validate([
                     'user_id' => '',
                     'card_type' => '',
                     'district' => '',
                     'tehsil' => '',
                    'system_name' => '',
                     'station_name' => '',
                     'institute_type'=>'',
                     'edu_level'=>'',
                     'org_name'=> '',
                     'address'=> '',
                     'stop_name'=> '',
                     'bop_branch'=> '',
                     'start_year'=> '',
                     'end_year'=> '',
                     'metro_stop'=>'',
                     'grade'=>'',
                 ]);

               $tripInfo =  TripInfo::updateOrCreate(
                     ['user_id' => $trip['user_id']],
                     $trip
                 );
                  return response()->json([
        'success' => true,
        'data' => [
            'user_id' => $tripInfo->user_id,

        ],
    ]);

                 break;

                 case 3:
                    $cnicType = BasicInfo::where('user_id', $request->user_id)
                          ->pluck('cnic_type')
                          ->first();

                      if ($cnicType == 'CNIC') {
                          $attach = $request->validate([
                    'cnic_front' => 'nullable|file|mimes:jpeg,png,jpg|max:2048|required_without:cnic_front1',
                      'cnic_front1' => 'nullable|required_without:cnic_front',
                        'cnic_back' => 'nullable|file|mimes:jpeg,png,jpg|max:2048|required_without:cnic_back1',
                      'cnic_back1' => 'nullable|required_without:cnic_back',
                         ]);

}
                    elseif ($cnicType == 'Bform') {
                            $attach = $request->validate([
                            'bform' => 'nullable|file|mimes:jpeg,png,jpg|max:2048|required_without:bform1',
                            'bform1' => 'nullable|required_without:bform',
                                            ]);

}
              // Validate and process data for step 2
              $attach = $request->validate([
                  'user_id' => '', // Ensure user_id is required and an integer
                  'photo' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
                  'cnic_front' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
                  'cnic_back' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
                  'bform' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
                  'student_id_card' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',

              ]);

              // Define an array of fields that need file handling
              $fields = [
                  'photo',
                  'cnic_front',
                  'cnic_back',
                  'bform',
                  'student_id_card',
              ];

              $uId = $attach['user_id'];

              // Handle file uploads
              foreach ($fields as $field) {
                  if ($request->hasFile($field)) {
                      // Get the uploaded file
                      $file = $request->file($field);

                      // Generate a unique file name with timestamp, user ID, and field name
                      $fileName = time() . '_' . $uId . '_' . $field . '.' . $file->getClientOriginalExtension();

                      // Move the file to the public directory under 'pics'
                      $file->move(public_path('/uploads/'.$field. '/'), $fileName);

                      // Store the file name in the $attach array
                      $attach[$field] = $fileName;
                  } else {
                      // If no file is uploaded, check for a fallback input with a '1' suffix
                      // Use 'null' as a default value if no fallback is provided
                      $attach[$field] = $request->input($field . '1', null);
                  }
              }

              // Return a response

           $tripInfo =   Attachment::updateOrCreate(
                  ['user_id' => $attach['user_id']],
                  $attach
              );
                 return response()->json([
        'success' => true,
        'data' => [
            'user_id' => $tripInfo->user_id,

        ],
    ]);
              break;
              case 4:
    $guardian = $request->validate([
        'user_id'           => 'required|integer',
        'guardian_relation' => 'required|string',
        'guardian_name'     => 'required|string|max:50',
        'guardian_contact'  => 'required|string|max:15',
    ]);

    Guardian::updateOrCreate(
        ['user_id' => $guardian['user_id']],
        $guardian
    );
    break;


             default:
                 return response()->json(['message' => 'Invalid step'], 400);
         }

         // Store or update the data in the database for each step as needed


         return response()->json(['message' => 'Data for step ' . $step . ' saved successfully'], 200);


     }

     public function storeform(Request $request)
     {

         $step = $request->input('step');

         switch ($step) {
             case 1:
                // dd($request->all());
                 // Validate and process data for step 1
                 $basic = $request->validate([
                     'user_id' => '',
                     'category' => 'required',
                     'passenger_name' => 'required|string|max:20',
                     'gender' => 'required',
                     'cnic_type' => 'required',
                     'cnic' => 'required',
                     'cnic_expiry'=>'',
                     'contact'=>'required',
                     'dob'=>'required',

                 ]);

                //  dd($basic);
                 

                 $record = BasicInfo::updateOrCreate(
                     ['user_id' => $basic['user_id']],
                     $basic
                 );

                 

                 
                 break;

             case 2:
                 // Validate and process data for step 2
                 $trip = $request->validate([
                     'user_id' => '',
                     'card_type' => '',
                     'district' => 'nullable|string',
                     'tehsil' => '',
                    'system_name' => '',
                     'station_name' => '',
                     'institute_type'=>'',
                     'edu_level'=>'',
                     'org_name'=> '',
                     'address'=> '',
                     'stop_name'=> '',
                     'bop_branch'=> '',
                     'start_year'=> '',
                     'end_year'=> '',
                 ]);

                 TripInfo::updateOrCreate(
                     ['user_id' => $trip['user_id']],
                     $trip
                 );

                 break;

                 case 3:
                    $cnicType = BasicInfo::where('user_id', $request->user_id)
                          ->pluck('cnic_type')
                          ->first();

                      if ($cnicType == 'CNIC') {
                          $attach = $request->validate([
                    'cnic_front' => 'nullable|file|mimes:jpeg,png,jpg|max:2048|required_without:cnic_front1',
                      'cnic_front1' => 'nullable|required_without:cnic_front',
                        'cnic_back' => 'nullable|file|mimes:jpeg,png,jpg|max:2048|required_without:cnic_back1',
                      'cnic_back1' => 'nullable|required_without:cnic_back',
                         ]);

}
                    elseif ($cnicType == 'Bform') {
                            $attach = $request->validate([
                            'bform' => 'nullable|file|mimes:jpeg,png,jpg|max:2048|required_without:bform1',
                            'bform1' => 'nullable|required_without:bform',
                                            ]);

}
              // Validate and process data for step 2
              $attach = $request->validate([
                  'user_id' => 'required|integer', // Ensure user_id is required and an integer
                  'photo' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
                  'cnic_front' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
                  'cnic_back' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
                  'bform' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
                  'student_id_card' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',

              ]);

              // Define an array of fields that need file handling
              $fields = [
                  'photo',
                  'cnic_front',
                  'cnic_back',
                  'bform',
                  'student_id_card',
              ];

              $uId = $attach['user_id'];

              // Handle file uploads
              foreach ($fields as $field) {
                  if ($request->hasFile($field)) {
                      // Get the uploaded file
                      $file = $request->file($field);

                      // Generate a unique file name with timestamp, user ID, and field name
                      $fileName = time() . '_' . $uId . '_' . $field . '.' . $file->getClientOriginalExtension();

                      // Move the file to the public directory under 'pics'
                      $file->move(public_path('/uploads/'.$field. '/'), $fileName);

                      // Store the file name in the $attach array
                      $attach[$field] = $fileName;
                  } else {
                      // If no file is uploaded, check for a fallback input with a '1' suffix
                      // Use 'null' as a default value if no fallback is provided
                      $attach[$field] = $request->input($field . '1', null);
                  }
              }

              // Return a response

              Attachment::updateOrCreate(
                  ['user_id' => $attach['user_id']],
                  $attach
              );

              break;
              case 4:
    $guardian = $request->validate([
        'user_id'           => 'required|integer',
        'guardian_relation' => 'required|string',
        'guardian_name'     => 'required|string|max:50',
        'guardian_contact'  => 'required|string|max:15',
    ]);

    Guardian::updateOrCreate(
        ['user_id' => $guardian['user_id']],
        $guardian
    );
    break;


             default:
                 return response()->json(['message' => 'Invalid step'], 400);
         }

         // Store or update the data in the database for each step as needed


         return response()->json(['message' => 'Data for step ' . $step . ' saved successfully'], 200);


     }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cardform  $cardform
     * @return \Illuminate\Http\Response
     */
    public function show(Cardform $cardform)
    {
        $user = Auth::user()->id;
        $cardform = DB::select("SELECT * from cardforms where user_id = $user");
        $category = DB::select("SELECT * from category_id");
        try {

        $payment= DB::select("SELECT receipt from payments where user_id='$user'")[0]->receipt;

        }
        catch (Exception $payment) {
          $payment = 0;


        }

        return view('submittedform',compact('cardform','category','payment'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cardform  $cardform
     * @return \Illuminate\Http\Response
     */
    public function edit(Cardform $cardform, $id)
    {
        $cardform = Cardform::find($id);
        $arr1 = str_split($cardform->card_name);

        $station = DB::select("SELECT * from stations");

        return view('editform',compact('cardform', 'station','arr1'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCardformRequest  $request
     * @param  \App\Models\Cardform  $cardform
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cardform  $cardform
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cardform $cardform)
    {
        //
    }


}
