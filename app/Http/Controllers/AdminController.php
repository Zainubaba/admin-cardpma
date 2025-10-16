<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Tehsil;
use App\Models\Robocall;
use DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use Carbon\Carbon;



class AdminController extends Controller
{


//dependent dropdown

public function getMetroStops(Request $request)
{
    $districtId = $request->input('district_id');

    if (!$districtId) {
        return response()->json(['stops' => []]);
    }

    $stops = \DB::table('metro_stops')
                ->where('district_id', $districtId)
                ->pluck('stop_name');

    return response()->json(['stops' => $stops]);
}

public function getGradesByEduLevel(Request $request)
{
    $grades = DB::table('grades')
                ->where('edu_level_id', $request->edu_level_id)
                ->select('id', 'name')
                ->get();

    return response()->json(['grades' => $grades]);
}



public function regbdivision(Request $request)

    {


        $data['service_providers'] = DB::table('service_providers')->where("city_id",$request->district_id)

                    ->get(["name","id","city_id"]);


        return response()->json($data);

    }

    public function regtehsil(Request $request)

    {
        // dd($request->city_id);


        $data['tehsils'] = DB::table('tehsils')->where("district_id",$request->district_id)

                    ->get(["district_id","id","tehsil_name"]);


        return response()->json($data);

    }

    public function reginstitute(Request $request)

    {
        // dd($request->city_id);


        $data['institute_types'] = DB::table('institute_types')

                    ->get(["id","name"]);


        return response()->json($data);

    }

     public function regedulevel(Request $request)

    {
        // dd($request->city_id);


        $data['edu_levels'] = DB::table('edu_levels')

                    ->get(["id","name"]);


        return response()->json($data);

    }

       public function regorganization(Request $request)

    {
        // dd($request->city_id);


        $data['organizations'] = DB::table('organizations')
         ->where("tehsil_id",$request->tehsil_id)
        // ->where("district_id", $request->district_id)
        ->where("institute_type",$request->institute_type)
        ->where("edu_level",$request->edu_level)
    
        ->get(["id","org_name"]);


        return response()->json($data);

    }

    public function registerbdistrict(Request $request)

    {

        $data['stations'] = DB::table('stations')->where("system_id",$request->system_id)

                    ->get(["name","id","system_id"]);

        return response()->json($data);

    }


    public function regbstop(Request $request)

    {

        $data['stops'] = DB::table('stops')->where("station_id",$request->station_id)

                    ->get(["name","id"]);

        return response()->json($data);

    }

    public function getInstitutesByDistrict(Request $request)
{
    $districtId = $request->district_id;

    if (!$districtId) {
        return response()->json(['institutes' => []]);
    }

    // Fetch all organizations in the selected district
    $institutes = DB::table('organizations')
        ->where('district_id', $districtId)
        ->select('id', 'org_name')
        ->get();

    return response()->json(['institutes' => $institutes]);
}


    public function categorybysystem(Request $request)

    {

        $data['categories'] = DB::table('categories')->where("system_name",$request->system_name)

                    ->get(["name","id","system_name"]);

        return response()->json($data);

    }

    public function regmboard(Request $request)
    {
        $data['subcategories'] = Subcategory::where("category_id",$request->category_id)
                    ->get(["name","id","category_id"]);
        return response()->json($data);

      }


    public function show()
    {
        $id= Auth::user()->id;


        return view('admin.admindashboard');

    }

    public function create()
    {


        return view('admin.createaccount');

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone_number'=>'required',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'city' => 'required',
            'CNIC' => 'required',
            'role' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);


    }

      public function robocall(Request $request, $phoneno, $cnic){


        $otp = DB::SELECT("SELECT otp from users where phone_number = '$phoneno' and cnic = '$cnic'")[0]->otp;


        // dd($otp);

        $endpoint = "http://10.50.29.121//ERP/CampaignManager.TpinCallsAlert?Action=GETINPUT&mobileNo=$phoneno&AuthPin=$otp";
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', $endpoint,
        );

        $data = json_decode($response->getBody(), true);

        $robo = $request->validate([

            'phoneno' => '',
            'robocall' => '',
            'cnic' => '',

        ]);

        $robo['robocall'] = '1';
        $robo['phoneno'] = $phoneno;
        $robo['cnic'] = $cnic;


        $data = Robocall::create($robo);

        return redirect()->back();

    }


    public function callsrecord(Request $request, $phoneno, $cnic) {

    $todayCount = DB::table('robocalls')
        ->whereDate('created_at', Carbon::today())
        ->where('phoneno', $phoneno)
        ->where('cnic', $cnic)
        ->count();

    return response()->json(['count' => $todayCount]);
}

    public function formstatus()
    {

        $cardforms = DB::select("SELECT * from cardforms left join payments on cardforms.id= payments.cardform_id where cardforms.id not in (SELECT cardform_id from payments)");
        $count = COUNT($cardforms );
        $category = DB::select("SELECT * from category_id");

        return view('admin.formstatus',compact('cardforms','category','count'));

    }
    public function paystatus()
    {

        $cardforms = DB::select("SELECT * from cardforms left join payments on cardforms.id= payments.cardform_id where  cardforms.verify_form IS NULL");

        $category = DB::select("SELECT * from category_id");

        return view('admin.paystatus',compact('cardforms','category'));

    }

    public function verifystatus()
    {

        $cardforms = DB::select("SELECT * from cardforms left join payments on cardforms.id= payments.cardform_id where  cardforms.dispatch IS NULL");

        $category = DB::select("SELECT * from category_id");

        return view('admin.paystatus',compact('cardforms','category'));

    }
    public function dispatchstatus()
    {

        $cardforms = DB::select("SELECT * from cardforms where dispatch = 'Yes'");

        $category = DB::select("SELECT * from category_id");

        return view('admin.dispatchstatus',compact('cardforms','category'));

    }



    public function status()
    {

        $msg = DB::select("SELECT * from messages where id = '1'");

        $cardforms = DB::select("SELECT * from cardforms left join payments on cardforms.id= payments.cardform_id where cardforms.id not in (SELECT cardform_id from payments)");
        $count = COUNT($cardforms );

        $pay = DB::select("SELECT * from cardforms left join payments on cardforms.id= payments.cardform_id where  cardforms.verify_form IS NULL");
        $count_pay = COUNT($pay );

        $verify = DB::select("SELECT * from cardforms left join payments on cardforms.id= payments.cardform_id where  cardforms.dispatch IS NULL");
        $count_verify = COUNT($verify );

        $dispatch = DB::select("SELECT * from cardforms where dispatch = 'Yes'");
        $count_card = COUNT($dispatch);

        $id = Auth::user()->id;

        // try {

            $form = DB::select("SELECT id from cardforms where user_id = '$id'");

            $payment = DB::select("SELECT id from payments where user_id = '$id'");


            $card =DB::select("SELECT cardnumber from cardforms where user_id = '$id' and cardnumber is not null");

            if (empty($form)){

                $formbg = 0;

            }

            else {

                $formbg = 1;

            }

            if (empty($payment)){

                $paymentbg = 0;

            }

            else {

                $paymentbg = 1;

            }

            if (empty($verification)){

                $verificationbg = 0;

            }

            else {

                $verificationbg = 1;

            }

            if (empty($card)){

                $cardbg = 0;

            }

            else {

                $cardbg = 1;

            }


            return view('admin.adminstatus')->with(compact('formbg','paymentbg','verificationbg','cardbg','count','count_pay','count_verify','count_card','msg'));

        // }

        //  catch (\Exception $exception) {

        //     return redirect()->back();
        // }


    }

    public function showCnicForm()
{
    return view('checkcnic'); // make sure this Blade file exists
}

     public function check(Request $request)
{
    $request->validate([
        'cnic' => 'required|string',
    ]);

    $cnic = trim($request->input('cnic'));
    \Log::info('Submitted CNIC: ' . $cnic . ' (Length: ' . strlen($cnic) . ')');

    $user = DB::table('users')->where('cnic', $cnic)->first();
     
    if ($user) {
        \Log::info('User Found: ' . json_encode($user));
        try {
            // Session::put('user_id', $user->id);
            return redirect()->route('progress.status', ['id' => $user->id]);

            \Log::info('Session user_id set: ' . $user->id);
            return redirect()->route('progress.status', ['id' => $user->id]);
        } catch (\Exception $e) {
            \Log::error('Redirect failed: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while processing your request.');
        }
    } else {
        \Log::info('No user found for CNIC: ' . $cnic);
        return back()->with('error', 'CNIC not found.');
    }
    
}

public function checkCnicAjax(Request $request)
{
    $request->validate([
        'cnic' => 'required'
    ]);

    $cnic = $request->input('cnic');
    $user = DB::table('basic_infos')->where('cnic', $cnic)->first();

    if (!$user) {
        return back()->with('error', 'CNIC not found');
    }

    // ✅ Just return the full view — this will replace the page content
    return view('statstat', compact('user'));
}

public function getAllTehsils()
{
    $tehsils = \App\Models\Tehsil::select('id', 'tehsil_name as name')
        ->orderBy('tehsil_name')
        ->get();

    return response()->json(['tehsils' => $tehsils]);
}



}


