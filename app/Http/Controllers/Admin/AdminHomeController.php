<?php

namespace App\Http\Controllers\Admin;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class AdminHomeController extends AdminBaseController
{
    public function __construct(PDF $pdf)
    {
        parent::__construct();
    }

    public function index(){
        return view('admin.home.dashboard');
    }

    public function exportPdf(){
        $data = ['name' => 'tienduong'];
        $pdf = PDF::loadView('admin.test',  compact('data'));
        return $pdf->download('test.pdf');
    }
}
