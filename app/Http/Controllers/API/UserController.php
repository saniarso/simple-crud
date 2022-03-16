<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $successStatus = 200;

    public function login()
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();

            $tokenresult = $user->createToken('nApp');
            $token = $tokenresult->token;

            $token->save();

            return response([
                'code' => $this->successStatus,
                'message' => 'Success',
                'data' => [
                    'User' => $user,
                    'Token' => $tokenresult->accessToken
                ]
            ]);
        }
        else
        {
            return response()->json(['error'=>'Unauthorised'], 401);
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

        $findUser = User::where(function ($q) use($request) {
            $q->where('username', $request->get('username'))
            ->orWhere('email', $request->get('email'));
        })->where('deleted_at', null)->first();

        if($findUser){
            // return redirect()->back()
            // ->with('error','Username or email already exist');
            return response([
                'code' => 400,
                'message' => 'Username or email already exist'
            ]);
        }

        if($request->get('password')!=''){
            $data['password'] = bcrypt($request->get('password'));
        }

        // dd($data);
        // User::create($request->all());
        User::create($data);
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
            'code' => $this->successStatus,
            'message' => 'Success',
            'data' => $data
        ]);
    }

    public function logout(Request $request)
    {
        //dd('logout');
        $request->user()->token()->revoke();
        return response([
            'code' => $this->successStatus,
            'message' => 'Success',
        ]);
    }

    public function details()
    {
        $user = Auth::user();
        $data = [
            'Name' => $user->name,
            'E-Mail Address' => $user->email,
            'Username' => $user->username,
            'Phone Number' => $user->no_hp,
            'Address' => $user->address,
            'Cabang_ID' => $user->cabang_id,
            'Role' => $user->role,
        ];
        return response([
            'code' => $this->successStatus,
            'message' => 'Success',
            'data' => $data
        ]);
    }

    public function index(Request $request)
    {
        $users = User::all();
        $data = [];
        foreach($users as $user)
        {
            $data[] = [
                'Name' => $user->name,
                'E-Mail Address' => $user->email,
                'Username' => $user->username,
                'Phone Number' => $user->no_hp,
                'Address' => $user->address,
                'Cabang_ID' => $user->cabang_id,
                'Role' => $user->role,
            ];
        }
        return response([
            'code' => $this->successStatus,
            'message' => 'Success',
            'data' => $data
        ]);
    }
}
