<?php
namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Job\Application;
use App\Models\Job\JobSaved;
use Auth;
use File;

class UsersController extends Controller
{
    public function profile()
    {
        $profile = User::find(Auth::user()->id);
        return view('users.profile', compact('profile'));
    }

    public function applications()
    {
        // Retrieve applications associated with the authenticated user
        $applications = Application::where('user_id', '=',Auth::user()->id)
        ->get();
        
        // Pass the applications data to the view
        return view('users.applications', compact('applications'));
    }
    public function savedJobs()
    {
        // Retrieve applications associated with the authenticated user
        $savedJobs = JobSaved::where('user_id', '=',Auth::user()->id)
        ->get();
        
        // Pass the applications data to the view
        return view('users.savedjobs', compact('savedJobs'));
    }
    public function editDetails()
    {
        // Retrieve applications associated with the authenticated user
        $userDetails = User::find(Auth::user()->id);
        
        
        // Pass the applications data to the view
        return view('users.editdetails', compact('userDetails'));
    }

    public function updateDetails(Request $request)
{


    Request()->validate([
        "name"=>"required |max:40",
        "job_title"=>"required |max:40",
        "bio"=>"required" ,
        "facebook"=>"required |max:140",
        "twitter"=>"required |max:140",
        "linkedin"=>"required |max:140",



    ]);
    // Retrieve authenticated user details
    $userDetailsUpdate = User::find(Auth::user()->id);

    // Update user details
    $userDetailsUpdate->update([
        "name" => $request->name,
        "job_title" => $request->job_title,
        "bio" => $request->bio,
        "facebook" => $request->facebook,
        "twitter" => $request->twitter,
        "linkedin" => $request->linkedin
    ]);

    // Check if update was successful
    if ($userDetailsUpdate) {
        // Redirect back with success message
        return redirect('/users/edit-details')->with('update', 'User details updated successfully');
    }
    
        
        // Pass the applications data to the view
        //return view('users.editdetails', compact('userDetails'));
    }

    public function editCV()
    {
        // Retrieve applications associated with the authenticated user
        
        
        
        // Pass the applications data to the view
        return view('users.editcv');
    }


    public function updateCV(Request $request)
{
    $user = User::find(Auth::id());

    // Check if the user exists
    if (!$user) {
        // Handle case when user is not found
        return redirect('/users/profile')->with('error', 'User not found');
    }

    // Check if the new CV file is present in the request
    if (!$request->hasFile('cv')) {
        // Handle case when CV file is not provided
        return redirect('/users/profile')->with('error', 'CV file not provided');
    }

    // Check if the old CV file exists and delete it
    if (File::exists(public_path('asset/cvs/' . $user->cv))) {
        File::delete(public_path('asset/cvs/' . $user->cv));
    }

    // Move the new CV file to the destination folder
    $destinationPath = 'asset/cvs/';
    $newCVName = $request->cv->getClientOriginalName();
    $request->cv->move(public_path($destinationPath), $newCVName);

    // Update the user's CV field with the new CV file name
    $user->cv = $newCVName;
    $user->save();

    // Redirect back to the user's profile page with success message
    return redirect()->route('profile')->with('update', 'CV updated successfully');

}

    
}


