<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index(){
        return view("auth.signup");
    }
    public function store(){
        $attributes=request()->validate([
            "full_name" => ["required"],
            'email' => ["required", "email", "max:226"],
            'password' => ["required",Password::min(6),'confirmed'],
        ]);

        $user = User::create($attributes);
        return redirect('/login');
    }
}
