<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{

        public function dashboard(){
            return view('admin.dashboard');
        }
        public function profile(){
            return view('admin.profile');
        }
        public function updateProfile(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'password' => 'nullable|string|min:8|confirmed', // Password confirmation added
    ]);

    // Update the authenticated user's profile
    $user = Auth::user();
    $user->name = $request->name;
    $user->email = $request->email;

    // Check if a new password is provided
    if ($request->password) {
        $user->password = Hash::make($request->password);
    }

    // Save the changes to the database
    $user->save();

    // Redirect to the profile page with a success message
    return redirect('/admin/profile')->with('success', 'Profile updated successfully!');
}


}
