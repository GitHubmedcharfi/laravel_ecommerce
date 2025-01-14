<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Commande;
use Illuminate\Support\Facades\Auth;  // Import Auth facade
use Illuminate\Support\Facades\Hash;  // Import Hash facade

class ClientController extends Controller
{
    public function dashboard()
    {
        return view('client.dashboard');
    }

    public function profile()
    {
        return view('client.profile');
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

    public function cart()
    {
        $categories = Category::all(); // Fixed missing assignment
        $commande = Commande::where('client_id', Auth::user()->id) // Fixed the syntax with Auth and proper assignment
                            ->where('etat', 'en cours')
                            ->first(); // Fixed the missing assignment

        return view('guest.cart')
            ->with('categories', $categories)
            ->with('commande', $commande); // Corrected spacing for readability
    }
}
