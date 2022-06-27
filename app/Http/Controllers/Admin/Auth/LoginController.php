<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendMailEsqueceuSenha;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => "required|email",
            'password' => "required"
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->first()], 422);
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['errors' => "E-mail ou senha incorretos"], 401);
        }

        return response()->json([
            'rota' => route('admin.inicio')
        ], 200);

    }

    public function forgotPassword(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email']
        ]);

        if($validator->fails()){
            return response()->json(['errors' => $validator->errors()->first()], 422);
        }

        $user = User::where('email', '=', $request->email)->first();

        if(empty($user)){
            return response()->json(['errors' => "E-mail não encontrado"], 422);
        }

        $password = randomString(8);

        $user->password = Hash::make($password);

        $user->update();

        Mail::to($user->email)->send(new SendMailEsqueceuSenha($password));

        return response()->json([
            'titulo' => "Sucesso!",
            'mensagem' => "Sua nova senha foi enviada para o seu e-mail",
            'tipo' => "success",
            'senha' => $password
        ], 200);

    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.login');
    }
}
