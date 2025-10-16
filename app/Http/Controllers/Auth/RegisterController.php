<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;
    protected function authenticated($request, $user)
   {
        //  dd($user->all());

       if ($user->verify == '1') {

        if(Auth::user()->role == '1'){
                    $this->redirectTo = '/pmaform';
                    return $this->redirectTo;

                }elseif(Auth::user()->role == '2'){
                    $this->redirectTo = '/Institute-dashboard';
                    return $this->redirectTo;

                }
                elseif(Auth::user()->role == '3'){
                    $this->redirectTo = '/headinstitutedashboard';
                    return $this->redirectTo;

                }

                elseif(Auth::user()->role == '4'){
                    $this->redirectTo = '/pmadashboard';
                    return $this->redirectTo;

                }


       } else {

           return redirect('/verify');
       }
   }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        // dd($data);

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'phone_number' => 'required|string|max:11',
            'cnic' => ['required','unique:users'],
            'city' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {

        $rand = rand(0, 99999);
        $verify = '0';
        // dd($data);


            $securityKey    = config('services.messagepitb.securityKey');
            $dataNumber     = $data['phone_number'];
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


        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phone_number' => $data['phone_number'],
            'otp' => $rand,
            'verify' => $verify,
            'cnic' => $data['cnic'],
            'role' => $data['role'],
            'city' => $data['city'],
        ]);
    }

}
