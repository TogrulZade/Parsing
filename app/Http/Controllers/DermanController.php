<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DermanExport;

class DermanController extends Controller
{
    public function export()
    {
        return Excel::download(new DermanExport, 'dermanlar.xlsx');
    }
}
