<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Redirect;

class TranslationController extends Controller
{
    public function index()
    
    {
        
        return view('welcome');
    }


//     public function translation(Request $request)
//      { 
    
//     // dd($request->all(), session()->all());

//         // dd($request->lang);
//         if($request->lang == '1'){
//             $lang = 'ur';
//         }elseif($request->lang == '0'){
//             $lang = 'en';
//         }

//         App::setLocale($lang);

//         session()->put('locale', $lang);
//         session()->put('lo', $request->lang);


//         return redirect()->back();
//  }

public function translation(Request $request)
{
    if ($request->lang == '1') {
        $lang = 'ur';  // 1 = Urdu (checked)
    } else {
        $lang = 'en';  // 0 or anything = English
    }

    App::setLocale($lang);
    session()->put('locale', $lang);
    session()->put('lo', $request->lang);

    return redirect()->back();
}


}
