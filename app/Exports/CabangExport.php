<?php

namespace App\Exports;
use Illuminate\Support\Facades\Auth;
use App\Cabang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CabangExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        if (Auth::user()->role == 1){
            return Cabang::select('id', 'nama_cabang')->get()->sortBy('id');
        }
        else{
            return Cabang::select('nama_cabang')->get()->sortBy('name');
        }
    }
    public function headings(): array
    {
        if (Auth::user()->role == 1){
            return [
                'Id',
                'Nama Cabang'
            ];
        }
        else{
            return [
                'Nama Cabang'
            ];
        }
    }
}
