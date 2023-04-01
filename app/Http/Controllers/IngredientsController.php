<?php

namespace App\Http\Controllers;

use App\Models\Ingredients;
use Illuminate\Http\Request;

class IngredientsController extends Controller
{
    protected $items;
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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $ingredients = Ingredients::all();
        return view("pages.ingredients.index", compact('ingredients'));
    }
    public function editIndex($id){
        $locale = session()->get('locale');
        $ingredient = Ingredients::find($id);
        $items      = false;
        $content = "content_".$locale;

        $languages = \Config::get('app.available_locales');
        if (($key = array_search($locale, $languages)) !== false) {
            unset($languages[$key]);
        }

        if(!empty($ingredient->$content)){
            $items      = json_decode($ingredient->$content);
        }else{
            foreach($languages as $lang){
                $contentLang = "content_".$lang; 
                if(!empty($ingredient->$contentLang)){
                    $items      = json_decode($ingredient->$contentLang);
                    continue 1;
                }
            }
        }
        return view("pages.ingredients.edit",compact('ingredient','items'));
    }
    public function addIndex(){
        return view("pages.ingredients.add");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function ingredientGet(Request $request){
        $ingredient = ingredients::find($request->id);
        return $ingredient;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function manageItems(){
        $request = (object) $this->items;
        $items   = json_encode($request->items);
        $content = array(
            "necistoce" => htmlentities($request->necistoce),
            "funkcija" => htmlentities($request->funkcija),
            "regulatory_status" => htmlentities($request->regulatory_status),
            "akutna_toksicnost_oralno" => htmlentities($request->akutna_toksicnost_oralno),
            "akutna_toksicnost_dermalno" => htmlentities($request->akutna_toksicnost_dermalno),
            "akutna_toksicnost" => htmlentities($request->akutna_toksicnost),
            "iritacija_koze" => htmlentities($request->iritacija_koze),
            "iritacija_oka" => htmlentities($request->iritacija_oka),
            "senzitizacija" => htmlentities($request->senzitizacija),
            "hronicna_izlozenost" => htmlentities($request->hronicna_izlozenost),
            "muragenost_genotoksicnost" => htmlentities($request->muragenost_genotoksicnost),
            "karcinogenost" => htmlentities($request->karcinogenost),
            "reproduktivna_toksicnost" => htmlentities($request->reproduktivna_toksicnost),
            "toksikokineticki_podaci" => htmlentities($request->toksikokineticki_podaci),
            "fototoksicnost" => htmlentities($request->fototoksicnost),
            "podaci_o_ispitivanjima_ljudi" => htmlentities($request->podaci_o_ispitivanjima_ljudi),
            "ostali_podaci" => htmlentities($request->ostali_podaci),
            "zakljucak" => htmlentities($request->zakljucak),
            "z_ostali_podaci" => htmlentities($request->z_ostali_podaci),
            "items" => $request->items,
        );
        $content = json_encode($content);
        return $content;
    }
    public function store(Request $request){
        $this->items = $request->all();
        $content     = $this->manageItems();
        $locale      = session()->get('locale');
        $name       = $request->name;
        $inci_name  = $request->inci_name;
        $cas_number = $request->cas_number;
        $name       = "inci_name_".$locale; 
        $content_i  = "content_".$locale; 
        $data       = array(
            $name        => $inci_name,
            "cas_number" => $cas_number,
            $content_i   => $content,
        );
        if($request->has("ingredient_id")){
            $ingredient = Ingredients::find($request->ingredient_id);
        }else{
            $ingredient = new Ingredients;
        }
        $ingredient->$content_i = $content;
        $ingredient->$name      = $inci_name;
        $ingredient->cas_number = $cas_number;

        $languages = \Config::get('app.available_locales');
        if (($key = array_search($locale, $languages)) !== false) {
            unset($languages[$key]);
        }
        foreach($languages as $lang){
            $nameLang    = "inci_name_".$lang; 
            $contentLang = "content_".$lang; 
            if(empty($ingredient->$nameLang)){
                $ingredient->$nameLang = $inci_name;
            }
            if(empty($ingredient->$contentLang)){
                $ingredient->$contentLang = $content;
            }
        }

        $ingredient->save();
        return redirect()->back()
                        ->with('success','Sastojak uspesno sacuvan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function show(Ingredients $ingredients)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function edit(Ingredients $ingredients)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ingredient $ingredient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ingredient  $ingredient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ingredient $ingredient)
    {
        //
    }
}
