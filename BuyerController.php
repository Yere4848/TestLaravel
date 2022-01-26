<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\BuyerModel;
use DataTables;
use PDF;


class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        if($request->ajax()){
            $data = BuyerModel::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
   
                        $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->buyerID.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editBuyer">Edit</a>';
   
                        $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->buyerID.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteBuyer">Delete</a>';
    
                        return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('master-buyers');
    }

    public function store(Request $request)
    {
        $data = BuyerModel::where('buyerID', $request->buyerID)->first();
        $id = $request->buyerID;
        if ($data !== null) {
            $data = BuyerModel::where('buyerID', $id)->update(['buyerName' => $request->buyerName]);
        } else {
            $data = BuyerModel::create([
                'buyerID' => $request->buyerID,
                'buyerName' => $request->buyerName,
            ]);
        }

        // return response()->json($data1);
        return response()->json(['success'=>'Buyer saved successfully.']);
    }

    public function edit($id)
    {
        //$buyer = DB::table('buyers')->where('buyerID', $id)->first();
        $buyer = BuyerModel::where('buyerID', $id)->first();
        return response()->json($buyer);
    }

    public function destroy($id)
    {
        //DB::table('buyers')->where('buyerID', $id)->delete();
        BuyerModel::where('buyerID', $id)->delete();
        return response()->json(['success'=>'Buyer deleted successfully.']);
    }
}