<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cabang;
use Illuminate\Support\Facades\Validator;

class ApiCabangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cabangs = Cabang::all();

        $data = [];
        
        foreach($cabangs as $cabang)
        {
            $data[$cabang->id] = [
                // 'ID' => $cabang->id,
                'NamaCabang' => $cabang->nama_cabang
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
            'nama_cabang' => 'required',
        ]);

        if($validator->fails()){
            return response([
                'code' => 400,
                'message' => 'Error',
                'data' => 'Missed some required parameters'
            ]);
        }
        
        $data = $request->except(['_token', '_method']);
        // dd($data);

        Cabang::create($data);
        $data = [
            'Nama Cabang' => $request->get('nama_cabang'),
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
        $cabang = Cabang::find($id);

        if(!$cabang)
        {
            return response([
                'code' => 404,
                'message' => 'Error',
                'data' => 'Data not found'
            ]);
        }

        $data = [
            'ID' => $cabang->id,
            'Nama Cabang' => $cabang->nama_cabang
        ];
        return response([
            'code' => 200,
            'message' => 'Success',
            'data' => $data
        ]);
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
        $cabang = Cabang::find($id);

        if (!$cabang)
        {
            return response([
                'code' => 404,
                'message' => 'Error',
                'data' => 'DAta not found'
            ]);
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'nama_cabang' => 'required',
        ]);

        if($validator->fails()){
            return response([
                'code' => 400,
                'message' => 'Error',
                'data' => 'Missed some required parameters'
            ]);
        }

        $data = $input;

        // dd($data);

        $cabang->update($data);

        $data = [
            'Nama Cabang' => $cabang->nama_cabang,
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
        $cabang = Cabang::find($id);
        
        if (!$cabang)
        {
            return response([
                'code' => 404,
                'message' => 'Error',
                'data' => 'Data not found'
            ]);
        }

        $data = [
            'ID' => $cabang->id,
            'Name' => $cabang->nama_cabang,
        ];

        $cabang->delete();

        return response([
            'code' => 200,
            'message' => 'Success',
            'data' => $data
        ]);
    }
}
