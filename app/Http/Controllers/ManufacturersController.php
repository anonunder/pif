<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Manufacturers;
use App\Models\Distributors;
use Illuminate\Http\Request;
use DataTables;

class ManufacturersController extends Controller{



    protected $locale;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->locale = app()->getLocale();
        $this->middleware(['auth', 'role:admin']); 
    }
    // DISTRIBUTORI

    public function distributors(){
        return view("pages.distributors.index");
    
    }
    public function distributorsDelete(Request $request){
        if($request->has("id")){
            $distributors = Distributors::find($request->id)->delete();
        }
    }
    public function distributorGet(Request $request){
        $distributors = Distributors::find($request->id);
        return $distributors;
    }
    public function distributorsGet(){
        $data = Distributors::select("id","name")->get();
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<ul class="action"><li class="edit" data_id="'.$row->id.'"> <a href="#" ><i class="icon-pencil-alt"></i></a></li><li class="delete" data_id="'.$row->id.'"> <a href="#" ><i class="icon-trash"></i></a></li></ul>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function distributorsSave(Request $request){
        if(!empty($request->distributor_id)){
            $distributors = Distributors::find($request->distributor_id);
        }else{
            $distributors = new Distributors;
        }
        if(!$distributors){
            $distributors = new Distributors;
        }
        $distributors->name               = $request->distributor_name;
        if($distributors->save()){
            return response()->json($distributors);
        }
    }
    
    // PROIZVODJACI 
    public function manufacturers(){
        return view("pages.manufacturers.index");

    }
    public function manufacturersDelete(Request $request){
        if($request->has("id")){
            $manufacturers = Manufacturers::find($request->id)->delete();
        }
    }
    public function manufacturerGet(Request $request){
        $manufacturers = Manufacturers::find($request->id);
        return $manufacturers;
    }
    public function manufacturersGet(){
        $data = Manufacturers::select("id","name")->get();
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<ul class="action"><li class="edit" data_id="'.$row->id.'"> <a href="#" ><i class="icon-pencil-alt"></i></a></li><li class="delete" data_id="'.$row->id.'"> <a href="#" ><i class="icon-trash"></i></a></li></ul>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function manufacturersSave(Request $request){
        if(!empty($request->manufacturer_id)){
            $manufacturers = Manufacturers::find($request->manufacturer_id);
        }else{
            $manufacturers = new Manufacturers;
        }
        if(!$manufacturers){
            $manufacturers = new Manufacturers;
        }
        $manufacturers->name               = $request->manufacturer_name;
        if($manufacturers->save()){
            return response()->json($manufacturers);
        }
    }







    // KOMPANIJE
    public function companies(){
        return view("pages.companies.index");
    }
    public function companiesDelete(Request $request){
        if($request->has("id")){
            $company = Companies::find($request->id)->delete();
        }
    }
    public function companyGet(Request $request){
        $company = Companies::find($request->id);
        return $company;
    }

    public function companiesGet(){
        $data = Companies::select("id","name","long_name","pib","address")->get();
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<ul class="action"><li class="edit" data_id="'.$row->id.'"> <a href="#" ><i class="icon-pencil-alt"></i></a></li><li class="delete" data_id="'.$row->id.'"> <a href="#" ><i class="icon-trash"></i></a></li></ul>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function companiesSave(Request $request){
        if(!empty($request->company_id)){
            $company = Companies::find($request->company_id);
        }else{
            $company = new Companies;
        }
        if(!$company){
            $company = new Companies;
        }
        $company->name               = $request->company_name;
        $company->long_name          = $request->company_name .", " . $request->company_address;
        $company->pib                = $request->company_pib;
        $company->address            = $request->company_address;
        $company->id_number          = $request->company_id_number;
        $company->contact_number     = $request->company_contact_phone;
        $company->phone              = $request->company_phone;
        $company->email              = $request->company_email;
        $company->responsible_person = $request->company_responsible_person;
        if($company->save()){
            return response()->json($company);
        }
    }
}
