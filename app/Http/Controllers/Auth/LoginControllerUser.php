<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Support\RedirectsAfterLogin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginControllerUser extends Controller
{
    public function showLoginForm()
    {
        return view('members.members.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            $redirect = $request->session()->pull('url.intended', RedirectsAfterLogin::url(Auth::user()));

            return response()->json([
                'message' => 'تم تسجيل الدخول بنجاح!',
                'redirect' => $redirect,
            ]);
        }

        return response()->json(['errors' => ['email' => ['البريد الإلكتروني أو كلمة المرور غير صحيحة']]], 422);
    }
}
