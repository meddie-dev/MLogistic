<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store()
    {
        // Validate
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        // Attempt to sign in
        if (! Auth::attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Your provided credentials could not be verified.'
            ]);
        }
    
        // Get the authenticated user
        $user = Auth::user();
    
        $supplier = $user->supplier;
        if ($supplier) {
            $supplier->update(['last_login_at' => now('Asia/Manila')->format('Y-m-d H:i')]);
        }
        
        // Regenerate session
        request()->session()->regenerate();
    
        // Redirect based on role
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role === 'supplier') {
            return redirect('/supplier/dashboard');
        } else {
            return redirect('/constructor/dashboard');
        }
    }
    
    
    
    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
