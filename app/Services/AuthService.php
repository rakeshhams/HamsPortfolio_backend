<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Traits\HelperTrait;


class AuthService
{
    use HelperTrait;
    public function register($request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|max:255',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse([], $validator->errors()->first(), false, 422);
        }

        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'company' => $request->company,
                'user_type' => 'user',
                'is_active' => 0,
                'password' => Hash::make($request->password),
            ]);

            $response = [
                'name' => $user->name,
                'email' => $user->email,
                'company' => $user->company, // 'company' => $user->company ?? '
                'phone' => $user->phone,
                'user_type' => $user->user_type,
                'token' => $user->createToken('auth_token')->plainTextToken,
            ];

            return $this->apiResponse($response, 'User registered successfully.', true, 201);
        } catch (\Throwable $th) {
            return $this->apiResponse('Something went wrong.', $th->getMessage(), false, 500);
        }
    }

    public function login($request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6|max:255',
            ]);

            if ($validator->fails()) {
                return $this->apiResponse([], $validator->errors()->first(), false, 422);
            }

            $user = User::where('email', $request->email)->first();

            if (!$user || !Hash::check($request->password, $user->password)) {
                return $this->apiResponse([], 'The provided credentials are incorrect.', false, 401);
            }

            if ($user->user_type != 'admin') {
                return $this->apiResponse([], 'You are not authorized to login.', false, 401);
            }

            $response = [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'company' => $user->company, // 'company' => $user->company ??
                'user_type' => $user->user_type,
                'token' => $user->createToken('auth_token')->plainTextToken,
            ];

            return $this->apiResponse($response, 'User logged in successfully.', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse('Something went wrong.', $th->getMessage(), false, 500);
        } catch (\Throwable $th) {
            return $this->apiResponse('Something went wrong.', $th->getMessage(), false, 500);
        }
    }
    public function clientLogin($request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|string|min:6|max:255',
            ]);

            if ($validator->fails()) {
                return $this->apiResponse([], $validator->errors()->first(), false, 422);
            }

            $user = User::where('email', $request->email)->first();

            if($user->is_active==0){
            return $this->apiResponse([], 'User is Not Active', false, 401);
            }

            if (!$user || !Hash::check($request->password, $user->password)) {
                return $this->apiResponse([], 'The provided credentials are incorrect.', false, 401);
            }

            $response = [
                'name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
                'company' => $user->company,
                'user_type' => $user->user_type,
                'token' => $user->createToken('auth_token')->plainTextToken,
            ];

            return $this->apiResponse($response, 'User logged in successfully.', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse('Something went wrong.', $th->getMessage(), false, 500);
        } catch (\Throwable $th) {
            return $this->apiResponse('Something went wrong.', $th->getMessage(), false, 500);
        }
    }

    public function passwordChange($request)
    {
        try {
            $user = User::where('id', Auth::user()->id)->first();
            $user->password = Hash::make($request->password);
            $user->save();
            return $this->apiResponse([], 'Password changed successfully.', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse('Something went wrong.', $th->getMessage(), false, 500);
        }
    }

    public function logout($request)
    {
        try {
            return $this->apiResponse([], 'User logged out successfully.', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse('Something went wrong.', $th->getMessage(), false, 500);
        }
    }

    public function userList($request)
    {
        try {
            $user=User::latest()->get();
            return  $this->apiResponse($user, 'all user list', true, 200);
        } catch (\Throwable $th) {
            return $this->apiResponse('Something went wrong.', $th->getMessage(), false, 500);
        }

    }

    public function approval ($request)
    {
     try {
        $user=User::findOrFail($request->id);
        $user->update([
           
                'is_active' => $request->is_active, 
        ]);

        return  $this->apiResponse([], 'user approval successful', true, 200);

     } catch (\Throwable $th) {
        return $this->apiResponse('Something went wrong.', $th->getMessage(), false, 500);
     }

    }



}
