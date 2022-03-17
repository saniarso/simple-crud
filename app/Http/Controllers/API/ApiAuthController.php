<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if(auth()->attempt($credentials)){
            $user = auth()->user();

            $data = [
                'Name' => $user->name,
                'E-Mail Address' => $user->email,
                'Username' => $user->username,
                'Phone Number' => $user->no_hp,
                'Address' => $user->address,
                'Cabang_ID' => $user->cabang_id,
                'Role' => $user->role,
            ];

            $tokenresult = $user->createToken('Laravel Passport');
            $token = $tokenresult->token;
            $token->save();

            return response([
                'code' => 200,
                'message' => 'Success',
                'data' => [
                    'User' => $data,
                    'Token' => $tokenresult->accessToken
                ]
            ]);
        }
        else
        {
            return response([
                'code' => 400,
                'message' => 'Success',
                'data' => 'Email or password does not match our credentials'
            ]);
        }
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'username'=>'required',
            'email'=>'required',
            'password' => 'required',
            'no_hp'=>'required',
            'address'=>'required',
            'cabang_id' => 'required',
        ]);

        $data = $request->except(['_token', '_method']);
        $data['role'] = 2;
        $data['password'] = bcrypt($request->get('password'));

        $findUser = User::where(function ($q) use($request) {
            $q->where('username', $request->get('username'))
            ->orWhere('email', $request->get('email'));
        })->where('deleted_at', null)->first();

        if($findUser){
            // return redirect()->back()
            // ->with('error','Username or email already exist');
            return response([
                'code' => 400,
                'message' => 'Error',
                'data' => 'Username or email already exist'
            ]);
        }

        // dd($data);
        // User::create($request->all());
        $user = User::create($data);

        // $tokenresult = $user->createToken('Laravel Passport');
        // $token = $tokenresult->token;
        // $token->save();

        $data = [
            'Name' => $request->get('name'),
            'E-Mail Address' => $request->get('email'),
            'Username' => $request->get('username'),
            'Phone Number' => $request->get('no_hp'),
            'Address' => $request->get('address'),
            'Cabang_ID' => $request->get('cabang_id'),
            'Role' => $data['role'],
        ];

        // return redirect('/users')
        //     ->with('success','Employee data saved');
        return response([
            'code' => 200,
            'message' => 'Success',
            'data' => [
                'User' => $data,
                // 'Token' => $token
            ]
        ]);
    }

    public function logout(Request $request)
    {
        //dd('logout');
        $request->user()->token()->revoke();
        return response([
            'code' => 200,
            'message' => 'Success',
            'data' => 'Successfully Logged Out'
        ]);
    }
}
