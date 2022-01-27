<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\RoutingImport;
use App\Exports\RoutingExport;
use App\Models\RoutingModel;
use Maatwebsite\Excel\Facades\Excel;

use Session;

class RoutingController extends Controller
{
    public function index()
    {
        $routings = RoutingModel::all();
		return view('master-routings',['routings'=>$routings]);
    }
   
    public function import(Request $request) 
    {
		$this->validate($request, [
			'file' => 'required|mimes:csv,xls,xlsx'
		]);
 
		$file = $request->file('file');
 
		$nama_file = rand().$file->getClientOriginalName();
 
		$file->move('file_export',$nama_file);
 
		Excel::import(new RoutingImport, public_path('/file_export/'.$nama_file));
 
		Session::flash('sukses','Data Berhasil Diimport!');
 
		return redirect('/routings');
    }

    public function export() 
    {
        return Excel::download(new RoutingExport, 'routing.xlsx');
    }
}
