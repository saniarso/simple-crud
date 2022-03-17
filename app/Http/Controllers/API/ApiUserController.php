<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class ApiUserController extends Controller
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
            'code' => 200,
            'message' => 'Success',
            'data' => $data
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

    public function create(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'username'=>'required',
            'email'=>'required',
            'password' => 'required',
            'no_hp'=>'required',
            'address'=>'required',
            'role'=>'required'
        ]);

        $data = $request->except(['_token', '_method','cabang_id']);

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

        if($request->get('cabang_id')!=''){
            $data['cabang_id'] = $request->get('cabang_id');
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
            'Role' => $request->get('role'),
        ];

        // return redirect('/users')
        //     ->with('success','Employee data saved');
        return response([
            'code' => 200,
            'message' => 'Success',
            'data' => $data
        ]);
    }

    public function details($id)
    {
        $user = auth()->user()->find($id);
        
        if (!$user)
        {
            return response([
                'code' => 404,
                'message' => 'Error',
                'data' => 'User not found'
            ]);
        }
        else
        {
            $data = [
                'ID' => $user->id,
                'Name' => $user->name,
                'E-Mail Address' => $user->email,
                'Username' => $user->username,
                'Phone Number' => $user->no_hp,
                'Address' => $user->address,
                'Cabang_ID' => $user->cabang_id,
                'Role' => $user->role,
            ];
            return response([
                'code' => 200,
                'message' => 'Success',
                'data' => $data
            ]);
        }
    }

    public function index()
    {
        $users = User::all();
        $data = [];
        foreach($users as $user)
        {
            $data[] = [
                'ID' => $user->id,
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
            'code' => 200,
            'message' => 'Success',
            'data' => $data
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'no_hp'=>'required',
            'address'=>'required',
        ]);

        $data = $request->except(['_token', '_method','password','role','cabang_id']);

        if($request->get('cabang_id')!=''){
            $data['cabang_id'] = $request->get('cabang_id');
        }

        if($request->get('password')!=''){
            $data['password'] = bcrypt($request->get('password'));
        }

        if($request->get('role')!=''){
            $data['role'] = $request->get('role');
        }

        $user = User::find($request->get('id'));

        if($user){
            $user->update($data);
            $data = [
                'ID' => $request->get('id'),
                'Name' => $request->get('name'),
                'Username'=>$user->username,
                'E-mail Adress'=>$user->email,
                'Phone Number' => $request->get('no_hp'),
                'Address' => $request->get('address'),
                'ID Cabang' => $request->get('cabang_id'),
                'Role' => $request->get('role'),
            ];
            // dd($data);

            return response([
                'code' => 200,
                'message' => 'Success',
                'data' => $data
            ]);
        }else {
            return response([
                'code' => 404,
                'message' => 'Error',
                'message' => 'ID tidak ditemukan!',
            ]);
        }
    }
    
    public function delete(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $data = $request->except(['_token', '_method']);

        $user = User::find($request->get('id'));

        if($user){
            User::destroy($request->get('id'));
            $data = [
                'ID' => $request->get('id'),
                'Name' => $user->name,
                'E-Mail Address' => $user->email,
                'Username' => $user->username,
                'Phone Number' => $user->no_hp,
                'Address' => $user->address,
                'Cabang_ID' => $user->cabang_id,
                'Role' => $user->role,
            ];

            return response([
                'code' => 200,
                'message' => 'Success',
                'data' => $data
            ]);
        }else {
            return response([
                'code' => 404,
                'message' => 'Error',
                'data' => 'ID tidak ditemukan'
            ]);
        }
    }
}
