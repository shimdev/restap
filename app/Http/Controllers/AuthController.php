<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
    	$valid = Validator::make($request->all(), [
    		'full_name'		=> 'required',
    		'user_name'		=> 'required',
    		'password'		=> 'required|confirmed|min:6',
    	]);

    	if ($valid->fails()) {
    		$errors = $valid->errors();

    		return response()->json([
    			'status'	=> false,
    			'message'	=> $errors,
    			'data'		=> null
    		], 400);
    	}

    	$result = User::create([
    		'user_name'		=> $request->input('user_name'),
    		'full_name'		=> $request->input('full_name'),
    		'password'		=> Hash::make($request->input('password'))
    	]);

    	if ($result) {
    		return response()->json([
    			'status'	=> true,
    			'message'	=> 'Success',
    			'data'		=> $result
    		], 201);
    	} else {
    		return response()->json([
    			'status'	=> false,
    			'message'	=> 'Failed',
    			'data'		=> null
    		], 400);
    	}
    }

    public function login(Request $request)
    {
    	$valid = Validator::make($request->all(), [
    		'user_name'		=> 'required',
    		'password'		=> 'required',
    	]);

    	if ($valid->fails()) {
    		$errors = $valid->errors();

    		return response()->json([
    			'status'	=> false,
    			'message'	=> $errors,
    			'data'		=> null
    		], 400);
    	}

    	$user = User::where('user_name', $request->input('user_name'))->orWhere('role', '!=', 1)->first();

        if (!empty($user)) {
            if (Hash::check($request->input('password'), $user->password)) {
                $result = $user->update([
                    'remember_token' => Str::random(60)
                ]);

                if ($result) {
                    return response()->json([
                        'status'    => true,
                        'message'   => 'Success',
                        'data'      => $result
                    ], 201);
                } else {
                    return response()->json([
                        'status'    => false,
                        'message'   => 'Failed',
                        'data'      => null
                    ], 400);
                }            
            } else {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Oops, wrong password',
                    'data'      => null
                ], 400);
            }
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Oops, there is something wrong',
                'data'      => null
            ], 404);
        }
    }


    public function logout($id) 
    {
        $user = User::find($id);

        if (empty($user)) {
            return response()->json([
                'status'    => false,
                'message'   => 'Oops',
                'data'      => null
            ], 404);
        }

        if (!empty($user->remember_token)) {
            $result = $user->update([
                'remember_token' => null
            ]);

            if ($result) {
                return response()->json([
                    'status'    => true,
                    'message'   => 'Success',
                    'data'      => $result
                ], 201);
            } else {
                return response()->json([
                    'status'    => false,
                    'message'   => 'Failed',
                    'data'      => null
                ], 400);
            }      
        } else {
            return response()->json([
                'status'    => false,
                'message'   => 'Oops, Token',
                'data'      => null
            ], 404);
        }
    }
}
