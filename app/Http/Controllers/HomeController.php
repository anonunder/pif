<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Models\Ingredients;
use App\Models\Chapters;
use File;
use Auth;
use Session;
use DataTables;

class HomeController extends Controller{
    
    protected $locale;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->locale = session()->get('locale');
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function setLocale(Request $request){
        \App::setLocale($request->lang);
        $locale = session()->put('locale',$request->lang);
    }
     public function chapters(){
        return view("pages.chapters.index");
     }
     public function chapterSave(Request $request){
   
        $request->validate([
            'chapter_id'  => 'required',
        ]);
        if($request->has("language")){
            $lang = $request->language;
        }else{
            $lang = "sr";
        }
        $t_name  = "name_".$lang;
        $t_con   = "content_".$lang;
        $id      = $request->chapter_id;
        $name    = $request->chapter_name;
        $content = json_encode($request->chapter_content);

        $chapter = Chapters::find($id);
        $chapter->$t_name    = $name;
        $chapter->$t_con     = $content;
        $chapter->save();
     }

     public function chapterGet(Request $request){
        $chapter = Chapters::where("id",$request->id)->first();
        $array = array();
        // $array['chapter'] = $chapter;
        $name    = "name_".$this->locale;
        $content = "content_".$this->locale;
        $array['name'] = $chapter->$name;
        if($chapter->$content == null){
            $array['content'] = "";
        }else{
            $array['content'] = $chapter->$content;
        }
        return $chapter;
     }

     public function chaptersGet(){
        $locale = session()->get('locale');
        $this->locale = $locale;
        $data = Chapters::select("order_number","name_".$this->locale,"id")->orderBy("order_number")->get();
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<ul class="action"><li class="edit" data_id="'.$row->id.'"> <a href="#" ><i class="icon-pencil-alt"></i></a></li></ul>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
     }

     public function chapterRowUpdate(Request $request){
        if($request->ajax()){
            if($request->data){
                $data = json_decode($request->data);
                $update = array();
                foreach($data as $index => $order){
                    $old = $order->old_position + 1;
                    $new = $order->new_position + 1;
                    $ch = Chapters::where("order_number",$old)->first();
                    $update[$index]["id"]           = $ch->id;
                    $update[$index]["order_number"] = $new;
                }
                foreach($update as $u){
                    $chapter = Chapters::find($u['id']);
                    $chapter->order_number = $u['order_number'];
                    $chapter->save();
                }
            }
        }
     }
     public function test(){
        
        return view('test');
        // $chapters = Chapters::all();
        // $array = array();
        // foreach($chapters as $index => $chapter){
            // $chapter->save();
        // }

     }
     protected function PDFR(){
        $ingredients = Ingredients::all();
        $html = view("pdf.dompdf", compact('ingredients'))->render();
        $dompdf = new Dompdf();
        $dompdf->set_option('isPhpEnabled', true);
        $dompdf->loadHtml($html);
        $dompdf->render();
        $dompdf->stream('document.pdf', array("Attachment" => false));
    }

    public function index(){
        return view("home");
    }
    public function help(){
        return view("help");
    }
    
}
