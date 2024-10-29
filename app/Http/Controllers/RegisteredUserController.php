<?php

namespace App\Http\Controllers;


use Illuminate\Validation\Rules\Password;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Models\Supplier;

class RegisteredUserController extends Controller
{
    public function create()
    {

        return view('auth.register');
    }

    public function store()
    {
        // Validate
        $attributes = request()->validate([
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'password' => ['required', Password::min(8), 'confirmed'],
            'role' => ['required', 'in:admin,supplier,constructor'], // Role validation
        ]);

        // Store
        $user = User::create($attributes);

        // Login
        Auth::login($user);

        // Redirect
        if ($user->role === 'admin') {
            return redirect('/admin/dashboard');
        } elseif ($user->role === 'supplier') {
            Supplier::create([
                'user_id' => $user->id,
                'email' => $user->email,
                'name' => $user->first_name . ' ' . $user->last_name,
            ]);
            return redirect('/supplier/dashboard');
        } elseif ($user->role === 'constructor') {
            return redirect('/constructor/dashboard');
        }
    }
}
