<?php

namespace App\Exports;
use Illuminate\Support\Facades\Auth;
use App\Cabang;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CabangExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('cabangs.excel_cabang', [
            'cabangs' => Cabang::all()
        ]);
    }
}
