<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Traits\Auth as authTraits;
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
                $token = $user->createToken('web-token')->plainTextToken;
                $user->update(['logined_at' => now()]);
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
                        'origin' => $request->origin ? $request->origin : '',
                        'loginedAt' => $user->logined_at->format('d/m/Y'),
                        'createdAt' => $user->created_at->format('d/m/Y'),
                        'updatedAt' => $user->updated_at->format('d/m/Y'),
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
            'telp' => 'required|numeric|unique:users,telp',
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
                'password' => bcrypt($request->telp),
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
                    'pinToken' => $user->pin_token,
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
    public function profile(Request $request)
    {   
        
        $user = $request->user();
        return response()->json([
            'meta' => ['status' => 'success','statusCode' => 200,'message' => 'Berhasil melakukan get data profile'],
            'data' => [
                'name' => $user->name,
                'telp' => $user->telp,
                'email' => $user->email,
                'birthDate' => $user->birth_date ? $user->birth_date : '',
                'origin' => $request->origin ? $request->origin : '',
                'createdAt' => $request->created_at ? $request->created_at : '',
            ]
        ]);
    }
    public function bearerValidation(Request $request)
    {
        $user = auth()->user();
        $first_date = strtotime($user->logined_at);
        $second_date = strtotime(now());
        $offset = $second_date - $first_date; 
        $date_diff = floor($offset/60/60/24);
        if($date_diff >= 0){
           return response()->json([
                'meta' => ['status' => 'success','statusCode' => 200,'message' => 'Berhasil melakukan validasi'],
                'data' => [
                    'name' => $user->name,
                    'telp' => $user->telp,
                    'email' => $user->email,
                    'birthDate' => $user->birth_date ? $user->birth_date : '',
                    'origin' => $request->origin ? $request->origin : '',
                    'loginedAt' => date('d/m/Y', strtotime($user->logined_at)),
                    'createdAt' => $user->created_at->format('d/m/Y'),
                    'updatedAt' => $user->updated_at->format('d/m/Y'),
                ]
           ]);
        } else {
            $request->user()->tokens()->where('id', $request->user()->currentAccessToken()->id)->delete();
            return response()->json([
                'meta' => ['status' => 'error','statusCode' => 500,'message' => 'Gagal validasi data'],
                'data' => (object)[]
           ]);
        }
    }
}
