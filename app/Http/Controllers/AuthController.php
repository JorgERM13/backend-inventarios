<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $credenciales= $request->validate([
            'email' => 'required|email|min:5|max:200',
            'password' => 'required',
        ]);

        //verificar credenciales
        if(!Auth::attempt($credenciales)){
            return response()->json(["mensaje" => "Credenciales incorrectas"]);
        }

        //crear token
        $token= $request->user()->createToken("Token Auth")->plainTextToken;

        return response()->json(["access_token" => $token,"usuario"=> $request->user()]);
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|same:cpassword',
        ]);

        $user = new User();

            $user->name = $request->name;
            $user->email = $request->email;
            $user->password =$request->password;
            $user->save();

            return response()->json(["mensaje" => "Usuario Registrado"]);
    }

    public function profile(Request $request){
        return response()->json($request->user());
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(["mensaje" => "Sesion cerrada"]);
    }

}
