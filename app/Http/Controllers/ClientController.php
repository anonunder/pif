<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use Auth;
use DataTables;

class ClientController extends Controller
{
    public function __construct(){
        $this->middleware(['auth', 'role:company']); 
    }

    public function clientProductsGet(){
        $userCompanies = Auth::user()->companies;
        $ids           = $userCompanies->pluck("id")->toArray();
        $data          = Products::select("id","name","version","category","company_id","created_at")->where('status',1)->whereIn("company_id",$ids)->with("company")->get();

        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<ul class="action"><li class="viewer me-1"><a href="'.route("productView",$row->id).'">'.__("main.view_pif").'</a></li></ul>';
                return $btn;
            })
            ->editColumn('company', function($row){
                return $row->company->name;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function productView($id){
        $product = Products::find($id);
        return view("pages.client.product",compact('product'));
    }



    
}
