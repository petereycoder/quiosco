<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegistroRequest;

class AuthController extends Controller
{
    //
    public function register(RegistroRequest $request){
        //Validar el registro
        $data = $request->validated();

        //Crear el usuario
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        //Retornar una respuesta
        return [
            'token' => $user->createToken('token')->plainTextToken,
            'user' => $user
        ];
    }

    public function login(LoginRequest $request){
       $data = $request->validated();
       //revisar el password
       if(!Auth::attempt($data)){
        return response([
            'errors' =>  ['sinfiltro' => ['sinfiltro El email o el password son incorrectos']]
        ], 422);
       }
    }

    public function logout(Request $request){
        
    }
}
