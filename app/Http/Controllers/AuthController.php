<?php

namespace App\Http\Controllers;

Use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
Use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }
    //Login Blade
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->route('dashboard');
        }

        return back()
            ->withErrors([
                'email' => 'E-mail ou senha incorretos.',
            ])
            ->onlyInput('email');
    }
    

    //Login API
    public function loginApi(Request $request)
    {
        $credential = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $credential['email'])->first();

        if ($user || !Hash::check($credential['password'], $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login realizado com sucesso',
            'access_token' => $token,
            'user' => '$user',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    
}