<?php

namespace App\Exports;

use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        if (Auth::user()->role == 2){
            return view('user.excel_user', [
                'users' => User::select('cabang_id', 'name', 'email', 'no_hp', 'address')->where('cabang_id', '=', (Auth::user()->cabang_id))->get()->sortBy('name')
            ]);
        }
        else{
            return view('user.excel_user', [
                'users' => User::select('name', 'email', 'no_hp', 'address', 'username', 'cabang_id', 'role')->get()->sortBy('name')
            ]);
        }
    }
}
