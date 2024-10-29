<?php

namespace App\Http\Controllers;

use App\Mail\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    public function index()
    {
        return view('settings.index'); // Create a view for user settings
    }

    public function update(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();
        
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        if ($user instanceof User) {
            $user->update(); // Save the updated user data
            return redirect()->route('settings.index')->with('success', 'Profile updated successfully.');
        }


        return redirect()->route('settings.index')->with('success', 'Profile updated successfully.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!password_verify($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = bcrypt($request->new_password);
        if ($user instanceof User) {
            $user->save(); // Save the updated user data
            return redirect()->route('settings.index')->with('success', 'Profile updated successfully.');
        }


        return redirect()->route('settings.index')->with('success', 'Password changed successfully.');
    }

    public function deleteAccount(Request $request)
{
    // Get the authenticated user
    $user = Auth::user();

    // Ensure the user has an email address
    if (is_null($user->email)) {
        return back()->withErrors(['error' => 'No email address found for your account.']);
    }

    // Generate a random OTP
    $otp = Str::random(10); // Use a 6-character OTP if that's what you intended

    // Save OTP in session for later verification
    session(['otp' => $otp]);

    // Send OTP email using the Otp Mailable
    try {
        Mail::to($user->email)->send(new Otp($otp, $user)); // Correctly instantiate and send the mailable
    } catch (\Exception $e) {
        // Handle email sending failure
        return back()->withErrors(['error' => 'Failed to send OTP. Please try again later.']);
    }

    // Return the view for OTP confirmation or deletion process
    return view('settings.delete_account')->with('success', 'OTP sent to your email.'); // Pass success message to the view
}


    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|string']);

        if ($request->otp === session('otp')) {
            $user = Auth::user();
            if ($user instanceof User) {
                $user->delete(); // Save the updated user data
            }
    
            session()->forget('otp');

            return redirect('/login')->with('success', 'Account deleted successfully.');
        }

        return back()->withErrors(['otp' => 'Invalid OTP.']);
    }
}
