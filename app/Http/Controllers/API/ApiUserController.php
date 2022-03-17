<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Validator;

class ApiUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
            'no_hp' => 'required',
            'address' => 'required',
            'role' => 'required',
            'password' => 'required'
        ]);

        if($validator->fails()){
            return response([
                'code' => 400,
                'message' => 'Error',
                'data' => 'Missed some required parameters'
            ]);
        }
        
        $data = $request->except(['_token', '_method', 'cabang_id']);
        
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
        
        $data['password'] = bcrypt($request->get('password'));
        // dd($data);

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
            'code' => 201,
            'message' => 'Success',
            'data' => $data
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
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

        $input = $request->all();
        $validator = Validator::make($input, [
            'username' => 'required',
            'email' => 'required',
        ]);

        if($validator->fails()){
            return response([
                'code' => 400,
                'message' => 'Error',
                'data' => 'Missed some required parameters'
            ]);
        }

        $data = $input;

        if($request->get('password')!=''){
            $data['password'] = bcrypt($request->get('password'));
        }

        // dd($data);

        $user->update($data);

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
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
            $user->delete();
            return response([
                'code' => 200,
                'message' => 'Success',
                'data' => $data
            ]);
        }
    }
}
