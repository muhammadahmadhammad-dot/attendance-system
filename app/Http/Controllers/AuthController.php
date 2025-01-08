<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function logout()
    {
        Auth::logout();
        return to_route('login')->with('success', 'Logout Successfully');;
    }
    public function login()
    {
        if (auth()->id() != '') {
            return redirect()->back();
        }
        return view('auth.login');
    }
    public function register()
    {
        if (auth()->id() != '') {
            return redirect()->back();
        }
        return view('auth.register');
    }
    public function loginCheck(Request $request)
    {
        $validate = $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
        );
        if (Auth::attempt($validate)) {

            return to_route('home');
        } else {
            return redirect()->back()->withInput()->with('danger', 'Sorry I Cant You.');
        }
    }
    public function registration(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
                'confirm_password' => 'required|same:password',
            ]
        );

        $user = User::create(
            [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => $validated['password'],
            ]
        );

        if ($user) {
            return to_route('login');
        } else {
            return redirect()->back()->with('danger', 'Sorry, We are unable to create your account, please try later.');
        }
    }
}
