<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Support\Arr;
use DB;
class UserController extends Controller
{
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'user_id'=>'',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone'=>'required',
            'password' => 'required|same:confirm-password',
            'city' => 'required',
            'cnic' => 'required',
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);

        dd($user);
        return redirect()->route('admin')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $id= Auth::user()->id;
        $user = DB::SELECT("SELECT users.*, districts.name as dis_name, users.id as uid from users left join districts on districts.id = users.city where users.id = '$id'");

        return view('user.index',compact('user'));

    }

    public function dashboard()
    {
        $id= Auth::user()->id;


        return view('user.userdashboard');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = DB::SELECT("SELECT users.*, districts.name as dis_name, users.id as uid from users left join districts on districts.id = users.city where users.id = '$id'");


        return view('user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => '',
            'email' => '',
            'phone'=>'',
            'city'=>'',
            'CNIC'=>'',
            'password' => 'required|same:confirm-password',

        ]);
         $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);


        return view('user.index',compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       //
    }

    public function showProgress($id)
{
 $confirmation = null;

    try {
        // Retrieve the user data once
        $userData = DB::table('basic_infos')
            ->where('user_id', $id)
            ->first();
            $deptist = DB::table('status')
    ->where('user_id', $id)
    ->value('deptist');


        $confirmation = $userData ? $userData->confirmation : null;  
          
        $form = $userData && $userData->confirmation !== null ? $userData->confirmation : '';
        $payment = $userData && $userData->confirmation === '1' ? $userData->confirmation : '';
        $verification = $userData && $userData->verified_users === '1' ? $userData->verified_users : '';
        $card = $verification; // since it's the same as form

        $deptist = DB::table('status')
            ->where('user_id', $id)
            ->value('deptist');

        
        $deptbg = ($deptist == 1) ? 1 : 0;

        $bop = DB::table('status')
    ->where('user_id', $id)
    ->value('BOP');


$bopbg = ($bop == 1) ? 1 : 0;


$station = DB::table('status')
    ->where('user_id', $id)
    ->value('station');


$stationbg = ($station == 1) ? 1 : 0;


$dept2 = DB::table('status')
    ->where('user_id', $id)
    ->value('dept2');

    
$dept2bg = ($dept2 == 1) ? 1 : 0;

$tcash = DB::table('status')
    ->where('user_id', $id)
    ->value('t-cash');

$tcashbg = ($tcash == 1) ? 1 : 0;



$handover = DB::table('status')
    ->where('user_id', $id)
    ->value('handover');

$handoverbg = ($handover == 1) ? 1 : 0;

// $instittute = DB::table('status')
//     ->where('user_id', $id)
//     ->value('instittute');

// $instbg = ($instittute == 1 && $verification == '1') ? 1 : 0;

$instittute = DB::table('status')->where('user_id', $id)->value('instittute');
$verified_users = DB::table('basic_infos')->where('user_id', $id)->value('verified_users');


$step5bg = is_null($verified_users) ? null : ($verified_users == 1 ? 1 : 0);



$inst_tick = ($instittute == 1);


    } catch (\Exception $ex) {
        $form = $payment = $verification = $card = '';
         $confirmation = null;
         $deptbg = 0;
    }

    

    // Background flags
    $formbg = !empty($form) ? 1 : 0;
    $paymentbg = !empty($payment) ? 1 : 0;
    $verificationbg = !empty($verification) ? 1 : 0;
    $cardbg = !empty($card) ? 1 : 0;

    return view('statstat')->with(compact(
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



    public function status(){

//  $id = Auth::id(); // shorthand for Auth::user()->id

$id = Auth::id() ?? Session::get('user_id');
 $confirmation = null;

    try {
        // Retrieve the user data once
        $userData = DB::table('basic_infos')
            ->where('user_id', $id)
            ->first();
            $deptist = DB::table('status')
    ->where('user_id', $id)
    ->value('deptist');


        $confirmation = $userData ? $userData->confirmation : null;  
          
        $form = $userData && $userData->confirmation !== null ? $userData->confirmation : '';
        $payment = $userData && $userData->confirmation === '1' ? $userData->confirmation : '';
        $verification = $userData && $userData->verified_users === '1' ? $userData->verified_users : '';
        $card = $verification; // since it's the same as form

        $deptist = DB::table('status')
            ->where('user_id', $id)
            ->value('deptist');

        
        $deptbg = ($deptist == 1) ? 1 : 0;

        $bop = DB::table('status')
    ->where('user_id', $id)
    ->value('BOP');


$bopbg = ($bop == 1) ? 1 : 0;


$station = DB::table('status')
    ->where('user_id', $id)
    ->value('station');


$stationbg = ($station == 1) ? 1 : 0;


$dept2 = DB::table('status')
    ->where('user_id', $id)
    ->value('dept2');

    
$dept2bg = ($dept2 == 1) ? 1 : 0;

$tcash = DB::table('status')
    ->where('user_id', $id)
    ->value('t-cash');

$tcashbg = ($tcash == 1) ? 1 : 0;



$handover = DB::table('status')
    ->where('user_id', $id)
    ->value('handover');

$handoverbg = ($handover == 1) ? 1 : 0;

// $instittute = DB::table('status')
//     ->where('user_id', $id)
//     ->value('instittute');

// $instbg = ($instittute == 1 && $verification == '1') ? 1 : 0;

$instittute = DB::table('status')->where('user_id', $id)->value('instittute');
$verified_users = DB::table('basic_infos')->where('user_id', $id)->value('verified_users');


$step5bg = is_null($verified_users) ? null : ($verified_users == 1 ? 1 : 0);



$inst_tick = ($instittute == 1);


    } catch (\Exception $ex) {
        $form = $payment = $verification = $card = '';
         $confirmation = null;
         $deptbg = 0;
    }

    

    // Background flags
    $formbg = !empty($form) ? 1 : 0;
    $paymentbg = !empty($payment) ? 1 : 0;
    $verificationbg = !empty($verification) ? 1 : 0;
    $cardbg = !empty($card) ? 1 : 0;

    return view('stat')->with(compact(
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

}
