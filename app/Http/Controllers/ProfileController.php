<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\Activity;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $activities = Activity::where('user_id', $user->id)->latest()->get();
        
        // Calculate user contributions
        $contributionsCount = Question::where('user_id', $user->id)->count() + Answer::where('user_id', $user->id)->count();
        
        // Count best answers
        $bestAnswersCount = Answer::where('user_id', $user->id)->where('is_accepted', true)->count();
        
        return view('profile', compact('user', 'activities', 'contributionsCount', 'bestAnswersCount'));
    }

    // Method to display the edit profile page
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // Method to update user profile
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        // Check if $user is a valid Eloquent model instance
        if (!$user instanceof User) {
            return redirect()->route('profile')->with('error', 'Invalid user.');
        }

        $user->name = $request->name;
        $user->save();  // Ensure $user is a valid Eloquent model

        return redirect()->route('profile')->with('success', 'Profile updated successfully.');
    }

    // Method to display the edit email page
    public function editEmail()
    {
        return view('profile.edit-email');
    }

    // Method to update user email
    public function updateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();

        // Check if $user is a valid Eloquent model instance
        if (!$user instanceof User) {
            return redirect()->route('profile')->with('error', 'Invalid user.');
        }

        $user->email = $request->email;
        $user->save();  // Ensure $user is a valid Eloquent model

        return redirect()->route('profile')->with('success', 'Email updated successfully.');
    }

    // Method to display the edit password page
    public function editPassword()
    {
        return view('profile.edit-password');
    }

    // Method to update user password
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => ['required', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        $user = Auth::user();

        // Check if $user is a valid Eloquent model instance
        if (!$user instanceof User) {
            return redirect()->route('profile')->with('error', 'Invalid user.');
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password does not match.']);
        }

        $user->password = Hash::make($request->password);
        $user->save();  // Ensure $user is a valid Eloquent model

        return redirect()->route('profile')->with('success', 'Password updated successfully.');
    }

    private function getRecentActivities(User $user)
    {
        // Logic to get user's recent activities
        return [
            'Answered a question',
            'Posted a new question',
            'Commented on a discussion'
        ];
    }
}
