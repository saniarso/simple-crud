<?php

namespace App\Exports;

use App\Cabang;
use Maatwebsite\Excel\Concerns\FromCollection;

class CabangExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Cabang::select('id', 'nama_cabang')->get()->sortBy('id');
    }
}
