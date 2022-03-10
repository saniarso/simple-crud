<?php

namespace App\Exports;
use Illuminate\Support\Facades\Auth;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if (Auth::user()->role == 2){
            return User::select('name', 'email', 'no_hp', 'address')->where('role', '=', '2')->get()->sortBy('name');
        }
        else{
            return User::select('name', 'email', 'no_hp', 'address', 'username','role')->get()->sortBy('name');
        }
    }
}
