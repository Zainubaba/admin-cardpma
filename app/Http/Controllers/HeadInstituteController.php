<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Organization;
use App\Models\RegInstitute;
use App\Models\Status;
use Illuminate\Support\Facades\Hash;
use DB;

class HeadInstituteController extends Controller
{

    public function updateStatus(Request $request, $id)
{
    $request->validate([
        'id' => '',
        'status' => 'required',
    ]);

    $record = User::find($id);
    $record->status = $request->status;
    $record->save();

     $updated = RegInstitute::where('user_id', $id)->update([
        'status' => $request->status
    ]);


        return redirect()->route('verify.institutelist')->with('success','User Created Successfully!');

}

  public function updateOrg(Request $request)
{

    // dd($request->all());

   $input = $request->validate([
        'id' => '',
        'district_id' => '',
        'tehsil_id' => '',
        'institute_type' => '',
        'edu_level' => '',
        'org_name' => '',
        'hod_id' => '',


    ]);

    $input['org_name'] = $request->emis .' | '.$request->org_name;

                $data = Organization::create($input);


    return view('head_institute.addorganization', compact()); 
    
    // response()->json(['message' => 'Institute added successfully']);

}

// public function updateUser(Request $request)
//     // dd($request->all());

//    $input = $request->validate([
//         'id' => '',
//         'district_id' => '',
//         'tehsil_id' => '',
//         'institute_type' => '',
//         'edu_level' => '',
//         'org_name' => '',
//         'hod_id' => '',


//     ]);

//     $input['org_name'] = $request->emis .' | '.$request->org_name;

//                 $data = Organization::create($input);


//     return view('head_institute.addusers', compact()); 
    
//     // response()->json(['message' => 'Institute added successfully']);

// }



    public function dashboard()
    {
                 $id = Auth::user()->hod_institute;

                $submittedformc = DB::select("Select count(basic_infos.user_id) as total  from basic_infos left join trip_infos on basic_infos.user_id = trip_infos.user_id 
                    left join organizations on trip_infos.org_name = organizations.id
                    where confirmation = '1' and  hod_id = '$id'");
                $submittedform = $submittedformc[0]->total ?? 0;

                $pendingformc = DB::select("Select count(basic_infos.user_id) as total  from basic_infos left join trip_infos on basic_infos.user_id = trip_infos.user_id 
                    left join organizations on trip_infos.org_name = organizations.id left join status on status.user_id = basic_infos.user_id
                    where confirmation = '1' and  hod_id = '$id' and deptist is  null");
                $pendingform = $pendingformc[0]->total ?? 0;

                 $forwardformc = DB::select("Select count(basic_infos.user_id) as total  from basic_infos left join trip_infos on basic_infos.user_id = trip_infos.user_id 
                    left join organizations on trip_infos.org_name = organizations.id left join status on status.user_id = basic_infos.user_id
                    where confirmation = '1' and  hod_id = '$id' and deptist is  not null and instittute is null");
                $forwardform = $forwardformc[0]->total ?? 0;

                $aforwardformc = DB::select("Select count(basic_infos.user_id) as total  from basic_infos left join trip_infos on basic_infos.user_id = trip_infos.user_id 
                    left join organizations on trip_infos.org_name = organizations.id left join status on status.user_id = basic_infos.user_id
                    where confirmation = '1' and  hod_id = '$id' and deptist is  not null and instittute is not null and dept2 is null");
                $aforwardform = $aforwardformc[0]->total ?? 0;

             $verified = DB::table('basic_infos')
            ->where('verified_users', '1')
            ->count();

             $rejected = DB::table('basic_infos')
            ->where('verified_users', '0')
            ->count();

//New variables



              $verifiedbyinstitute = DB::table('basic_infos')
            ->where('verified_users', '1')
            ->where('confirmation','1')
            ->count();

             $rejected = DB::table('basic_infos')
            ->where('verified_users', '0')
             ->where('confirmation','1')
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
    ->where('deptist', 'NULL')
    ->count();


$maleCount = DB::table('basic_infos')
->join('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
      ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
    ->where('confirmation', '1')
    ->where('organizations.hod_id', $id)
    ->where('gender', 'Male')
    
    ->count();

$femaleCount = DB::table('basic_infos')
->join('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
      ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
    ->where('confirmation', '1')
    ->where('organizations.hod_id', $id)
    ->where('gender', 'Female')
     
    ->count();

   $lahoreCount = DB::table('trip_infos')
    ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
      ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
    ->where('confirmation', '1')
    ->where('organizations.hod_id', $id)
    ->where('basic_infos.district', '1')


    ->count();


$multanCount = DB::table('trip_infos')
    ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
      ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
    ->where('confirmation', '1')
    ->where('organizations.hod_id', $id)
    ->where('basic_infos.district', '2')
    ->count();

$rawalpindiCount = DB::table('trip_infos')
    ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
     ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
    ->where('confirmation', '1')
    ->where('organizations.hod_id', $id)
    ->where('basic_infos.district', '3')


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






        return view('head_institute.headinstitutedashboard', compact('submittedform', 'pendingform','forwardform','aforwardform', 'verified', 'rejected','submittedform','verifiedbyinstitute', 'forward','rejected','station','handover','pending','maleCount','femaleCount','lahoreCount',
    'multanCount','rawalpindiCount','peprisCount','hedGovCount','hedPrivateCount','tevtaCount','sedCount','pvtcCount','madrassaCount'));

    }

    public function verifyinstitutelist()
{
     $data = DB::table('users')
    ->select('users.*', 'users.id as uid', 'districts.name as dname') // Corrected select
    ->leftJoin('districts', 'districts.id', '=', 'users.city')
    ->whereNULL('users.status')
    ->where('users.role', '2')
    ->get();

    return view('head_institute.verifyinstitutelist', compact('data'));
}

 public function viewinstitute($id)
{
     $data = DB::table('users')
    ->select('users.role', 'users.status', 'users.id as uid', 'reg_institutes.*', 'districts.name as dname', 'tehsils.tehsil_name as tehsil_name', 'institute_types.name as institute_name', 'edu_levels.name as edu_level_name', 'hods.name as hod_name') // Corrected select
    ->leftJoin('reg_institutes', 'reg_institutes.user_id', '=', 'users.id')
    ->leftJoin('districts', 'districts.id', '=', 'users.city')
    ->leftJoin('tehsils', 'tehsils.id', '=', 'reg_institutes.tehsil')
        ->leftJoin('institute_types', 'institute_types.id', '=', 'reg_institutes.institute_type')
    ->leftJoin('edu_levels', 'edu_levels.id', '=', 'reg_institutes.edu_level')
    ->leftJoin('hods', 'hods.id', '=', 'reg_institutes.hod_id')

    ->whereNULL('users.status')
    ->where('users.role', '2')
    ->where('reg_institutes.user_id', $id)
    ->get();

    return view('head_institute.viewinstitutedetail', compact('data'));
}

//  public function addinstitute()
// {
//      $data = DB::table('reg_institutes')
//     ->select('reg_institutes.*', 'districts.name as dname', 'tehsils.tehsil_name as tehsil_name', 'institute_types.name as institute_name', 'edu_levels.name as edu_level_name', 'hods.name as hod_name') // Corrected select
//     ->leftJoin('districts', 'districts.id', '=', 'reg_institutes.district')
//     ->leftJoin('tehsils', 'tehsils.id', '=', 'reg_institutes.tehsil')
//     ->leftJoin('institute_types', 'institute_types.id', '=', 'reg_institutes.institute_type')
//     ->leftJoin('edu_levels', 'edu_levels.id', '=', 'reg_institutes.edu_level')
//     ->leftJoin('hods', 'hods.id', '=', 'reg_institutes.hod_id')
//     ->where('reg_institutes.status', 'verified')
//     ->whereNotExists(function ($query) {
//     $query->select(DB::raw(1))
//           ->from('organizations')
//           ->whereRaw('organizations.org_name COLLATE utf8mb4_unicode_ci LIKE CONCAT(reg_institutes.emis COLLATE utf8mb4_unicode_ci, " | ", "%")');
// })
//     ->get();

//     return view('head_institute.addinstitute', compact('data'));
// }

public function addinstitute()
{
 $hods = DB::SELECT("SELECT * from hods");

        return view('head_institute.addinstitute', compact('hods'));
    }

    public function storeuserinstitute(Request $request)
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


    public function viewlist()
{
     $id = Auth::user()->hod_institute;
    
    $data = DB::table('basic_infos')
    ->select('basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact', 'basic_infos.user_id as uid','organizations.org_name','tehsils.tehsil_name as teh_name', 'districts.name as dname') // Corrected select
    ->leftJoin('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
    ->leftJoin('tehsils', 'tehsils.id', '=', 'trip_infos.tehsil')
    ->leftJoin('organizations', 'organizations.id', '=', 'trip_infos.org_name')
    ->where('basic_infos.confirmation', 1)   
        ->where('organizations.hod_id', $id)       
        ->distinct()
        ->get();

    return view('head_institute.viewlist', compact('data'));
}

public function forwardlist()
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
        ->leftJoin('status', 'status.user_id', '=', 'basic_infos.user_id')
        ->where('basic_infos.confirmation', 1)
        ->where('organizations.hod_id', $id)
        ->whereNotNull('status.deptist')
        ->whereNull('status.instittute')
        ->distinct()
        ->get();

    return view('head_institute.viewpending', compact('data'));
}



 public function verifylist()
{
     $data = DB::table('basic_infos')
    ->select('basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact', 'basic_infos.user_id as uid','organizations.org_name','tehsils.tehsil_name as teh_name', 'districts.name as dname') // Corrected select
    ->leftJoin('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
    ->leftJoin('tehsils', 'tehsils.id', '=', 'trip_infos.tehsil')
    ->leftJoin('organizations', 'organizations.id', '=', 'trip_infos.org_name')
    ->whereNotNULL('basic_infos.confirmation')
    ->where('basic_infos.verified_users', '1')
    ->get();

    return view('head_institute.verifyapplicants', compact('data'));
}

public function rejectedlist()
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


    return view('head_institute.rejectlist', compact('data'));
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
            ->get();


    return view('head_institute.viewdetail', compact('data'));
}
 public function status(){


        $submittedform = DB::table('basic_infos')
            ->where('confirmation', '1')
            ->count();


             $verified = DB::table('basic_infos')
            ->where('verified_users', '1')
            ->count();

             $rejected = DB::table('basic_infos')
            ->where('verified_users', '0')
            ->count();


            return view('head_institute.statusbar')->with(compact('submittedform', 'rejected', 'verified'));


    }
    public function pending()

{
     $id = Auth::user()->hod_institute;
    $data = DB::table('basic_infos')
    ->select('basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact', 'basic_infos.user_id as uid','organizations.org_name','tehsils.tehsil_name as teh_name', 'districts.name as dname') // Corrected select
    ->leftJoin('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
    ->leftJoin('tehsils', 'tehsils.id', '=', 'trip_infos.tehsil')
    ->leftJoin('organizations', 'organizations.id', '=', 'trip_infos.org_name')
    ->leftJoin('status','basic_infos.user_id','=','status.user_id')
    ->whereNotNULL('basic_infos.confirmation')
    ->where('hod_id',$id)
    ->whereNULL('deptist')

    ->get();

    return view('head_institute.viewpending', compact('data'));
}
    public function pending2()

{
     $id = Auth::user()->hod_institute;
    $data = DB::table('basic_infos')
    ->select('basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact', 'basic_infos.user_id as uid','organizations.org_name','tehsils.tehsil_name as teh_name', 'districts.name as dname') // Corrected select
    ->leftJoin('trip_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->leftJoin('districts', 'districts.id', '=', 'trip_infos.district')
    ->leftJoin('tehsils', 'tehsils.id', '=', 'trip_infos.tehsil')
    ->leftJoin('organizations', 'organizations.id', '=', 'trip_infos.org_name')
    ->leftJoin('status','basic_infos.user_id','=','status.user_id')
    ->whereNotNULL('basic_infos.confirmation')
    ->where('hod_id',$id)
    ->whereNULL('dept2')
    ->whereNotNULL('instittute')

    ->get();

    return view('head_institute.viewpending2', compact('data'));
}
public function forward(Request $request)
{
    $ids = $request->input('ids');

    // Example: Forward logic here (update DB, send notifications, etc.)
    foreach ($ids as $id) {
        Status::updateOrCreate(
    ['user_id' => $id], // find by user_id
    [
        
        'deptist'=> '1',
    ]
);

      

    }

    return response()->json(['message' => 'Rows forwarded successfully', 'ids' => $ids]);
}

public function forward2(Request $request)
{
    $ids = $request->input('ids');

    // Example: Forward logic here (update DB, send notifications, etc.)
    foreach ($ids as $id) {
        Status::updateOrCreate(
    ['user_id' => $id], // find by user_id
    [
        
        'dept2'=> '1',
    ]
);

      

    }

    return response()->json(['message' => 'Rows forwarded successfully', 'ids' => $ids]);
}
}
