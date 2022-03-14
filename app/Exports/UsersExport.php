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
        if (Auth::user()->role == 1)
        {
            return view('user.excel_user', [
                'users' => User::all()
            ]);
        }
        else
        {
            return view('user.excel_user', [
                'users' => User::all()->where('role', '=', '2')->where('cabang_id', '=', (Auth::user()->cabang_id))
            ]);
        }
    }
}
