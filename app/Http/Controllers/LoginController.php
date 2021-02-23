<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = $request -> only('email', 'password');
        $result = Auth::attempt($credentials);
        if ($result){
            return redirect('/');
        }else {
            return redirect() -> back() -> withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function authenticateApi(LoginRequest $request)
    {

        $credentials = $request -> only('email', 'password');
        $result = Auth::guard('jwt') -> attempt($credentials);
        if ($result){
            return [
                "user" => Auth::guard('jwt') -> user(),
                "token" => $result
            ];
        }else {
            throw new UnauthorizedHttpException('error', 'sai tk');
        }
    }

    public function userData()
    {
        return Auth::user();
    }
}
