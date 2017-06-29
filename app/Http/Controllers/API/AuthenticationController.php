<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class AuthenticationController extends Controller {
    public function auth(Request $request)
    {
        $input = $request->only(['email', 'password']);

        if (! \Auth::attempt($input)) {
            return response()->json(['failed to login'], 401);
        }

        $user = User::with('profile', 'department')
            ->where('id', \Auth::user()->id)
            ->first();

        return response()->json($user, 200);
    }
}