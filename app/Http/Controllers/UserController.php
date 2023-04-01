<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Companies;
use App\Models\UserCompanies;
use App\Models\Role;
use Illuminate\Http\Request;
use DataTables;
use Mail;
use App\Mail\SendCreds;
use App\Mail\SendPass;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(){
        $this->middleware(['auth', 'role:admin']); 
    }
    public function users(){
        $data =  User::with("roles","companies")->whereHas("roles", function($q) {
            $q->whereIn("name", ["company"]);
        })->get();
        return view("pages.users.index");        
    }

    public function usersGet(){
        $data =  User::with("roles",'companies')->whereHas("roles", function($q) {
            $q->whereIn("name", ["company"]);
        })->get();
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('companies', function($row){
                $o = "";
                foreach($row->companies as $company){
                    $o .= $company->name . ", ";
                }
                return $o;
            })
            ->addColumn('action', function($row){
                $btn = '<ul class="action">
                <li class="edit"> <a href="'.route("userEdit",$row->id).'"><i class="icon-pencil-alt"></i></a></li>
                <li class="delete"><a href="#"><i class="icon-trash"></i></a></li></ul>';
                return $btn;
            })
            
            ->rawColumns(['action'])
            ->make(true);
    }

    public function userStore(Request $request){
        if($request->has("user_id")){
            $user = User::find($request->user_id);
        }else{
            $user = new User;
        }
        if($request->has("password")){
            if($request->password != ""){
                $pass = \Hash::make($request->password);
                $user->password = $pass;
                if($request->has("user_id")){
                    $data = array("email" => $user->email, "name" => $user->name, "pass" => $request->password);
                    \Mail::to('nikolaranisavljev@gmail.com')->send(new SendCreds($data));
                }
            }
        }
        $user->name  = $request->name;
        $user->email = $request->email;
        
        if($user->save()){
            if(!$request->has("user_id")){
                $data = array("email" => $user->email, "name" => $user->name, "pass" => $request->password);
                \Mail::to('nikolaranisavljev@gmail.com')->send(new SendCreds($data));
            }
            if($request->has("companies")){
                $array = array();
                foreach($request->companies as $index => $company){
                    $array[$index]['user_id']    = $user->id;
                    $array[$index]['company_id'] = $company;
                }
                UserCompanies::where("user_id",$user->id)->delete();
                UserCompanies::insert($array);
            }
            $user->assignRole('company');
            return redirect()->route("userEdit",$user->id)
            ->with('success','Proizvod uspesno sacuvan.');
        }else{
            return redirect()->back()
            ->with('error','Greska');
        }
    }
public function userAdd(){
    $companies = Companies::all(); 
    return view("pages.users.add",compact("companies"));        
}
    public function userEdit($id){
        $user      = User::find($id);
        $companies = Companies::all(); 
        return view("pages.users.edit",compact("user","companies"));        
    }

}
