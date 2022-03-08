<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cabang;

class CabangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $results['cabangs'] = Cabang::all();

        return view('cabangs.index', $results);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cabangs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_cabang' => 'required'
        ]);

        $data = $request->except(['_token', '_method']);
        //dd($data);

        Cabang::create($data);

        return redirect('/cabang')->with('success', 'Branch data saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('cabangs.detail', ['cabang' => Cabang::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cabang $cabang)
    {
        return view('cabangs.edit', compact('cabang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cabang $cabang)
    {
        $request->validate([
            'nama_cabang' => 'required'
        ]);

        $data = $request->except(['_token', '_method']);
        //dd($data);

        $cabang->update($data);

        return redirect('/cabang')->with('success','Branch data updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $cabang = Cabang::find($id);

        return view('cabangs.delete', compact('cabang'));
    }

    public function destroy(Cabang $cabang)
    {
        $cabang->delete();

        return redirect()->route('users.index')
            ->with('success', 'Data deleted successfully');
    }
}
