<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Chapters;
use App\Models\Ingredients;
use App\Models\Companies;
use App\Models\Manufacturers;
use App\Models\Mixtures;
use App\Models\Distributors;
use Illuminate\Http\Request;
use \File;
use DataTables;
use \Auth;

class ProductsController extends Controller{

    protected $locale;
    protected $aneksi;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware(['auth', 'role:admin']); 
                
              
        $this->locale = app()->getLocale();
        $this->middleware('auth');
        $this->aneksi = array(
            'msds'=>'MSDS',
            'ifra'=>'IFRA',
            'alergen_lista'=>'Alergen lista',
            'test_stabilnosti'=>'Testovi stabilnosti',
            'gmp'=>'GMP izjava',
            'drugi'=>'Drugi testovi',
            'challenge'=>'Challenge test',
            'animal'=>'Animal testing',
            'proizvodni_tok'=>'Proizvodni tok',
            'test_efikanosti'=>'Testovi efikasnosti',
            'procena_bezbednosti'=>'Akreditivi procenitelja bezbednosti',
            'coa'=>'Sertifikat analize (CoA)',
        );
    }

    public function mixturesIndex(){
        return view("pages.mixtures.index");        
    }
    public function mixturesAddIndex(){
        
        return view("pages.mixtures.add");        
    }
    
    public function mixturesEditIndex($id){
        $mixture       = Mixtures::find($id);
        $distributors  = Distributors::all(); 
        return view("pages.mixtures.edit",compact('mixture','distributors'));        
    }
     
    public function mixturesAll(){
        $data = Mixtures::select("id","trade_name","created_at")->get();
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<ul class="action">
                <li class="edit"> <a href="'.route("mixturesEditIndex",$row->id).'"><i class="icon-pencil-alt"></i></a></li>
                <li class="delete"><a href="#"><i class="icon-trash"></i></a></li></ul>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function productsGet(){
        $data = Products::select("id","name","version","category","company_id","created_at")->with('company')->get();
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<ul class="action"><li class="viewer me-1"><a href="'.route("pdfViewer",$row->id).'" target="_blank"><i class="icofont icofont-eye-alt"></i></a></li><li class="delete me-1 d-inline-block"><a href="'.route("pdfGenerate",$row->id).'" target="_blank"><i class="icofont icofont-file-pdf"></i></a></li><li class="edit"> <a href="'.route("productsEditIndex",$row->id).'"><i class="icon-pencil-alt"></i></a></li><li class="replicate"><a href="'.route("replicate",$row->id).'"><i class="icofont icofont-ui-copy"></i></a></li><li class="delete"><a href="#"><i class="icon-trash"></i></a></li></ul>';
                return $btn;
            })
            ->editColumn('company', function($row){
                return $row->company->name;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
    public function index(){
        return view("pages.products.index");
    }
    
    public function store(Request $request){
        if(isset($request->product_id)){
            $product = Products::find($request->product_id);
        }else{
            $product = new Products;
        }
        if($product->pdf_link != null){
            if(File::delete(public_path($product->pdf_link))){
                $product->pdf_link = null;
            }
        }
        if(empty($request->product_create_date)){
            $date = \Carbon\Carbon::now();
        }else{
            $date = \Carbon\Carbon::parse($request->product_create_date);
        }
        if($request->file('product_image')){
            $fileName = preg_replace('/\s+/', ' ', $request->file->getClientOriginalName()) . "_" . rand(100,10000) . '_' . time() . '.'. $request->file->extension();  
            $request->file('product_image')->move(public_path('file/products/'), $fileName);
            $t = '/file/products/'.$fileName;
            $product->image = $t;
        }
        $product->status     = $request->product_status;
        $product->name       = $request->product_name;
        $product->company_id = $request->product_company;
        $product->created_at = $date;
        $product->formula    = $request->number_formula;
        $product->version    = $request->product_version;
        $product->category   = $request->product_category;
        $product->locale     = $request->product_locale;
        $product->content    = json_encode($request->items);
        $product->aneks      = json_encode($request->aneksi);
        if($product->content != null && $product->content != "null"){
            $product->save();
            return redirect()->route("productsEditIndex",$product->id)
            ->with('success','Proizvod uspesno sacuvan.');
        }
        return redirect()->route("productsEditIndex",$product->id)
            ->with('error','Prevelik zahtev.');
        
        
    }


    public function mixturesGet(Request $request){
        $data = [];
        if($request->filled('q')){
            $data = Mixtures::select("trade_name", "id")
                        ->where('trade_name', 'LIKE', '%'. $request->get('q'). '%')
                        ->get();
        }else{
            $data = Mixtures::select("trade_name", "id")->limit(10)->get();
        }
    
        return response()->json($data);
    }

    public function editIndex($id){
        $aneksi        = $this->aneksi;
        $product       = Products::find($id);
        $locale        = session()->get('locale');
        $name          = "inci_name_".$locale;
        $content       = "content_".$locale;
        $chapters      = Chapters::all();
        $companies     = Companies::all(); 
        $manufacturers = Manufacturers::all(); 
        $distributors  = Distributors::all(); 
        $items         = json_decode($product->content);
        $mixtures      = Mixtures::all();
        if($product->aneks != "null" && !empty($product->aneks) && $product->aneks != null){
            $aneks_u = json_decode($product->aneks);
        }else{
            $aneks_u = false; 
        }
        $ingredients   = Ingredients::select($name,"id",$content)->get();
        return view("pages.products.edit", compact('chapters','companies','ingredients','manufacturers','distributors','product','items','aneks_u','aneksi','mixtures'));        
    }

    public function aneksUpload(Request $request){
        $fileName = str_replace(' ','_', $request->file->getClientOriginalName()) . "_" . rand(100,10000) . '_' . time() . '.'. $request->file->extension();    

        $type = $request->file->getClientMimeType();
        $size = $request->file->getSize();

        $request->file->move(public_path('file'), $fileName);
        $t = '/file/'.$fileName;
        echo $t;
    }

    public function removeFile(Request $request){
        $file    = $request->file;
        $split   = array_values(array_filter(explode("/",$file)));
        $allowed = array("file","specifikacija");
        if(in_array($allowed[0],$split) && in_array($allowed[1],$split)){
            File::delete(public_path($file));
        }
    }

    public function pdfViewer($id){
        $link = route("pdfPreview",$id);
        $product = Products::find($id);
        return view("pages.products.preview", compact("link","product"));
    }

    public function replicate($id){
        $product   = Products::find($id);
        $replicate = $product->replicate();
        $replicate->version = $product->version + 1;
        $replicate->save();
    }

    public function mixtureStore(Request $request){
        
        $mixture_id          = $request->mixture_id;
        $mixture             = Mixtures::find($mixture_id);
        $data['mixture']     = $request->mixture;
        $data['ingredients'] = $request->ingredients;
        if(isset($request->mixture_id)){
            $new = Mixtures::find($request->mixture_id);
        }else{
            $new = new Mixtures;
        }
        
        $json            = json_encode($data);
        $new->trade_name = $request->mixture['trade_name'];
        $new->company_id = $request->mixture['dobavljac'];
        $new->content    = $json;
        if($new->save()){
            return redirect()->route("mixturesEditIndex",$new->id)
            ->with('success','Smeša uspesno sacuvana.');
        }
    }

    public function mixtureSave(Request $request){
        $data       = $request->all();
        $trade_name = $data['mixture']['trade_name'];
        if(empty($trade_name)){
            return response()->json([
                "error" => "Greska! Unesite <b>Trade name</b>",
            ]);
        }
        $array = array_keys($data['ingredients']['inci_name']['formula']);
        $data['mixture']['inci_name']['id'] = $array;
        if(isset($data['mixture_id'])){
            $mixture = Mixtures::find($data['mixture_id']);
        }else{
            $mixture = new Mixtures;
        }
        $mixture->trade_name = $trade_name;
        $mixture->company_id = (isset($data['mixture']['dobavljac']) ? $data['mixture']['dobavljac'] : null);
        $mixture->content    = json_encode($data);
        if($mixture->save()){
            return response()->json([
                "success" => "Uspesno ste sacuvali smesu.",
            ]);
        }
        print_r($mixture);
    }
    
    public function specUpload(Request $request){
        $fileName = str_replace(' ','_', $request->file->getClientOriginalName()) . "_" . rand(100,10000) . '_' . time() . '.'. $request->file->extension();  

        $type = $request->file->getClientMimeType();
        $size = $request->file->getSize();

        $request->file->move(public_path('file/specifikacija/'), $fileName);
        $t = '/file/specifikacija/'.$fileName;
        return $t;
    }

    public function aneksFetch(Request $request){
        $product_id = $request->product_id;
        $type       = $request->type;
        $product    = Products::find($product_id);
        $array      = array();
        if($product->aneks != "null" && !empty($product->aneks) && $product->aneks != null){
            $aneks = json_decode($product->aneks);
            if(isset($aneks->$type)){
                foreach($aneks->$type as $dokument){
                    if (file_exists( public_path($dokument))){
                        $array[] = array(
                            "name"=> basename($dokument),
                            "size"=> File::size(public_path($dokument)),
                            "path"=>$dokument,
                        );
                    }
                }
            }
            
        }
        return $array;
    }

    public function aneksRemove(Request $request){
        $file = basename($request->file);
        unlink(public_path('file/'.$file));
        echo "/file/".$file;

    }

    public function addIndex(){
        // echo \Hash::make('Mirjana123!');
        $aneksi        = $this->aneksi;
        $locale        = session()->get('locale');
        $name          = "inci_name_".$locale;
        $content       = "content_".$locale;
        $chapters      = Chapters::all();
        $companies     = Companies::all(); 
        $manufacturers = Manufacturers::all(); 
        $distributors  = Distributors::all(); 
        $ingredients   = Ingredients::select($name,"id",$content)->get();
        return view("pages.products.add", compact('chapters','companies','ingredients','manufacturers','distributors','aneksi'));        
    }
    
    public function mixtureRender(Request $request){
        $mixture      = Mixtures::find($request->mixture_id);
        $data         = json_decode($mixture->content);
        $id           = $request->id;
        $id           = $id+1;
        $chapter_id   = $request->chapter_id;
        $data_index   = $request->data_index;
        $distributors = Distributors::all(); 
        $locale       = session()->get('locale');
        $name         = "inci_name_".$locale;
        $content      = "content_".$locale;
        $ingredients  = Ingredients::select($name,"id",$content)->get();
        $ids          = $data->mixture->inci_name->id;
        $out = "";
        $out .='
        <div class="row fh_karakterisitke canClone mixture-'.$id.'" data_id="'.$id.'" data_index="'.$data_index.'" chapter_id="'.$chapter_id.'">
            <div class="col-xl-2 position-relative">
                <label class="form-label" for="trade_ime['.$id.']">Trade ime:</label>
                <input class="form-control form-input-replace trade_name" required id="trade_ime['.$id.']" value="'.$mixture->trade_name.'" name="items[id-'.$data_index.'][data][content]['.$id.'][trade_name]" type="text">
            </div>

            <div class="col-xl-2 position-relative">
                <label class="form-label" for="dobavljac_'.$chapter_id.'['.$id.']">Dobavljac:</label>
                <select class="form-select form-input-replace digits select2Multi dobavljac" name="items[id-'.$data_index.'][data][content]['.$id.'][dobavljac]" id="dobavljac_'.$chapter_id.'['.$id.']" required>';
                    
                    foreach($distributors as $distributor){
                    if(isset($trade->dobavljac)){
                        $did = $trade->dobavljac;
                    }else{
                        $did = 0;
                    }
                        $out .='<option '.($distributor->id == $did ? 'selected' : "").' value="'.$distributor->id.'">'.$distributor->name.'</option>';
                    }
                $out .='</select>
                </div>
                <div class="col-xl-3 position-relative">
                    <label class="form-label" for="inci_'.$chapter_id.'['.$id.']">INCI Name:</label>
                    
                    <select class="form-select form-input-replace digits select2Multi inci_additional" required multiple name="items[id-'.$data_index.'][data][content]['.$id.'][inci_name][id][]" id="inci_'.$chapter_id.'['.$id.']">';
                    foreach($ingredients as $ingredient){
                        $out .='<option '.(in_array($ingredient->id,$ids) ? "selected" : "") .' value="'.$ingredient->id.'">'.$ingredient->$name.'</option>';
                    }
                $out .='
                    </select>
                </div>
                
                <div class="col-xl-1 position-relative">
                    <label class="form-label" for="fh_reference[id-'.$data_index.']">Koncentracija:</label>
                    <input class="form-control form-input-replace main_conc" id="fh_reference[id-'.$data_index.']" value="'.$data->mixture->koncentracija.'" name="items[id-'.$data_index.'][data][content]['.$id.'][koncentracija]" type="text">
                </div>
                <div class="col-xl-1 position-relative">
                    <label class="form-label" for="fh_reference[id-'.$data_index.']">Necistoce:</label>
                    <input class="form-control form-input-replace" id="fh_reference[id-'.$data_index.']" value="'.$data->mixture->necistoce.'" name="items[id-'.$data_index.'][data][content]['.$id.'][necistoce]" type="text">
                </div>
                <div class="col-xl-1 position-relative">
                    <label class="form-label" for="fh_reference[id-'.$data_index.']">Funkcija:</label>
                    <input class="form-control form-input-replace" id="fh_reference[id-'.$data_index.']" value="'.$data->mixture->funkcija.'" name="items[id-'.$data_index.'][data][content]['.$id.'][funkcija]" type="text">
                </div>
                <div class="col-xl-1 position-relative file_parent">
                    <label class="form-label" for="specifikacija[id-'.$data_index.']">Specifikacija:</label>
                    <input type="hidden" value="'.(isset($data->mixture->specifikacija) ? $data->mixture->specifikacija : "") .'" name="items[id-'.$data_index.'][data][content]['.$id.'][specifikacija]" class="specifikacija form-input-replace" id="specifikacijaInput[id-'.$data_index.']" data-bs-original-title="" title="">
                    <input class="form-control form-input-replace file_upload" type="file" id="specifikacija[id-'.$data_index.']" data-bs-original-title="" title="">
                </div>
                <div class="col-xl-1 position-relative">
                    <label class="form-label" for="checkbox[id-'.$data_index.']">I.U.:</label>
                    <div class="form-check checkbox mb-0">
                        <input class="form-check-input form-input-replace iu_check" id="checkbox['.$id.']" '.(isset($data->mixture->ispunjava_uslove) ? "checked" : "") .' type="checkbox" name="items[id-'.$data_index.'][data][content]['.$id.'][ispunjava_uslove]">
                        <label class="form-label" for="checkbox['.$id.']"></label>
                    </div>
                </div>
                <div class="col position-relative align-self-end text-end">
                    <a class="btn btn-square btn-info saveMixture" type="button" data-bs-original-title="" title="">save</a>
                    <a class="btn btn-square btn-danger removeItem" type="button" data-bs-original-title="" title="">x</a>
                </div>
            </div>';


      $sum = 0;
      if(isset($data->ingredients->inci_name->koncentracija)){
        $t = (array)$data->ingredients->inci_name->koncentracija;
        $sum += array_sum($t);
      }
  $body = '<div class="card mb-2">
      <div class="card-header">
        <h5 class="mb-0">
          <button type="button" class="btn btn-link collapsed inci_parent inci_p_'.$id.'" data-bs-toggle="collapse" data-bs-target="#collapseicon-tradeList_'.$id.'" aria-expanded="false" aria-controls="collapseicon-tradeList"><i class="icofont icofont-arrow-right"></i><span>'.$mixture->trade_name.'</span> <sup class="all_conc">'.$sum.'%</sup></button>
        </h5>
      </div>
      <div class="collapse" id="collapseicon-tradeList_'.$id.'" aria-labelledby="collapseicon-tradeList" data-bs-parent="#tradeList">
        <div class="card-body card_'.$id.'">

          <div class="additional_ul">
            <div class="additional_list_'.$id.'">
              <div class="row">
                <div class="col-2 align-self-center">
                  <p>Additional</p>
                </div>
                  <div class="col-10">
                    <div class="row">
                      <div class="col-3">Necistoce: <input type="text"  placeholder="" class="form-control " value="'.$data->ingredients->additional->necistoce.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][necistoce]"></div>

                      <div class="col-3">Funkcija: <input type="text"  placeholder="" class="form-control " value="'.$data->ingredients->additional->funkcija.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][funkcija]"></div>

                      <div class="col-3">Regulatorni status: <input type="text"  placeholder="" class="form-control " value="'.$data->ingredients->additional->regulatory_status.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][regulatory_status]"> </div>

                      <div class="col-3">Molekulska masa (MW): <input type="text"  placeholder="Text | Referenca" class="form-control " value="'.$data->ingredients->additional->molekulska_masa.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][molekulska_masa]"> </div>

                      <div class="col-3">Opis: <input type="text"  placeholder="Text | Referenca" class="form-control " value="'.$data->ingredients->additional->opis.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][opis]">  </div>

                      <div class="col-3">Log Pow: <input type="text"  placeholder="Text | Referenca" class="form-control " value="'.$data->ingredients->additional->log_pow.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][log_pow]">  </div>

                      <div class="col-3">Tacka topljenja: <input type="text"  placeholder="Text | Referenca" class="form-control " value="'.$data->ingredients->additional->tacka_topljenja.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][tacka_topljenja]">  </div>

                      <div class="col-3">Rastvorljivost: <input type="text"  placeholder="Text | Referenca" class="form-control " value="'.$data->ingredients->additional->rastvorljivost.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][rastvorljivost]">  </div>

                      <div class="col-3">Akutna toksičnost oralno: <input type="text"  placeholder="" class="form-control " value="'.$data->ingredients->additional->akutna_toksicnost_oralno.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][akutna_toksicnost_oralno]">  </div>

                      <div class="col-3">Akutna toksičnost dermalno: <input type="text"  placeholder="" class="form-control " value="'.$data->ingredients->additional->akutna_toksicnost_dermalno.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][akutna_toksicnost_dermalno]">  </div>

                      <div class="col-3">Akutna toksičnost inhalacija: <input type="text"  placeholder="" class="form-control " value="'.$data->ingredients->additional->akutna_toksicnost_inhalacija.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][akutna_toksicnost_inhalacija]">  </div>

                      <div class="col-3">Iritacija kože/korozija: <input type="text"  placeholder="" class="form-control " value="'.$data->ingredients->additional->iritacija_koze.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][iritacija_koze]">  </div>

                      <div class="col-3">Iritacija oka: <input type="text"  placeholder="" class="form-control " value="'.$data->ingredients->additional->iritacija_oka.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][iritacija_oka]">  </div>

                      <div class="col-3">Senzitizacija: <input type="text"  placeholder="" class="form-control " value="'.$data->ingredients->additional->senzitizacija.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][senzitizacija]">  </div>
                      
                      <div class="col-3">Hronična (ponovljena) izloženost: <input type="text"  placeholder="" class="form-control " value="'.$data->ingredients->additional->hronicna_ponovljena_izlozenost.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][hronicna_ponovljena_izlozenost]">  </div>

                      <div class="col-3">Mutagenost/Genotoksičnost: <input type="text"  placeholder="" class="form-control " value="'.$data->ingredients->additional->mategenost_genotoksicnost.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][mategenost_genotoksicnost]">  </div>

                      <div class="col-3">Karcinogenost: <input type="text"  placeholder="" class="form-control " value="'.$data->ingredients->additional->karcinogenost.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][karcinogenost]">  </div>

                      <div class="col-3">Reproduktivna toksičnost: <input type="text"  placeholder="" class="form-control " value="'.$data->ingredients->additional->reproduktivna_toksicnost.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][reproduktivna_toksicnost]">  </div>

                      <div class="col-3">Toksikokinetički podaci: <input type="text"  placeholder="" class="form-control " value="'.$data->ingredients->additional->toksikokineticki_podaci.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][toksikokineticki_podaci]">  </div>

                      <div class="col-3">Fototoksicnost: <input type="text"  placeholder="" class="form-control " value="'.$data->ingredients->additional->fototoksicnost.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][fototoksicnost]">  </div>
                      
                      <div class="col-3">Podaci o ispitivanjima na ljudima: <input type="text"  placeholder="" class="form-control " value="'.$data->ingredients->additional->podaci_o_ispitivanjima_na_ljudima.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][podaci_o_ispitivanjima_na_ljudima]">  </div>

                      <div class="col-3">Ostali podaci: <input type="text"  placeholder="" class="form-control "value="'.$data->ingredients->additional->ostali_podaci.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][ostali_podaci]">  </div>

                      <div class="col-3">Zakljucak: <input type="text"  placeholder="" class="form-control "value="'.$data->ingredients->additional->zakljucak.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][zakljucak]">  </div>
                      <div class="col-12 references">Reference: ';
                        foreach($data->ingredients->additional->reference as $referenca){
                        $body .='   
                        <div class="row reference">
                          <div class="col-11">
                            <input type="text"  placeholder="" class="form-control " value="'.$referenca.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][additional][reference][]">
                          </div>
                          <div class="col-1 text-end">
                            <a class="btn btn-square btn-danger referenceRemove" type="button" data-bs-original-title="" title="">x</a>
                          </div>
                        </div>';
                        }
                        $body .='<div class="row">
                          <div class="col-12 text-end">
                            <a class="btn btn-square btn-success referenceAdd" type="button" data-bs-original-title="" title="">+</a>
                          </div>
                        </div>
                        
                    </div>
                </div>
                </div>
            </div>
          </div>
        </div>
          <hr>
          <div class="inci_ul">
            <div class="inci_list_'.$id.'">';
              $ingredients = Ingredients::find($ids);
              foreach($ingredients as $ingredient){
                $body .='
              <div class="row trade_li inci_li_e_'.$id.'_'.$ingredient->id.'"  data_id="'.$id.'">
                <div class="col-2 align-self-center">
                  <p>'.$ingredient->$name.'</p>
                  <p>SED (mg/kgbw/day):</p>
                  <select class="form-select sedCalc" required name="items[id-'.$data_index.'][data][content]['.$id.'][inci_name][formula]['.$ingredient->id.']">';
                    foreach(\Config::get('app.formulas') as $formula){
                      $body .= '<option '.($data->ingredients->inci_name->formula->{$ingredient->id} == $formula ? "selected"  : "").' value="'.$formula.'">'.$formula.'</option>';
                    }
                  $body .='</select>
                  <div class="invalid-tooltip">Moras da uneses naziv proizvoda</div>
                </div>
                <div class="col-10">
                  <div class="row">
                    <div class="col-3">Koncentracija: <input type="text"  placeholder="Concentration 0.15-1.20" class="form-control conc_value" value="'.$data->ingredients->inci_name->koncentracija->{$ingredient->id}.'" name="items[id-'.$data_index.'][data][content]['.$id.'][inci_name][koncentracija]['.$ingredient->id.']">
                    </div>
                    <div class="col-3">SED: <input type="text"  placeholder="SED (mg/kgbw/d)" class="form-control sed_value" value="'.$data->ingredients->inci_name->sed->{$ingredient->id}.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][inci_name][sed]['.$ingredient->id.']">
                    </div>
                    <div class="col-3">NOAEL: <input type="text" placeholder="(mg/kgbw/d)" class="form-control noael_value" value="'.$data->ingredients->inci_name->noael->{$ingredient->id}.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][inci_name][noael]['.$ingredient->id.']">
                    </div>
                    <div class="col-3">MoS: <input type="text" placeholder="PODsys/SED" class="form-control mos_value" value="'.$data->ingredients->inci_name->mos->{$ingredient->id}.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][inci_name][mos]['.$ingredient->id.']">
                    </div>
                    <div class="col-3">MoS Text: <input type="text" placeholder="PODsys/SED" class="form-control mos_text" value="'.$data->ingredients->inci_name->mos_text->{$ingredient->id}.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][inci_name][mos_text]['.$ingredient->id.']">
                    </div>
                    <div class="col-3">Dermalna Apsorpcija: <input type="text" placeholder="(μg/cm2)" class="form-control daa_value" value="'.$data->ingredients->inci_name->dermalna_apsorpcija->{$ingredient->id}.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][inci_name][dermalna_apsorpcija]['.$ingredient->id.']">
                    </div>
                    <div class="col-3">Dermalna Apsorpcija u %: <input type="text"placeholder="%" class="form-control da_value" value="'.$data->ingredients->inci_name->dermalna_apsorpcija_procenti->{$ingredient->id}.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][inci_name][dermalna_apsorpcija_procenti]['.$ingredient->id.']">
                    </div>
                    <div class="col-3">A: <input type="text" placeholder="(mg/kgbw/day)" class="form-control a_value" value="'.$data->ingredients->inci_name->a->{$ingredient->id}.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][inci_name][a]['.$ingredient->id.']">
                    </div>
                    <div class="col-3">SSA: <input type="text" placeholder="cm2" class="form-control ssa_value" value="'.$data->ingredients->inci_name->ssa->{$ingredient->id}.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][inci_name][ssa]['.$ingredient->id.']">
                    </div>
                    <div class="col-3">FFAPL: <input type="text" placeholder="Frequency of application of finished product" class="form-control fappl_value" value="'.$data->ingredients->inci_name->fappl->{$ingredient->id}.'"  name="items[id-'.$data_index.'][data][content]['.$id.'][inci_name][fappl]['.$ingredient->id.']">
                    </div>
                  </div>
                </div>
              </div>';
                }
            $body .='</div>
          </div>
        </div>
      </div>
    </div>';


            return response()->json([
                "heading" => $out,
                "body"  => $body,
            ]);
    }
    


}
