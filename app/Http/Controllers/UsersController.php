<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\User;
use App\Cabang;
use Illuminate\Http\Request;

use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;
use App\Exports\AdminExport;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $users = User::all();
        //dd($users);
        return view('user.index', compact('users'));
    }

    public function cetak_pdf()
    {
    	$users = User::all()->sortBy('name');

    	$pdf = PDF::loadview('user.cetak_pdf',['users'=>$users]);
    	return $pdf->stream('laporan-user-pdf');
    }

    public function user_excel()
	{
		return Excel::download(new UsersExport, 'Employees.xlsx');
	}

    public function admin_excel()
	{
		return Excel::download(new AdminExport, 'Users.xlsx');
	}
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cabangs = Cabang::all();
        return view('user.create', compact('cabangs'));
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
            'name'=>'required',
            'username'=>'required',
            'email'=>'required',
            'no_hp'=>'required',
            'address'=>'required',
            'role' => 'required'
        ]);

        $data = $request->except(['_token', '_method']);

        if($request->get('password')!=''){
            $data['password'] = bcrypt($request->get('password'));
        }

        // dd($data);
        // User::create($request->all());
        User::create($data);

        return redirect('/users')
            ->with('success','Employee data saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.detail', compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $cabangs = Cabang::all();
        return view('user.edit', compact('user', 'cabangs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required',
            'username'=>'required',
            'email'=>'required',
            'no_hp'=>'required',
            'address'=>'required'
        ]);

        $data = $request->except(['_token', '_method', 'password', 'role']);

        if($request->get('password')!=''){
            $data['password'] = bcrypt($request->get('password'));
        }

        if($request->get('role')!=''){
            $data['role'] = $request->get('role');
        }

        $user->update($data);

        return view('user.detail', compact('user'))
            ->with('success', 'Data updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        $user = User::find($id);

        return view('user.delete', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Data deleted successfully');
    }
}
