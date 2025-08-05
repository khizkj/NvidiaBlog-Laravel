<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function index(){
        return view("auth.login");
    }
    public function store(){
        $validate = request()->validate([
            'email' => ['required','email'],
            'password' => ['required'],
        ]);
        if(!Auth::attempt($validate)){
            throw ValidationException::withMessages([
                'email'=> 'Sorry, this email does not exist',
                'password'=> 'Sorry, this is a incorrect password'
            ]);
        }
        request()->session()->regenerate();
        return redirect('/blogs');
    }
    public function destroy(){
        Auth::logout();
        return redirect('/');
    }
}
