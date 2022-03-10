<?php

namespace App\Exports;
use Illuminate\Support\Facades\Auth;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if (Auth::user()->role == 2){
            return User::select('cabang_id', 'name', 'email', 'no_hp', 'address')->where('cabang_id', '=', (Auth::user()->cabang_id))->get()->sortBy('name');
        }
        else{
            return User::select('name', 'email', 'no_hp', 'address', 'username', 'cabang_id', 'role')->get()->sortBy('name');
        }
    }
    public function headings(): array
    {
        if (Auth::user()->role == 2){
            return [
                'Cabang',
                'Name',
                'Email',
                'No. HP',
                'Address'
            ];
        }
        else{
            return [
                'Name',
                'Email',
                'No. HP',
                'Address',
                'Username',
                'Cabang',
                'Role'
            ];
        }
    }
}
