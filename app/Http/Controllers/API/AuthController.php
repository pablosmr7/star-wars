<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\User;
Use Log;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthController extends Controller
{
/////////////////////////////////////////////////////////////////////////////////////////
////////////////////ESTOS METODOS DEVUELVEN JSONS DE NUESTRA BD//////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

    //MANDA UN JSON DE LOS PILOTOS ASOCIADOS AL ID DE UNA NAVE
    public function login(Request $request){
      error_log('login');

      $data['email'] = $request['email'];
      $data['password'] = $request['password'];

      error_log(print_r($data,true));

      $user = User::where($data)->first();

      error_log(print_r($user,true));

      if($user){
        $key = 'BaMh7xQb';
        $jwt = JWT::encode($user, $key, 'HS256');
      //$decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        $token=['token'=>$jwt];

        error_log($jwt);

        return response()->json($token, 200);

      }else{
        error_log('mistake');

        $error=['error'=>'usuario no autorizado'];
        return response()->json($error, 401);
      }
    }



    
}
