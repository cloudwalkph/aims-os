<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\ChangePasswordRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function profile()
    {
        return view('profile.index');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = User::where('id', $request->user()->id)->first();

        if (! \Hash::check($request->get('current_password'), $user->password)) {
            return Redirect::back()->withErrors(['Current password does not match']);
        }

        if ($request->get('new_password') !== $request->get('verify_password')) {
            return Redirect::back()->withErrors(['New password and verify password does not match']);
        }

        User::where('id', $request->user()->id)->update([
            'password' => \Hash::make($request->get('new_password'))
        ]);

        return redirect('/');
    }
}
