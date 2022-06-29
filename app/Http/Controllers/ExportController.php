<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class ExportController extends Controller
{
    public function __construct(){
        $this->middleware(['auth','admin']);
    }
    
    public function export(){
        return Excel::download(new UsersExport, 'results.xlsx');
    }

}
