<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Cabang;
use Illuminate\Http\Request;

class ApiCabangController extends Controller
{
    public $successStatus = 200;
    public $failedStatus = 401;

    public function cabang(Request $request)
    {
        $cabangs = Cabang::all();
        $data = [];
        foreach($cabangs as $cabang)
        {
            $data[] = [
                'Id' => $cabang->id,
                'Nama Cabang' => $cabang->nama_cabang
            ];
        }
        return response([
            'code' => $this->successStatus,
            'message' => 'Success',
            'data' => $data
        ]);
    }
    public function create_cabang(Request $request)
    {
        $request->validate([
            'nama_cabang' => 'required'
        ]);

        $data = $request->except(['_token', '_method']);
        //dd($data);

        Cabang::create($data);
        $data = [
            'Nama Cabang' => $request->get('nama_cabang')
        ];

        // return redirect('/users')
        //     ->with('success','Employee data saved');
        return response([
            'code' => $this->successStatus,
            'message' => 'Success',
            'data' => $data
        ]);
    }

    public function update_cabang(Request $request, Cabang $cabang)
    {
        $request->validate([
            'id' => 'required',
            'nama_cabang' => 'required',
        ]);

        $data = $request->except(['_token', '_method']);
        //dd($data);

        $cabang = Cabang::find($request->get('id'));

        if($cabang){
            $cabang->update($data);
            $data = [
                'Nama Cabang' => $request->get('nama_cabang')
            ];

            return response([
                'code' => $this->successStatus,
                'message' => 'Success',
                'data' => $data
            ]);
        }else {
            return response([
                'code' => $this->failedStatus,
                'success' => false,
                'message' => 'Id tidak ditemukan!',
            ]);
        }
    }
    public function delete_cabang(Request $request)
    {
        $request->validate([
            'id' => 'required'
        ]);

        $data = $request->except(['_token', '_method']);

        $cabang = Cabang::find($request->get('id'));

        if($cabang){
            Cabang::destroy($request->get('id'));
            $data = [
                'Id Cabang' => $request->get('id'),
            ];

            return response([
                'code' => $this->successStatus,
                'message' => 'Data deleted successfully',
                'data' => $data
            ]);
        }else {
            return response([
                'code' => $this->failedStatus,
                'success' => false,
                'message' => 'Id tidak ditemukan!',
            ]);
        }
    }

}
