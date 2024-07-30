<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\MyClass\Response;
use App\MyClass\Validations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('login.login');
    }

    public function authenticate(Request $request) {
        Validations::loginValidate($request);
        
        $credentials = $request->only('nip', 'password');

        $user = User::where('nip', $credentials['nip'])->first();
        
        if(Hash::check($credentials['password'], $user->password)){
            Auth::loginUsingId($user->id);

            return Response::success();
        } else {
            return Response::error('Username atau password salah');
        }
    }

    public function logout(){
        try {
			auth()->logout();
		} catch (\Exception $e) {}

		return redirect()->route('login');
    }
}
