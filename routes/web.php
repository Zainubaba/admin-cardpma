<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CardformController;
use App\Http\Controllers\AfcController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DepoController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PmaController;
use App\Http\Controllers\AddOrgController;
use App\Http\Controllers\InstituteController;
use App\Http\Controllers\CaptchaController;
use App\Http\Controllers\TranslationController;
use Illuminate\Http\Request;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/captcha', [CaptchaController::class, 'generateCaptcha'])->name('captcha.generate');
Route::post('/captcha/validate', [CaptchaController::class, 'validateCaptcha'])->name('captcha.validate');
Route::POST ('/get-metro-stops-by-district', [App\Http\Controllers\AdminController::class, 'getMetroStops']);

Route::get('/get-basic-info-by-cnic/{cnic}', [App\Http\Controllers\CardformController::class,'getinfobycnic']);

//Translation routes
Route::get('/', [TranslationController::class,'index']);
Route::get('/translation', [TranslationController::class,'translation'])->name('change.translate');


Route::get('/maindashboard', [App\Http\Controllers\CardformController::class,'dashboard']);
Route::get('/districtwisedata', [App\Http\Controllers\CardformController::class,'districtwisedata']);
Route::get('/districtwiseverifieddata', [App\Http\Controllers\CardformController::class,'districtwiseverifieddata']);
Route::get('/districtwiseforwardeddata', [App\Http\Controllers\CardformController::class,'districtwiseforwardeddata']);

Route::get('/totalsubmitted/{id}', [App\Http\Controllers\CardformController::class,'totalsubmitteddata']);
Route::get('/totalverified/{id}', [App\Http\Controllers\CardformController::class,'totalverifieddata']);
Route::get('/totalforward/{id}', [App\Http\Controllers\CardformController::class,'totalforwardeddata']);

Route::get('/viewstudetail/{id}', [App\Http\Controllers\CardformController::class,'viewstudetail']);


Route::get('/get-department-breakdown-inline/{district_id}', function ($district_id) {
    $departments =DB::table('trip_infos')
    ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
    ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
    ->join('hods', 'organizations.hod_id', '=', 'hods.id')
    ->where('confirmation', '1')
    ->where('trip_infos.district', $district_id)
    ->whereIn('organizations.hod_id', [2, 4,5, 6])  
    ->select('hods.name','hods.id', DB::raw('COUNT(*) as total'))
    ->groupBy('hods.name','hods.id')
    ->get();


    $html = '';
    // $html .= '<h5 class="mb-3">Department-wise Submitted Applications</h5>';
    $html .= '<div class="d-flex flex-nowrap">';

    foreach ($departments as $dept) {
       $html .= '<button class="btn btn-outline-success rounded-pill px-3 py-2 mr-1 mb-1 department-tile" style="min-width: 200px;"
                data-department="' . $dept->id . '" 
                data-district="' . $district_id . '">'
           . $dept->name . ': <strong>' . $dept->total . '</strong>'
           . '</button>';
    }

    $html .= '</div></div></div>';

    return Response::make($html);

});



// Route::get('/get-institute-breakdown/{district_id}/{department_id}', function ($district_id, $department_id) {
//     $institutes = DB::table('trip_infos')
//     ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
//     ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
//     ->join('hods', 'organizations.hod_id', '=', 'hods.id')
//     ->where('confirmation', '1')
//     ->where('trip_infos.district', $district_id)
//     ->where('organizations.hod_id',  $department_id)  
//     ->select('organizations.org_name as name', DB::raw('COUNT(*) as total'))
//     ->groupBy('organizations.org_name')
//     ->get();


//     $html = '<div class="container-fluid" style="min-width: 1050px;"><div class="w-100">';
//     // $html .= '<h5 class="mb-3">Institute-wise Submitted Applications</h5>';

//     $html .= '<div class="table-responsive"><table class="table table-bordered table-striped w-100" style="min-width: 900px;">';
//     $html .= '<thead class="thead-dark"><tr>
//                 <th>#</th>
//                 <th>Institute Name</th>
//                 <th>Submitted Applications</th>
//                 <th>District</th>
//                 <th>Tehsil</th>
//               </tr></thead><tbody>';

//     foreach ($institutes as $index => $ins) {
//         $html .= '<tr>
//                     <td>' . ($index + 1) . '</td>
//                     <td>' . $ins->name . '</td>
//                     <td>' . $ins->total . '</td>
//                   </tr>';
//     }

//     $html .= '</tbody></table></div>'; // close table + div
//     $html .= '</div></div>'; // close card

//     return Response::make($html);
// });







Route::get('/get-institute-breakdown/{district_id}/{department_id}', function ($district_id, $department_id) {
    $institutes = DB::table('trip_infos')
        ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->join('hods', 'organizations.hod_id', '=', 'hods.id')
        ->join('districts', 'trip_infos.district', '=', 'districts.id')  
        ->join('tehsils', 'trip_infos.tehsil', '=', 'tehsils.id')        
        ->where('confirmation', 1)
        ->where('trip_infos.district', $district_id)
        ->where('organizations.hod_id', $department_id)
        ->select(
            'organizations.org_name as institute_name',
            DB::raw('COUNT(*) as submitted_applications'),
            'districts.name as district_id',
    'tehsils.tehsil_name as tehsil_id',
    'trip_infos.org_name as org_id',
     'districts.id as districtID',  
    'tehsils.id as tehsilID'
   
        )
        ->groupBy('organizations.org_name', 'districts.name', 'tehsils.tehsil_name', 'trip_infos.org_name','districts.id','tehsilID')
        ->orderByRaw('COUNT(*) DESC')
        ->get();


    return response()->json($institutes);
});


Route::get('/get-users-by-institute', function (\Illuminate\Http\Request $request) {

    $orgId = $request->input('org_id');
    $districtId = $request->input('district_id');
    $tehsilId = $request->input('tehsil_id');

    $users = DB::table('trip_infos')
        ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->where('confirmation', 1)
        ->where('trip_infos.district', $districtId)
        ->where('trip_infos.tehsil', $tehsilId)
        ->where('trip_infos.org_name', $orgId)
        ->select('basic_infos.user_id','basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact')
        ->get();

    return response()->json($users);
});

//pending at dept

Route::get('/get-pending-department-breakdown/{district_id}', function ($district_id) {
    \Log::info('Fetching pending department breakdown for district_id: ' . $district_id);
    $departments = DB::table('trip_infos')
        ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->join('status', 'basic_infos.user_id', '=', 'status.user_id')
        ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->join('hods', 'organizations.hod_id', '=', 'hods.id')
        ->join('districts', 'trip_infos.district', '=', 'districts.id')
        ->where('basic_infos.confirmation', '1')
        ->whereNull('status.deptist')
        ->where('districts.id', $district_id)
        ->whereIn('organizations.hod_id', [2, 5]) // HED (2) and SED (5)
        ->select(
            'hods.id as department_id',
            'hods.name as department_name',
            DB::raw('COUNT(*) as submitted_applications'),
            'districts.id as districtID',
            'districts.name as district_id'
        )
        ->groupBy('hods.id', 'hods.name', 'districts.id', 'districts.name')
        ->orderByRaw('COUNT(*) DESC')
        ->get();

    \Log::info('Pending department breakdown result: ', [
        'district_id' => $district_id,
        'count' => $departments->count(),
        'data' => $departments->toArray()
    ]);

    if ($departments->isEmpty()) {
        \Log::warning('No pending applications found for district_id: ' . $district_id);
        return response()->make('<div class="alert alert-warning mt-3">No pending applications found for HED or SED in this district.</div>');
    }

    $html = '<div class="d-flex flex-wrap mt-3">';
    foreach ($departments as $dept) {
        $html .= '<button class="btn btn-outline-success rounded-pill px-3 py-2 mr-2 mb-2 pending-department-subtile" style="min-width: 200px;"
                    data-department="' . $dept->department_id . '" 
                    data-district="' . $district_id . '">'
            . htmlspecialchars($dept->department_name) . ': <strong>' . $dept->submitted_applications . '</strong>'
            . '</button>';
    }
    $html .= '</div>';

    \Log::info('Generated HTML for district_id: ' . $district_id, ['html' => $html]);
    return response()->make($html);
});

// Route for Pending Institute Breakdown
Route::get('/get-pending-institute-breakdown/{district_id}/{department_id}', function ($district_id, $department_id) {
    \Log::info('Fetching pending institute breakdown for district_id: ' . $district_id . ', department_id: ' . $department_id);
    $institutes = DB::table('trip_infos')
        ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->leftJoin('status', 'basic_infos.user_id', '=', 'status.user_id')
        ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->join('hods', 'organizations.hod_id', '=', 'hods.id')
        ->join('districts', 'trip_infos.district', '=', 'districts.id')
        ->join('tehsils', 'trip_infos.tehsil', '=', 'tehsils.id')
        ->where('basic_infos.confirmation', 1)
        ->whereNull('status.deptist')
        ->where('trip_infos.district', $district_id)
        ->where('organizations.hod_id', $department_id)
        ->select(
            'organizations.org_name as institute_name',
            DB::raw('COUNT(*) as submitted_applications'),
            'districts.name as district_id',
            'tehsils.tehsil_name as tehsil_id',
            'trip_infos.org_name as org_id',
            'districts.id as districtID',
            'tehsils.id as tehsilID'
        )
        ->groupBy('organizations.org_name', 'districts.name', 'tehsils.tehsil_name', 'trip_infos.org_name', 'districts.id', 'tehsils.id')
        ->orderByRaw('COUNT(*) DESC')
        ->get();
    \Log::info('Pending institute breakdown result: ', ['count' => $institutes->count(), 'data' => $institutes]);
    return response()->json($institutes);
});

Route::get('/get-pending-institute-breakdown/{department_id}', function ($department_id) {
    Log::info('Fetching pending institute breakdown for department_id: ' . $department_id);
    $institutes = DB::table('trip_infos')
        ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->leftJoin('status', 'basic_infos.user_id', '=', 'status.user_id')
        ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->join('hods', 'organizations.hod_id', '=', 'hods.id')
        ->join('districts', 'trip_infos.district', '=', 'districts.id')
        ->join('tehsils', 'trip_infos.tehsil', '=', 'tehsils.id')
        ->where('basic_infos.confirmation', 1)
        ->whereNull('status.deptist')
        ->where('organizations.hod_id', $department_id)
        ->select(
            'organizations.org_name as institute_name',
            DB::raw('COUNT(*) as submitted_applications'),
            'districts.name as district_id',
            'tehsils.tehsil_name as tehsil_id',
            'trip_infos.org_name as org_id',
            'districts.id as districtID',
            'tehsils.id as tehsilID'
        )
        ->groupBy('organizations.org_name', 'districts.name', 'tehsils.tehsil_name', 'trip_infos.org_name', 'districts.id', 'tehsils.id')
        ->orderByRaw('COUNT(*) DESC')
        ->get();
    Log::info('Pending institute breakdown result: ', ['count' => $institutes->count(), 'data' => $institutes]);
    return response()->json($institutes);
});

Route::get('/get-pending-users-by-institute', function (Request $request) {
    $orgId = $request->input('org_id');
    $districtId = $request->input('district_id');
    $tehsilId = $request->input('tehsil_id');
    $users = DB::table('trip_infos')
        ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->join('status', 'basic_infos.user_id', '=', 'status.user_id')
        ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->where('basic_infos.confirmation', 1)
        ->whereNull('status.deptist')
        ->where('trip_infos.district', $districtId)
        ->where('trip_infos.tehsil', $tehsilId)
        ->where('trip_infos.org_name', $orgId)
        ->select('basic_infos.user_id', 'basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact')
        ->get();
    return response()->json($users);
});

Route::get('/get-institute-department-breakdown/{district_id}', function ($district_id) {
    \Log::info('Fetching institute department breakdown for district_id: ' . $district_id);
    $departments = DB::table('trip_infos')
        ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->join('status', 'basic_infos.user_id', '=', 'status.user_id')
        ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->join('hods', 'organizations.hod_id', '=', 'hods.id')
        ->join('districts', 'trip_infos.district', '=', 'districts.id')
        ->where('basic_infos.confirmation', '1')
        ->whereNull('status.instittute')
        ->where('districts.id', $district_id)
        ->whereIn('organizations.hod_id', [2, 5])
        ->select(
            'hods.id as department_id',
            'hods.name as department_name',
            DB::raw('COUNT(*) as submitted_applications'),
            'districts.id as districtID',
            'districts.name as district_id'
        )
        ->groupBy('hods.id', 'hods.name', 'districts.id', 'districts.name')
        ->orderByRaw('COUNT(*) DESC')
        ->get();

    \Log::info('Institute department breakdown result: ', [
        'district_id' => $district_id,
        'count' => $departments->count(),
        'data' => $departments->toArray()
    ]);

    if ($departments->isEmpty()) {
        \Log::warning('No pending institute applications found for district_id: ' . $district_id);
        return response()->make('<div class="alert alert-warning mt-3">No pending applications found for HED or SED in this district.</div>');
    }

    $html = '<div class="d-flex flex-wrap mt-3">';
    foreach ($departments as $dept) {
        $html .= '<button class="btn btn-outline-success rounded-pill px-3 py-2 mr-2 mb-2 inst-department-subtile" style="min-width: 200px;"
                    data-department="' . $dept->department_id . '" 
                    data-district="' . $district_id . '">'
            . htmlspecialchars($dept->department_name) . ': <strong>' . $dept->submitted_applications . '</strong>'
            . '</button>';
    }
    $html .= '</div>';

    \Log::info('Generated HTML for institute department breakdown, district_id: ' . $district_id, ['html' => $html]);
    return response()->make($html);
});

Route::get('/get-institute-grid/{district_id}/{department_id}', function ($district_id, $department_id) {
    \Log::info('Fetching institute grid for district_id: ' . $district_id . ', department_id: ' . $department_id);
    $institutes = DB::table('trip_infos')
        ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->leftJoin('status', 'basic_infos.user_id', '=', 'status.user_id')
        ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->join('hods', 'organizations.hod_id', '=', 'hods.id')
        ->join('districts', 'trip_infos.district', '=', 'districts.id')
        ->join('tehsils', 'trip_infos.tehsil', '=', 'tehsils.id')
        ->where('basic_infos.confirmation', 1)
        ->whereNull('status.instittute')
        ->where('trip_infos.district', $district_id)
        ->where('organizations.hod_id', $department_id)
        ->select(
            'organizations.org_name as institute_name',
            DB::raw('COUNT(*) as submitted_applications'),
            'districts.name as district_id',
            'tehsils.tehsil_name as tehsil_id',
            'trip_infos.org_name as org_id',
            'districts.id as districtID',
            'tehsils.id as tehsilID'
        )
        ->groupBy('organizations.org_name', 'districts.name', 'tehsils.tehsil_name', 'trip_infos.org_name', 'districts.id', 'tehsils.id')
        ->orderByRaw('COUNT(*) DESC')
        ->get();

    \Log::info('Institute grid result: ', [
        'district_id' => $district_id,
        'department_id' => $department_id,
        'count' => $institutes->count(),
        'data' => $institutes->toArray()
    ]);

    return response()->json($institutes);
});

Route::get('/get-institute-users-by-institute', function (Request $request) {
    $orgId = $request->input('org_id');
    $districtId = $request->input('district_id');
    $tehsilId = $request->input('tehsil_id');
    \Log::info('Fetching users for institute, org_id: ' . $orgId . ', district_id: ' . $districtId . ', tehsil_id: ' . $tehsilId);
    $users = DB::table('trip_infos')
        ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->join('status', 'basic_infos.user_id', '=', 'status.user_id')
        ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->where('basic_infos.confirmation', 1)
        ->whereNull('status.instittute')
        ->where('trip_infos.district', $districtId)
        ->where('trip_infos.tehsil', $tehsilId)
        ->where('trip_infos.org_name', $orgId)
        ->select('basic_infos.user_id', 'basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact')
        ->get();
    \Log::info('Users by institute result: ', ['count' => $users->count(), 'data' => $users->toArray()]);
    return response()->json($users);
});

// Verified users

Route::get('/get-verified-department-breakdown/{district_id}', function ($district_id) {
    Log::info('Fetching verified department breakdown for district_id: ' . $district_id);
    $departments = DB::table('trip_infos')
        ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->join('status', 'basic_infos.user_id', '=', 'status.user_id')
        ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->join('hods', 'organizations.hod_id', '=', 'hods.id')
        ->join('districts', 'trip_infos.district', '=', 'districts.id')
        ->where('basic_infos.confirmation', '1')
        ->where('status.deptist', '1')
        ->where('districts.id', $district_id)
        ->whereIn('organizations.hod_id', [2, 5])
        ->select(
            'hods.id as department_id',
            'hods.name as department_name',
            DB::raw('COUNT(*) as verified_applications'),
            'districts.id as districtID',
            'districts.name as district_id'
        )
        ->groupBy('hods.id', 'hods.name', 'districts.id', 'districts.name')
        ->orderByRaw('COUNT(*) DESC')
        ->get();

    Log::info('Verified department breakdown result: ', [
        'district_id' => $district_id,
        'count' => $departments->count(),
        'data' => $departments->toArray()
    ]);

    if ($departments->isEmpty()) {
        Log::warning('No verified applications found for district_id: ' . $district_id);
        return response()->make('<div class="alert alert-warning mt-3">No verified applications found for HED or SED in this district.</div>');
    }

    $html = '<div class="d-flex flex-wrap mt-3">';
    foreach ($departments as $dept) {
        $html .= '<button class="btn btn-outline-success rounded-pill px-3 py-2 mr-2 mb-2 verified-department-subtile" style="min-width: 200px;"
                    data-department="' . $dept->department_id . '" 
                    data-district="' . $district_id . '">'
            . htmlspecialchars($dept->department_name) . ': <strong>' . $dept->verified_applications . '</strong>'
            . '</button>';
    }
    $html .= '</div>';

    Log::info('Generated HTML for verified department breakdown, district_id: ' . $district_id, ['html' => $html]);
    return response()->make($html);
});

Route::get('/get-verified-institute-grid/{district_id}/{department_id}', function ($district_id, $department_id) {
    Log::info('Fetching verified institute grid for district_id: ' . $district_id . ', department_id: ' . $department_id);
    $institutes = DB::table('trip_infos')
        ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->join('status', 'basic_infos.user_id', '=', 'status.user_id')
        ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->join('hods', 'organizations.hod_id', '=', 'hods.id')
        ->join('districts', 'trip_infos.district', '=', 'districts.id')
        ->join('tehsils', 'trip_infos.tehsil', '=', 'tehsils.id')
        ->where('basic_infos.confirmation', 1)
        ->where('status.deptist', '1')
        ->where('trip_infos.district', $district_id)
        ->where('organizations.hod_id', $department_id)
        ->select(
            'organizations.org_name as institute_name',
            DB::raw('COUNT(*) as verified_applications'),
            'districts.name as district_id',
            'tehsils.tehsil_name as tehsil_id',
            'trip_infos.org_name as org_id',
            'districts.id as districtID',
            'tehsils.id as tehsilID'
        )
        ->groupBy('organizations.org_name', 'districts.name', 'tehsils.tehsil_name', 'trip_infos.org_name', 'districts.id', 'tehsils.id')
        ->orderByRaw('COUNT(*) DESC')
        ->get();

    Log::info('Verified institute grid result: ', [
        'district_id' => $district_id,
        'department_id' => $department_id,
        'count' => $institutes->count(),
        'data' => $institutes->toArray()
    ]);

    return response()->json($institutes);
});

Route::get('/get-verified-users-by-institute', function (Request $request) {
    $orgId = $request->input('org_id');
    $districtId = $request->input('district_id');
    $tehsilId = $request->input('tehsil_id');
    Log::info('Fetching verified users for institute, org_id: ' . $orgId . ', district_id: ' . $districtId . ', tehsil_id: ' . $tehsilId);
    $users = DB::table('trip_infos')
        ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->join('status', 'basic_infos.user_id', '=', 'status.user_id')
        ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->where('basic_infos.confirmation', 1)
        ->where('status.deptist', '1')
        ->where('trip_infos.district', $districtId)
        ->where('trip_infos.tehsil', $tehsilId)
        ->where('trip_infos.org_name', $orgId)
        ->select('basic_infos.user_id', 'basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact')
        ->get();
    Log::info('Verified users by institute result: ', ['count' => $users->count(), 'data' => $users->toArray()]);
    return response()->json($users);
});


// Station

Route::get('/get-station-department-breakdown/{district_id}', function ($district_id) {
    Log::info('Fetching station department breakdown for district_id: ' . $district_id);
    $departments = DB::table('trip_infos')
        ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->join('status', 'basic_infos.user_id', '=', 'status.user_id')
        ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->join('hods', 'organizations.hod_id', '=', 'hods.id')
        ->join('districts', 'trip_infos.district', '=', 'districts.id')
        ->where('basic_infos.confirmation', '1')
        ->where('status.station', '1')
        ->where('districts.id', $district_id)
        ->whereIn('organizations.hod_id', [2, 5])
        ->select(
            'hods.id as department_id',
            'hods.name as department_name',
            DB::raw('COUNT(*) as station_applications'),
            'districts.id as districtID',
            'districts.name as district_id'
        )
        ->groupBy('hods.id', 'hods.name', 'districts.id', 'districts.name')
        ->orderByRaw('COUNT(*) DESC')
        ->get();

    Log::info('Station department breakdown result: ', [
        'district_id' => $district_id,
        'count' => $departments->count(),
        'data' => $departments->toArray()
    ]);

    if ($departments->isEmpty()) {
        Log::warning('No applications at stations found for district_id: ' . $district_id);
        return response()->make('<div class="alert alert-warning mt-3">No applications at stations found for HED or SED in this district.</div>');
    }

    $html = '<div class="d-flex flex-wrap mt-3">';
    foreach ($departments as $dept) {
        $html .= '<button class="btn btn-outline-success rounded-pill px-3 py-2 mr-2 mb-2 station-department-subtile" style="min-width: 200px;"
                    data-department="' . $dept->department_id . '" 
                    data-district="' . $district_id . '">'
            . htmlspecialchars($dept->department_name) . ': <strong>' . $dept->station_applications . '</strong>'
            . '</button>';
    }
    $html .= '</div>';

    Log::info('Generated HTML for station department breakdown, district_id: ' . $district_id, ['html' => $html]);
    return response()->make($html);
});

Route::get('/get-station-institute-grid/{district_id}/{department_id}', function ($district_id, $department_id) {
    Log::info('Fetching station institute grid for district_id: ' . $district_id . ', department_id: ' . $department_id);
    $institutes = DB::table('trip_infos')
        ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->join('status', 'basic_infos.user_id', '=', 'status.user_id')
        ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->join('hods', 'organizations.hod_id', '=', 'hods.id')
        ->join('districts', 'trip_infos.district', '=', 'districts.id')
        ->join('tehsils', 'trip_infos.tehsil', '=', 'tehsils.id')
        ->where('basic_infos.confirmation', 1)
        ->where('status.station', '1')
        ->where('trip_infos.district', $district_id)
        ->where('organizations.hod_id', $department_id)
        ->select(
            'organizations.org_name as institute_name',
            DB::raw('COUNT(*) as station_applications'),
            'districts.name as district_id',
            'tehsils.tehsil_name as tehsil_id',
            'trip_infos.org_name as org_id',
            'districts.id as districtID',
            'tehsils.id as tehsilID'
        )
        ->groupBy('organizations.org_name', 'districts.name', 'tehsils.tehsil_name', 'trip_infos.org_name', 'districts.id', 'tehsils.id')
        ->orderByRaw('COUNT(*) DESC')
        ->get();

    Log::info('Station institute grid result: ', [
        'district_id' => $district_id,
        'department_id' => $department_id,
        'count' => $institutes->count(),
        'data' => $institutes->toArray()
    ]);

    return response()->json($institutes);
});

Route::get('/get-station-users-by-institute', function (Request $request) {
    $orgId = $request->input('org_id');
    $districtId = $request->input('district_id');
    $tehsilId = $request->input('tehsil_id');
    Log::info('Fetching station users for institute, org_id: ' . $orgId . ', district_id: ' . $districtId . ', tehsil_id: ' . $tehsilId);
    $users = DB::table('trip_infos')
        ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->join('status', 'basic_infos.user_id', '=', 'status.user_id')
        ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->where('basic_infos.confirmation', 1)
        ->where('status.station', '1')
        ->where('trip_infos.district', $districtId)
        ->where('trip_infos.tehsil', $tehsilId)
        ->where('trip_infos.org_name', $orgId)
        ->select('basic_infos.user_id', 'basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact')
        ->get();
    Log::info('Station users by institute result: ', ['count' => $users->count(), 'data' => $users->toArray()]);
    return response()->json($users);
});

// Handed over

//  Handed Over Cards: Department Breakdown
Route::get('/get-handedover-department-breakdown/{district_id}', function ($district_id) {
    Log::info('Fetching handed over department breakdown for district_id: ' . $district_id);
    $departments = DB::table('trip_infos')
        ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->join('status', 'basic_infos.user_id', '=', 'status.user_id')
        ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->join('hods', 'organizations.hod_id', '=', 'hods.id')
        ->join('districts', 'trip_infos.district', '=', 'districts.id')
        ->where('basic_infos.confirmation', '1')
        ->where('status.handover', '1')
        ->where('trip_infos.district', $district_id)
        ->whereIn('organizations.hod_id', [2, 5])
        ->select(
            'hods.id as department_id',
            'hods.name as department_name',
            DB::raw('COUNT(*) as handedover_applications'),
            'districts.id as districtID',
            'districts.name as district_id'
        )
        ->groupBy('hods.id', 'hods.name', 'districts.id', 'districts.name')
        ->orderByRaw('COUNT(*) DESC')
        ->get();

    Log::info('Handed over department breakdown result: ', [
        'district_id' => $district_id,
        'count' => $departments->count(),
        'data' => $departments->toArray()
    ]);

    if ($departments->isEmpty()) {
        Log::warning('No handed over applications found for district_id: ' . $district_id);
        return response()->make('<div class="alert alert-warning mt-3">No handed over applications found for HED or SED in this district.</div>');
    }

    $html = '<div class="d-flex flex-wrap mt-3">';
    foreach ($departments as $dept) {
        $html .= '<button class="btn btn-outline-success rounded-pill px-3 py-2 mr-2 mb-2 handedover-department-subtile" style="min-width: 200px;" ' .
                 'data-department="' . $dept->department_id . '" data-district="' . $district_id . '">' .
                 htmlspecialchars($dept->department_name) . ': <strong>' . $dept->handedover_applications . '</strong></button>';
    }
    $html .= '</div>';

    Log::info('Generated HTML for handed over department breakdown, district_id: ' . $district_id, ['html' => $html]);
    return response()->make($html);
})->name('pma.handedover_department_breakdown');

// Handed Over Cards / Institute Grid
Route::get('/get-handedover-institute-grid/{district_id}/{department_id}', function ($district_id, $department_id) {
    Log::info('Fetching handed over institute grid for district_id: ' . $district_id . ', department_id: ' . $department_id);
    $institutes = DB::table('trip_infos')
        ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->join('status', 'basic_infos.user_id', '=', 'status.user_id')
        ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->join('hods', 'organizations.hod_id', '=', 'hods.id')
        ->join('districts', 'trip_infos.district', '=', 'districts.id')
        ->join('tehsils', 'trip_infos.tehsil', '=', 'tehsils.id')
        ->where('basic_infos.confirmation', 1)
        ->where('status.handover', '1')
        ->where('trip_infos.district', $district_id)
        ->where('organizations.hod_id', $department_id)
        ->select(
            'organizations.org_name as institute_name',
            DB::raw('COUNT(*) as handedover_applications'),
            'districts.name as district_id',
            'tehsils.tehsil_name as tehsil_id',
            'trip_infos.org_name as org_id',
            'districts.id as districtID',
            'tehsils.id as tehsilID'
        )
        ->groupBy('organizations.org_name', 'districts.name', 'tehsils.tehsil_name', 'trip_infos.org_name', 'districts.id', 'tehsils.id')
        ->orderByRaw('COUNT(*) DESC')
        ->get();

    Log::info('Handed over institute grid result: ', [
        'district_id' => $district_id,
        'department_id' => $department_id,
        'count' => $institutes->count(),
        'data' => $institutes->toArray()
    ]);

    return response()->json($institutes);
})->name('pma.handedover_institute_grid');

// Handed Over Cards/ Users by Institute
Route::get('/get-handedover-users-by-institute', function (Request $request) {
    $orgId = $request->input('org_id');
    $districtId = $request->input('district_id');
    $tehsilId = $request->input('tehsil_id');
    Log::info('Fetching handed over users for institute, org_id: ' . $orgId . ', district_id: ' . $districtId . ', tehsil_id: ' . $tehsilId);
    $users = DB::table('trip_infos')
        ->join('basic_infos', 'trip_infos.user_id', '=', 'basic_infos.user_id')
        ->join('status', 'basic_infos.user_id', '=', 'status.user_id')
        ->join('organizations', 'trip_infos.org_name', '=', 'organizations.id')
        ->where('basic_infos.confirmation', 1)
        ->where('status.handover', '1')
        ->where('trip_infos.district', $districtId)
        ->where('trip_infos.tehsil', $tehsilId)
        ->where('trip_infos.org_name', $orgId)
        ->select('basic_infos.user_id', 'basic_infos.passenger_name', 'basic_infos.cnic', 'basic_infos.contact')
        ->get();

    Log::info('Handed over users by institute result: ', ['count' => $users->count(), 'data' => $users->toArray()]);
    return response()->json($users);
})->name('pma.handedover_users_by_institute');

// View Application Details
// Route::get('/showform/{user_id}', function ($user_id) {
//     $application = DB::table('basic_infos')
//         ->join('trip_infos', 'basic_infos.user_id', '=', 'trip_infos.user_id')
//         ->where('basic_infos.user_id', $user_id)
//         ->first();
//     if (!$application) {
//         Log::warning('No application found for user_id: ' . $user_id);
//         abort(404, 'Application not found');
//     }
//     return view('pma.show_form', compact('application'));
// })->name('pma.show_form');





Route::get('/reg', function () {
    return view('auth.reg');
});
Route::get('/log', function () {
    return view('auth.log');
});

Route::get('/student', function () {
    return view('welcome');
});

Route::get('/student1', function () {
    return view('Institute.selectregistration');
});

Route::get('/registeration', function () {
    return view('registeration');
});


Route::get('/setting', function () {
    return view('design_main/sidebar');

});
Route::get('/main', function () {
    return view('design_main/master');
});
Route::get('/afc', function () {
    return view('afc_dashboard/forminfo');
});

Route::get('/afcaccount', function () {
    return view('afc_dashboard/afc_account');
});

Route::get('/receive', function () {
    return view('afc_dashboard/recieving');
});
Route::get('/prof', function () {
    return view('afc_dashboard/profile');
});

Route::get('/aform', function () {
    return view('afc_dashboard/afcform');
});


Route::get('/verify', function () {
    return view('auth.passwords.codeverification');
});

Route::get('/code', function () {
    return view('auth.passwords.code');
});

Route::get('/', function () {
    return view('welcome1');
});

 Route::get('/robocall/{phoneno}/{cnic}', [App\Http\Controllers\AdminController::class, 'robocall']);

 Route::get('/check-robocalls/{phoneno}/{cnic}', [App\Http\Controllers\AdminController::class, 'callsrecord']);


Route::post('/verifi', [CardformController::class, 'verify'])->name('verifi');

Route::get('/mes', [App\Http\Controllers\CardformController::class,'message']);

Auth::routes();


Route::get('/usershowform/{id}', [CardformController::class, 'usershowForm'])->name('user.showform');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/Institute-dashboard', [InstituteController::class, 'showDashboard'])->name('Institute.dashboard');
Route::get('/ViewUsers', [InstituteController::class, 'index1'])->name('view.users');
Route::get('/showform/{id}', [InstituteController::class, 'showForm'])->name('showform');
//Showform Comment Section
Route::post('/reject/save/{user_id}', [InstituteController::class, 'saveReject'])->name('reject.save');
Route::post('/reject/edit/{user_id}', [InstituteController::class, 'editReject'])->name('reject.edit');
Route::post('/reject/delete/{user_id}', [InstituteController::class, 'deleteReject'])->name('reject.delete');


Route::get('/userdetail/{id}', [InstituteController::class, 'viewdetail'])->name('institute.viewdetail');

Route::post('/verify-user/{user_id}', [InstituteController::class, 'verifyUser'])->name('verify.user');
Route::post('/reject-user/{user_id}', [InstituteController::class, 'rejectUser'])->name('reject.user');
Route::get('/RejectedUsers', [InstituteController::class, 'rejectedUsers'])->name('rejected.users');
Route::get('/VerifiedUsers', [InstituteController::class, 'verifiedUsers'])->name('verified.users');
Route::get('/PendingUsers', [InstituteController::class, 'pendingUsers'])->name('verified.users');


Route::get('/institute_reg', [InstituteController::class, 'newUser'])->name('Institute.newUser');
Route::post('/storeinstitute', [InstituteController::class, 'storeinstitute'])->name('Institute.storeuser');
Route::get('/oppmaform', [App\Http\Controllers\CardformController::class,'opcreate']);
Route::post('/oppmaformstore', [App\Http\Controllers\CardformController::class,'opstoreform'])->name('pmaform.opstore');
Route::post('/opstorecheck', [App\Http\Controllers\CardformController::class, 'opstorecheck'])->name('opstore.check');

Route::get('/pmaform', [App\Http\Controllers\CardformController::class,'create'])->name('pmaform')->middleware('use'); // to edit oppmaform
Route::post('/pmaformstore', [App\Http\Controllers\CardformController::class,'storeform'])->name('pmaform.store');
Route::post('/storecheck', [App\Http\Controllers\CardformController::class, 'storecheck'])->name('store.check');


Route::get('/pmafm', [App\Http\Controllers\CardformController::class,'show'])->name('pmaform.show');
Route::get('/userdashboard', [App\Http\Controllers\UserController::class,'dashboard'])->name('Udashboard')->middleware('use');
Route::get('/status', [App\Http\Controllers\UserController::class,'status'])->name('status')->middleware('use');
Route::get('/guest-status', [App\Http\Controllers\UserController::class, 'status'])->name('guest.status');

Route::get('/editform/{id}', [CardformController::class,'edit'])->name('edit');
Route::patch('/updateform/{id}', [CardformController::class,'update'])->name('updatep');

Route::get('/account', [App\Http\Controllers\UserController::class, 'show'])->name('account');

Route::get('/edit/{id}', [App\Http\Controllers\UserController::class,'edit'])->name('edit');
Route::patch('/update/{id}', [UserController::class,'update'])->name('update');

Route::get('/pay', [App\Http\Controllers\PaymentController::class, 'index'])->name('payment');
Route::post('/pays', [App\Http\Controllers\PaymentController::class,'store'])->name('payment.store');

Route::get('/shpay', [App\Http\Controllers\PaymentController::class, 'show'])->name('showpayment');

// head institute route
Route::post('/update-status/{id}', [App\Http\Controllers\HeadInstituteController::class, 'updateStatus'])->name('update.status');

Route::get('/verifyinstitutelist', [App\Http\Controllers\HeadInstituteController::class,'verifyinstitutelist'])->name('verify.institutelist');
Route::get('/verifyinstitute', [App\Http\Controllers\HeadInstituteController::class,'verifyinstitute']);
Route::get('/addinstitute', [App\Http\Controllers\HeadInstituteController::class,'addinstitute']);
Route::post('/storeuserinstitute', [App\Http\Controllers\HeadInstituteController::class, 'storeuserinstitute'])->name('Institute.storeuserinstitute');
// Route::post('/addorganization', [App\Http\Controllers\HeadInstituteController::class, 'updateOrg']);

Route::get('/headinstitutedashboard', [App\Http\Controllers\HeadInstituteController::class,'dashboard']);
Route::get('/viewstudlist', [App\Http\Controllers\HeadInstituteController::class, 'viewlist'])->name('view.list');
Route::get('/viewplist', [App\Http\Controllers\HeadInstituteController::class, 'pending'])->name('view.plist');
Route::get('/viewp2list', [App\Http\Controllers\HeadInstituteController::class, 'pending2'])->name('view.p2list');
Route::get('/viewpending', [App\Http\Controllers\HeadInstituteController::class, 'forwardlist'])->name('view.forwardlist');
Route::post('/forward', [App\Http\Controllers\HeadInstituteController::class, 'forward'])->name('view.forward');
Route::post('/forward2', [App\Http\Controllers\HeadInstituteController::class, 'forward2'])->name('view.forward2');
Route::get('/verifylist', [App\Http\Controllers\HeadInstituteController::class, 'verifylist'])->name('verify.list');
Route::get('/rejectedlist', [App\Http\Controllers\HeadInstituteController::class, 'rejectedlist'])->name('rejected.list');
Route::get('/viewdetailappli/{id}', [App\Http\Controllers\HeadInstituteController::class, 'viewdetail'])->name('view.detail');
Route::get('/viewdetailinstitute/{id}', [App\Http\Controllers\HeadInstituteController::class, 'viewinstitute'])->name('view.institute');




Route::get('/statusbar', [App\Http\Controllers\HeadInstituteController::class,'status'])->name('status.bar');

//pma routes

Route::get('/pmadashboard', [App\Http\Controllers\PmaController::class,'pmadashboard'])->name('dashboard.pma');
Route::get('/pmastatusbar', [App\Http\Controllers\PmaController::class,'statusbar'])->name('statusbar.pma');
Route::get('/pmashowform/{id}', [PmaController::class, 'showForm'])->name('showform');
Route::get('/regappli', [App\Http\Controllers\PmaController::class,'regappli'])->name('regappli.pma');
Route::get('/pendappli', [App\Http\Controllers\PmaController::class,'pendingappli'])->name('pendingappli.pma');
Route::get('/rejectedappli', [App\Http\Controllers\PmaController::class,'rejectedappli'])->name('rejectedappli.pma');
Route::get('/verifyappli', [App\Http\Controllers\PmaController::class,'verifyappli'])->name('verifyappli.pma');
Route::get('/forwardappli', [App\Http\Controllers\PmaController::class,'forwardtobop'])->name('forward.pma');
Route::get('/viewapplidetail/{id}', [App\Http\Controllers\PmaController::class, 'viewapplidetail'])->name('view.applidetail');

Route::get('/forwardapplitobop/{id}', [App\Http\Controllers\PmaController::class,'forwardapplitobop'])->name('forwardapplitobop.pma');
Route::post('/storeforward' , [App\Http\Controllers\PmaController::class, 'storeforward'])->name('store.forwardstatus');

Route::get('/showhod', [App\Http\Controllers\PmaController::class,'showhod'])->name('showhod.pma');
Route::post('/addhod', [App\Http\Controllers\PmaController::class,'addhod'])->name('addhod.pma');



// admin routes

Route::get('/admindashboard', [App\Http\Controllers\AdminController::class, 'show'])->name('ADdashboard')->middleware('admin');
Route::get('/createaccount', [App\Http\Controllers\AdminController::class, 'create'])->name('create.account')->middleware('admin');
Route::post('/accountsave', [App\Http\Controllers\AdminController::class, 'store'])->name('store.account')->middleware('admin');


Route::get('/adminstatus', [App\Http\Controllers\AdminController::class, 'status'])->name('status.account')->middleware('admin');
Route::get('/formstatus', [App\Http\Controllers\AdminController::class, 'formstatus'])->name('form.status')->middleware('admin');
Route::get('/paystatus', [App\Http\Controllers\AdminController::class, 'paystatus'])->name('pay.status')->middleware('admin');
Route::get('/verifystatus', [App\Http\Controllers\AdminController::class, 'verifystatus'])->name('verify.status')->middleware('admin');
Route::get('/dispatchstatus', [App\Http\Controllers\AdminController::class, 'dispatchstatus'])->name('dispatch.status')->middleware('admin');



Route::get('/stationsort', [App\Http\Controllers\DepoController::class, 'stationsort'])->name('stationsort');


Route::get('/check-cnic', [AdminController::class, 'showCnicForm'])->name('check.cnic.form');
Route::post('/check-cnic-data', [AdminController::class, 'check'])->name('check.cnic');

// PCRDP Registration number table routes


Route::POST ('/get-bdivisions-by-province', [App\Http\Controllers\AdminController::class, 'regbdivision']);

Route::post ('/get-bdistricts-by-division', [App\Http\Controllers\AdminController::class, 'registerbdistrict']);
Route::post ('/get-stops', [App\Http\Controllers\AdminController::class, 'regbstop']);
Route::post ('/get-mboard-by-bdistrict', [App\Http\Controllers\AdminController::class, 'regmboard']);
Route::post ('/get-category-by-system-name', [App\Http\Controllers\AdminController::class, 'categorybysystem']);

Route::POST ('/get-bdivisions-by-tehsil', [App\Http\Controllers\AdminController::class, 'regtehsil']);
Route::POST ('/get-bdivisions-by-institute', [App\Http\Controllers\AdminController::class, 'reginstitute']);
Route::POST ('/get-bdivisions-by-edulevel', [App\Http\Controllers\AdminController::class, 'regedulevel']);
Route::POST ('/get-bdivisions-by-organization', [App\Http\Controllers\AdminController::class, 'regorganization']);

Route::post('/get-grades-by-edu-level', [App\Http\Controllers\AdminController::class, 'getGradesByEduLevel']);
Route::post('/get-institutes-by-district', [App\Http\Controllers\AdminController::class, 'getInstitutesByDistrict']);

Route::get('/get-all-tehsils', [App\Http\Controllers\AdminController::class, 'getAllTehsils']);



Route::get('/progress/{id}', [UserController::class, 'showProgress'])->name('progress.status');

Route::post('/check-cnic-ajax', [AdminController::class, 'checkCnicAjax'])->name('check.cnic.ajax');

Route::middleware(['auth'])->prefix('institute')->name('institute.')->group(function () {
    Route::get('/manage-users', [AddOrgController::class, 'index'])->name('users.index');
    Route::post('/users', [AddOrgController::class, 'storeUser'])->name('users.store');
    Route::delete('/users/{id}', [AddOrgController::class, 'destroyUser'])->name('users.destroy');
    Route::get('/users/{id}/edit', [AddOrgController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{id}', [AddOrgController::class, 'updateUser'])->name('users.update');

    Route::post('/organizations', [AddOrgController::class, 'storeOrganization'])->name('organizations.store');
    Route::put('/organizations/{id}', [AddOrgController::class, 'updateOrganization'])->name('organizations.update');
    Route::delete('/organizations/{id}', [AddOrgController::class, 'destroyOrganization'])->name('organizations.destroy');
    Route::get('/organizations/{id}/edit', [AddOrgController::class, 'editOrganization'])->name('organizations.edit');
});
