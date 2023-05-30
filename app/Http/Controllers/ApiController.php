<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCredentials;
use App\Models\Userdata;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function users (Request $request) {
        if ($request-> has('active')) {
            $users = Userdata::where('active', true)->get();
        } else {
            $users = Userdata::all();
        }
        return response()->json($users);
    }





    public function login (Request $request) {
        $response = ['status' => 0, 'msg' => ''];
        $data = json_decode($request->getContent());

        if (empty($data->cedula) || empty($data->password)) {
            $response['msg'] = 'Email and password are required';
            return response()->json($response);
        } 

        $user = UserCredentials::where('cedula', $data->cedula)->first();

        if (!$user) {
            $response['msg'] = 'User not found';
            return response()->json($response);
        }

        if (!Hash::check($data->password, $user->password)) {
            $response['msg'] = 'Password is incorrect';
            return response()->json($response);
        } 

        $token = $user->createToken('auth_token')->plainTextToken;
        $response['token'] = $token;
        $response['status'] = 1;
        return response()->json($response);
    }

    public function register (Request $request) {
        $response = ['status' => 0, 'msg' => ''];
        $data = json_decode($request->getContent());
        $dataArray = get_object_vars($data);
        ["cedula" => $cedula, "nombre" => $nombre, "email" => $email, "password" => $password, "celular" => $celular, "direccion" => $direccion, "fecha_nacimiento" => $fecha_nacimiento, "user_type" => $user_type ] = $dataArray;

        $faltan = [];
        
        foreach ($dataArray as $propiedad => $valor) {
            if (!isset($valor) || $valor === "") {
                $faltan[] = $propiedad;
            }
        }

        if (count($faltan) > 0) {
            $response['msg'] = 'Faltan datos: ' . implode(', ', $faltan);
            return response()->json($response);
        }

        $user = UserCredentials::where('cedula', $data->cedula)->first();
        if ($user) {
            $response['msg'] = 'User already exists';
            return response()->json($response);
        }

        
        
        $user = UserCredentials::create([
            'cedula' => $cedula,
            'password' => Hash::make($password),
            'active' => true,
        ]);
        $token = $user->createToken('auth_token')->plainTextToken;

        $userdata = Userdata::create([
            'cedula' => $cedula,
            'name' => $nombre,
            'email' => $email,
            'celular' => $celular,
            'fecha_nacimiento' => $fecha_nacimiento,
            'user_type' => $user_type,
            'direccion' => $direccion,
        ]);

        $response['status'] = 1;
        $response['msg'] = 'User created successfully';
        $response['token'] = $token;
        return response()->json($response);
    }


}
