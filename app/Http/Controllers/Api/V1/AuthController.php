<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\auth as authTraits;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use authTraits;

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'tokenPin' => 'required|numeric',
            'origin' => 'sometimes'
        ]);
        if($validator->fails()){
            return response()->json([
                'meta' => ['status' => 'error','statusCode' => 400],
                'data' => ['status' => false,'errors' => $validator->errors()]
            ],400);
        } else {
            $user = User::where('pin_token',$request->tokenPin)->first();
            if(!$user){
                return response()->json([
                    'meta' => [
                        'status' => 'error',
                        'statusCode' => 500,
                        'statusMessage' => 'Gagal melakukan autentikasi, server mengalami gangguan'
                    ],
                    'data' => (object)[]
                ]);
            } else {
                $user->tokens()->delete();
                $token = $user->createToken('web-token')->plainTextToken ;
                return response()->json([
                    'meta' => [
                        'status' => 'success',
                        'statusCode' => 200,
                        'statusMessage' => 'Berhasil melakukan autentikasi'
                    ],
                    'data' => [
                        'token' => $token,
                        'name' => $user->name,
                        'telp' => $user->telp,
                        'email' => $user->email,
                        'birthDate' => $user->birth_date ? $user->birth_date : '',
                        'origin' => $request->origin ? $request->origin : ''
                    ]
                ]);
            }
        }

    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'telp' => 'required|numeric',
            'birthDate' => 'sometimes',
            'origin' => 'sometimes'
        ]);

        if($validator->fails()){
            return response()->json([
                'meta' => ['status' => 'error','statusCode' => 400],
                'data' => ['status' => false,'errors' => $validator->errors()]
            ],400);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->name),
                'telp' => $request->telp,
                'birth_date' => $request->birthDate,
                'pin_token' => $this->generateTokenPIN()
            ]);
            return response()->json([
                'meta' => [
                    'status' => 'success',
                    'statusCode' => 200,
                    'statusMessage' => 'Berhasil melakukan pendaftaran'
                ],
                'data' => [
                    'name' => $user->name,
                    'telp' => $user->telp,
                    'email' => $user->email,
                    'birhDate' => $user->birth_date,
                    'origin' => $request->origin ? $request->origin : '' 
                ]
            ]);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();
        return response()->json([
            'meta' => ['status' => 'success','statusCode' => 200,'message' => 'Berhasil melakukan logout'],
            'data' => (object)[]
        ]);
    }
}
