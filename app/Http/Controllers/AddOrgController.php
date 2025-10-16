<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Organization;
use App\Models\District;
use App\Models\Tehsil;
use App\Models\Edu;
use App\Models\Hod;

class AddOrgController extends Controller
{
    //


    public function index()
{

$user = auth()->user();

    
    if ($user->hod_institute) {
        // $organizations = Organization::where('hod_id', $user->hod_institute)->latest()->get();
        $organizations = Organization::with('district')
    ->where('hod_id', $user->hod_institute)
    ->latest()
    ->get();
    } else {

        $organizations = Organization::latest()->get();
    }

    $allOrganizations = Organization::orderBy('org_name')->get();

    $orgid = Organization::where('hod_id', $user->hod_institute)->pluck('id');

    $roleTwoUsers = User::where('role', 2)
    ->whereIn('hod_institute', $orgid)
    ->get();
      
    // $organizations = Organization::latest()->paginate(10);
    $districts = District::orderBy('name')->get();
    $tehsils = Tehsil::orderBy('tehsil_name')->get();
    $edu_levels = Edu::orderBy('name')->get();
            $hods    = Hod::orderBy('name')->get(); 
    return view('head_institute.addorganization', compact('roleTwoUsers', 'organizations','allOrganizations','districts','tehsils','edu_levels','hods'));
}

public function storeUser(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6|confirmed',
        'phone_number' => 'required|string|max:20',
        'cnic' => 'required|string|max:20',
        'org_name' => 'required|string|max:255',
    ]);

    $loggedInUser = auth()->user();

    $organization = Organization::where('org_name', $request->org_name)->first();

    if (!$organization) {
        return back()->withErrors(['org_name' => 'The organization does not exist.']);
    }

    
    if ($organization->hod_id != $loggedInUser->hod_institute) {
        return back()->withErrors(['org_name' => 'You are not allowed to assign users to this organization.']);
    }


    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'phone_number' => $request->phone_number,
        'role' => 2, 
        'cnic' => $request->cnic,
        'created_by' => $loggedInUser->id,
        'hod_institute' => $organization->id,
    ]);

    return back()->with('success', 'User created successfully.');
}

public function destroyUser($id)
{
    $user = User::where('role', 2)->findOrFail($id);
    $user->delete();

    return back()->with('success', 'User deleted.');
}

public function storeOrganization(Request $request)
{
    //  dd($request->all());

    $user = auth()->user();

    if ($user->role == 3) {
        $alreadyAdded = Organization::where('created_by', $user->id)->exists();

        if ($alreadyAdded) {
            return back()->with('error', 'You can only add one organization.');
        }
    }


    $request->validate([
        'org_name' => 'required|string|max:255|unique:organizations,org_name',
        'district_id' => 'required|exists:districts,id',
        'tehsil_id' => 'required|exists:tehsils,id',
        'edu_level' => 'required|exists:edu_levels,id',
        'hod_id' => 'required|exists:hods,id',

        'institute_type' => 'required|in:1,2',
    ]);
    

    $org = Organization::create([
        
        'org_name' => $request->org_name,
         'district_id' => $request->district_id,
          'tehsil_id' => $request->tehsil_id,
          'edu_level' => $request->edu_level,
          'hod_id' => $request->hod_id,
           'institute_type' => $request->institute_type,
            'created_by' => auth()->id(),
        
    ]);
    dd($org);

    return back()->with('success', 'Organization added.');
}



public function destroyOrganization($id)
{
    Organization::findOrFail($id)->delete();
    return back()->with('success', 'Organization deleted.');
}

// Show edit form for a user
public function editUser($id)
{
    $user = User::where('role', 2)->findOrFail($id);
    $roleTwoUsers = User::where('role', 2)->get();
    $organizations = Organization::all();

    return view('head_institute.addorganization', compact('user', 'roleTwoUsers', 'organizations'));
}

// Update user
public function updateUser(Request $request, $id)
{
    $user = User::where('role', 2)->findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'phone_number' => 'required|string|max:20',
        'password' => 'nullable|string|min:6|confirmed',
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    $user->phone_number = $request->phone_number;

    if ($request->filled('password')) {
        $user->password = bcrypt($request->password);
    }

    $user->save();

    return redirect()->route('institute.users.index')->with('success', 'User updated successfully.');
}

// Show edit form for organization
public function editOrganization($id)
{
    $org = Organization::findOrFail($id);
    $roleTwoUsers = User::where('role', 2)->get();
    $organizations = Organization::all();

    return view('head_institute.addorganization', compact('org', 'organizations', 'roleTwoUsers'));
}

// Update organization
public function updateOrganization(Request $request, $id)
{
    $org = Organization::findOrFail($id);

    $request->validate([
        'org_name' => 'required|string|max:255|unique:organizations,org_name,' . $org->id,
    ]);

    $org->org_name = $request->org_name;
    $org->save();

    return redirect()->route('institute.users.index')->with('success', 'Organization updated successfully.');
}



}
