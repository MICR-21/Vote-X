<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
        return view('dashboard', [
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->update($request->validated());

        if ($user->wasChanged('email')) {
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification(); // Assuming you have email verification enabled
        }

        $user->save();

        return Redirect::route('dashboard')->with('status', 'Profile updated successfully!');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(): RedirectResponse
    {
        $user = Auth::user();

        Auth::logout();

        $user->delete();

        return Redirect::to('/')->with('status', 'Your account has been deleted successfully!');
    }
    public function show()
{
    // Retrieve profile data and return a view
    // Retrieve profile data here
    $user = auth()->user(); // Assuming you're using Laravel's authentication
    // You can fetch additional profile data or customize as needed
    
    // Return a view with the profile data
    return view('Dashboard', ['user' => $user]);
}

}
