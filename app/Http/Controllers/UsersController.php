<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\User;
use App\Cabang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

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
        if (Auth::user()->role == 2){
            //sesuai cabang
            $users = User::all()->where('cabang_id', '=', (Auth::user()->cabang_id));
        }
        else{
            $users = User::all();
            //dd($users);
        }
        return view('user.index', compact('users'));
    }
    public function cetak_pdf()
    {
        if (Auth::user()->role == 2){
            $users = User::all()->where('cabang_id', '=', (Auth::user()->cabang_id))->sortBy('name');

            $pdf = PDF::loadview('user.pdf_user',['users'=>$users]);
            return $pdf->stream('Employees-Data.pdf');
        }
        else{
            $users = User::all()->sortBy('name');

            $pdf = PDF::loadview('user.pdf_user',['users'=>$users]);
            return $pdf->stream('Users Data for ADMIN.pdf');
        }
    }

    public function user_excel()
	{
        if (Auth::user()->role == 2){
            return Excel::download(new UsersExport, 'Employees-Data.xlsx');
        }
        else{
            return Excel::download(new UsersExport, 'Users-Data(ADMIN).xlsx');
        }
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

        $findUser = User::where(function ($q) use($request) {
            $q->where('username', $request->get('username'))
            ->orWhere('email', $request->get('email'));
        })->where('deleted_at', null)->first();

        if($findUser){
            return redirect()->back()
            ->with('errors','Username or email already exist');
        }

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
        if (Auth::user()->role == 1){
            return redirect('/users')
                ->with('success', 'Data updated successfully');
        }
        else{
            return view('user.detail', compact('user'))
                ->with('success', 'Your data updated successfully');
        }
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
