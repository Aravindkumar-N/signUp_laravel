<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class WebBlogController extends Controller
{
    public function showSignupForm()
    {
        return view('sign_up');
    }

    public function signup(Request $request)
    {
        // Validate the request
        $validatedData = $request->validate([
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create the user
        User::create([
            'name' => $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
        ]);

        // Redirect to login page
        return redirect()->route('sign_in');
    }
}
