<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class ImportProducts extends Controller
{
    function __construct()
    {
        $this->middleware('permission:ver-producto|crear-producto|editar-producto|borrar-producto',['only'=>['index']]);
        $this->middleware('permission:crear-producto', ['only'=>['create','store']]);
        $this->middleware('permission:editar-producto', ['only'=>['edit','update']]);
        $this->middleware('permission:borrar-producto', ['only'=>['destroy']]);
    }
    
    public function index(){
        return view('products.import');
    }

    public function store(Request $request){
        $file = $request->file('file');
        Excel::import(new ProductsImport, $file);

        return back()->withStatus('Archivo excel importado correctamente');
    }
}
