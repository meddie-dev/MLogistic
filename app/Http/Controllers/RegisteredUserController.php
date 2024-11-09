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
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', Password::min(8), 'confirmed'],
            'role' => ['required', 'in:admin,supplier,constructor'], // Role validation
        ]);

        // Store
        $user = User::create([
            'first_name' => $attributes['first_name'],
            'last_name' => $attributes['last_name'],
            'email' => $attributes['email'],
            'password' => bcrypt($attributes['password']),
            'role' => $attributes['role'],
        ]);

        // Login
        Auth::login($user);

        // Redirect
        switch ($user->role) {
            case 'admin':
                return redirect('/admin/dashboard');
            case 'supplier':
                Supplier::create([
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'name' => $user->first_name . ' ' . $user->last_name,
                ]);
                return redirect('/supplier/dashboard');
            case 'constructor':
                return redirect('/constructor/dashboard');
            default:
                return redirect('/');
        }
    }
}
