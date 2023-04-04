@extends('layouts.main') @section('content')
@php
    $name        = "name_".session()->get('locale');
    $inci_name   = "inci_name_".session()->get('locale');
    $content     = "content_".session()->get('locale');
    $data        = json_decode($mixture->content);
    $ingredients = App\Models\Ingredients::all();
    $ids         = $data->mixture->inci_name->id;
    // print_r($data->ingredients);
@endphp
<!-- Page Sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-sm-6">
          <h3>Mixtures</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="/">
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item active">
              <a href="{{route('products')}}">Mixtures</a>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  @php 
      $sum = 0;
      if(isset($data->ingredients->inci_name->koncentracija)){
        
          $t = (array)$data->ingredients->inci_name->koncentracija;
        $sum += array_sum($t);
      }
  @endphp
  <!-- Container-fluid starts-->
  <div class="container-fluid dashboard-default">
    <div class="faq-wrap">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-12">
              <form class="row g-3 needs-validation" novalidate="" method="POST" action="{{route('mixtureStore')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="mixture_id" id="mixture_id" value="{{$mixture->id}}">
                <input type="hidden" value="{{session()->get('locale')}}" name="product_locale">
                <div class="col-6 mt-2">
                  <button class="btn btn-primary" type="submit">Save</button>
                </div>
                <div class="col-12 parentClone">
                    <div class="row fh_karakterisitke canClone mixture-0 canClone" data_id="0">
                      <div class="col-xl-4 position-relative">
                        <label class="form-label" for="trade_ime[0]">Trade ime:</label>
                        <input class="form-control form-input-replace trade_name" value="{{$data->mixture->trade_name}}" required id="trade_ime[0]" name="mixture[trade_name]" type="text">
                      </div>

                      <div class="col-xl-3 position-relative">
                        <label class="form-label" for="dobavljac[0]">Dobavljac:</label>
                        <select class="form-select form-input-replace digits select2Multi dobavljac" name="mixture[dobavljac]" id="dobavljac[0]" required>
                            
                            @foreach($distributors as $distributor)
                            <option value="{{$distributor->id}}" {{ ($distributor->id == $mixture->company_id ? "selected" : "") }}>{{$distributor->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="col-xl-5 position-relative">
                        <label class="form-label" for="inci[0]">INCI Name:</label>
                        <select class="form-select form-input-replace digits select2Multi inci_additional" multiple name="mixture[inci_name][id][]" id="inci[0]">
                            @foreach($ingredients as $ingredient)
                                <option @if(in_array($ingredient->id,$ids)) selected @endif value="{{$ingredient->id}}">{{$ingredient->$inci_name}}</option>
                            @endforeach
                          </select>
                      </div>

                      <div class="col-xl-3 position-relative">
                        <label class="form-label" for="konc">Koncentracija:</label>
                        <input class="form-control form-input-replace main_conc" value="{{$data->mixture->koncentracija}}" id="konc" name="mixture[koncentracija]" type="text">
                      </div>
                      <div class="col-xl-3 position-relative">
                        <label class="form-label" for="necistoce">Necistoce:</label>
                        <input class="form-control form-input-replace" value="{{$data->mixture->necistoce}}" id="necistoce" name="mixture[necistoce]" type="text">
                      </div>
                      <div class="col-xl-2 position-relative">
                        <label class="form-label" for="funkcija">Funkcija:</label>
                        <input class="form-control form-input-replace" value="{{$data->mixture->funkcija}}" id="funkcija" name="mixture[funkcija]" type="text">
                      </div>
                      <div class="col-xl-3">
                        <label class="form-label" for="specifikacija">Specifikacija:</label>
                        <div class="form-check checkbox mb-0">
                            <input class="form-check-input form-input-replace iu_check" id="checkbox_spec" @if(isset($data->mixture->specifikacija)) checked @endif type="checkbox" name="mixture[specifikacija]">
                            <label class="form-label" for="checkbox_spec"></label>
                          </div>
                      </div>
                      
                      <div class="col-xl-1 position-relative">
                        <label class="form-label" for="checkbox">I.U.:</label>
                        <div class="form-check checkbox mb-0">
                            <input class="form-check-input form-input-replace iu_check" id="checkbox" @if(isset($data->mixture->ispunjava_uslove)) checked @endif type="checkbox" name="mixture[ispunjava_uslove]">
                            <label class="form-label" for="checkbox"></label>
                          </div>
                      </div>
                    <div class="default-according style-1 faq-accordion inci_list" id="tradeList">
                      <div class="card mb-2">
                        <div class="card-header">
                          <h5 class="mb-0">
                            <button type="button" class="btn btn-link collapsed inci_parent inci_p_0" data-bs-toggle="collapse" data-bs-target="#collapseicon-tradeList_0" aria-expanded="false" aria-controls="collapseicon-tradeList"><i class="icofont icofont-arrow-right"></i><span>{{$mixture->trade_name}}</span> <sup class="all_conc">{{$sum}}%</sup></button>
                          </h5>
                        </div>
                        <div class="collapse" id="collapseicon-tradeList_0" aria-labelledby="collapseicon-tradeList" data-bs-parent="#tradeList">
                          <div class="card-body card_0">
                    
                            <div class="additional_ul">
                              <div class="additional_list_0">
                                <div class="row">
                                  <div class="col-2 align-self-center">
                                    <p>Additional</p>
                                  </div>
                                    <div class="col-10">
                                      <div class="row">
                                        <div class="col-3">Necistoce: <input type="text"  placeholder="" class="form-control " value="@if(isset($data->ingredients->additional->necistoce)) {{$data->ingredients->additional->necistoce}} @endif"  name="ingredients[additional][necistoce]"></div>
                    
                                        <div class="col-3">Funkcija: <input type="text"  placeholder="" class="form-control " value="@if(isset($data->ingredients->additional->funkcija)) {{$data->ingredients->additional->funkcija}} @endif"  name="ingredients[additional][funkcija]"></div>
                    
                                        <div class="col-3">Regulatorni status: <input type="text"  placeholder="" class="form-control " value="@if(isset($data->ingredients->additional->regulatory_status)) {{$data->ingredients->additional->regulatory_status }} @endif"  name="ingredients[additional][regulatory_status]"> </div>
                    
                                        <div class="col-3">Molekulska masa (MW): <input type="text"  placeholder="Text | Referenca" class="form-control " value="@if(isset($data->ingredients->additional->molekulska_masa)) {{$data->ingredients->additional->molekulska_masa }} @endif"  name="ingredients[additional][molekulska_masa]"> </div>
                    
                                        <div class="col-3">Opis: <input type="text"  placeholder="Text | Referenca" class="form-control "value="@if(isset($data->ingredients->additional->opis)) {{$data->ingredients->additional->opis}} @endif"  name="ingredients[additional][opis]">  </div>
                    
                                        <div class="col-3">Log Pow: <input type="text"  placeholder="Text | Referenca" class="form-control "value="@if(isset($data->ingredients->additional->log_pow)) {{$data->ingredients->additional->log_pow}} @endif"  name="ingredients[additional][log_pow]">  </div>
                    
                                        <div class="col-3">Tacka topljenja: <input type="text"  placeholder="Text | Referenca" class="form-control "value="@if(isset($data->ingredients->additional->tacka_topljenja)) {{$data->ingredients->additional->tacka_topljenja}} @endif"  name="ingredients[additional][tacka_topljenja]">  </div>
                    
                                        <div class="col-3">Rastvorljivost: <input type="text"  placeholder="Text | Referenca" class="form-control "value="@if(isset($data->ingredients->additional->rastvorljivost)) {{ $data->ingredients->additional->rastvorljivost}} @endif"  name="ingredients[additional][rastvorljivost]">  </div>
                    
                                        <div class="col-3">Akutna toksičnost oralno: <input type="text"  placeholder="" class="form-control "value="@if(isset($data->ingredients->additional->akutna_toksicnost_oralno)) {{ $data->ingredients->additional->akutna_toksicnost_oralno}} @endif"  name="ingredients[additional][akutna_toksicnost_oralno]">  </div>
                    
                                        <div class="col-3">Akutna toksičnost dermalno: <input type="text"  placeholder="" class="form-control "value="@if(isset($data->ingredients->additional->akutna_toksicnost_dermalno)) {{ $data->ingredients->additional->akutna_toksicnost_dermalno}} @endif"  name="ingredients[additional][akutna_toksicnost_dermalno]">  </div>
                    
                                        <div class="col-3">Akutna toksičnost inhalacija: <input type="text"  placeholder="" class="form-control "value="@if(isset($data->ingredients->additional->akutna_toksicnost_inhalacija)) {{$data->ingredients->additional->akutna_toksicnost_inhalacija}} @endif"  name="ingredients[additional][akutna_toksicnost_inhalacija]">  </div>
                    
                                        <div class="col-3">Iritacija kože/korozija: <input type="text"  placeholder="" class="form-control "value="@if(isset($data->ingredients->additional->iritacija_koze)) {{ $data->ingredients->additional->iritacija_koze }} @endif"  name="ingredients[additional][iritacija_koze]">  </div>
                    
                                        <div class="col-3">Iritacija oka: <input type="text"  placeholder="" class="form-control "value="@if(isset($data->ingredients->additional->iritacija_oka)) {{ $data->ingredients->additional->iritacija_oka }} @endif"  name="ingredients[additional][iritacija_oka]">  </div>
                    
                                        <div class="col-3">Senzitizacija: <input type="text"  placeholder="" class="form-control "value="@if(isset($data->ingredients->additional->senzitizacija)) {{ $data->ingredients->additional->senzitizacija }} @endif"  name="ingredients[additional][senzitizacija]">  </div>
                                        
                                        <div class="col-3">Hronična (ponovljena) izloženost: <input type="text"  placeholder="" class="form-control "value="@if(isset($data->ingredients->additional->hronicna_ponovljena_izlozenost)) {{ $data->ingredients->additional->hronicna_ponovljena_izlozenost }} @endif"  name="ingredients[additional][hronicna_ponovljena_izlozenost]">  </div>
                    
                                        <div class="col-3">Mutagenost/Genotoksičnost: <input type="text"  placeholder="" class="form-control "value="@if(isset($data->ingredients->additional->mategenost_genotoksicnost)) {{ $data->ingredients->additional->mategenost_genotoksicnost }} @endif"  name="ingredients[additional][mategenost_genotoksicnost]">  </div>
                    
                                        <div class="col-3">Karcinogenost: <input type="text"  placeholder="" class="form-control "value="@if(isset($data->ingredients->additional->karcinogenost)) {{ $data->ingredients->additional->karcinogenost }} @endif"  name="ingredients[additional][karcinogenost]">  </div>
                    
                                        <div class="col-3">Reproduktivna toksičnost: <input type="text"  placeholder="" class="form-control "value="@if(isset($data->ingredients->additional->reproduktivna_toksicnost)) {{ $data->ingredients->additional->reproduktivna_toksicnost }} @endif"  name="ingredients[additional][reproduktivna_toksicnost]">  </div>
                    
                                        <div class="col-3">Toksikokinetički podaci: <input type="text"  placeholder="" class="form-control "value="@if(isset($data->ingredients->additional->toksikokineticki_podaci)) {{ $data->ingredients->additional->toksikokineticki_podaci }} @endif"  name="ingredients[additional][toksikokineticki_podaci]">  </div>
                    
                                        <div class="col-3">Fototoksicnost: <input type="text"  placeholder="" class="form-control "value="@if(isset($data->ingredients->additional->fototoksicnost)) {{ $data->ingredients->additional->fototoksicnost }} @endif"  name="ingredients[additional][fototoksicnost]">  </div>
                                        
                                        <div class="col-3">Podaci o ispitivanjima na ljudima: <input type="text"  placeholder="" class="form-control "value="@if(isset($data->ingredients->additional->podaci_o_ispitivanjima_na_ljudima)) {{ $data->ingredients->additional->podaci_o_ispitivanjima_na_ljudima }} @endif"  name="ingredients[additional][podaci_o_ispitivanjima_na_ljudima]">  </div>
                    
                                        <div class="col-3">Ostali podaci: <input type="text"  placeholder="" class="form-control "value="@if(isset($data->ingredients->additional->ostali_podaci)) {{ $data->ingredients->additional->ostali_podaci }} @endif"  name="ingredients[additional][ostali_podaci]">  </div>
                    
                                        <div class="col-3">Zakljucak: <input type="text"  placeholder="" class="form-control "value="@if(isset($data->ingredients->additional->zakljucak)) {{ $data->ingredients->additional->zakljucak }} @endif"  name="ingredients[additional][zakljucak]">  </div>
                    
                    
                                        <div class="col-12 references">Reference: 
                                          @if(isset($data->ingredients->additional->reference))
                                          @foreach($data->ingredients->additional->reference as $referenca)
                                          <div class="row reference">
                                            <div class="col-11">
                                              <input type="text"  placeholder="" class="form-control " value="{{$referenca}}"  name="ingredients[additional][reference][]">
                                            </div>
                                            <div class="col-1 text-end">
                                              <a class="btn btn-square btn-danger referenceRemove" type="button" data-bs-original-title="" title="">x</a>
                                            </div>
                                          </div>
                                          @endforeach
                                         
                                          @endif
                                          <div class="row">
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
                              <div class="inci_list_0">
                                @php 
                                  $ingredients = App\Models\Ingredients::find($ids);
                                @endphp
                                @foreach($ingredients as $ingredient)
                                <div class="row trade_li inci_li_e_0_{{$ingredient->id}}"  data_id="0">
                                  <div class="col-2 align-self-center">
                                    <p>{{$ingredient->$inci_name}}</p>
                                    <p>SED (mg/kgbw/day):</p>
                                    <select class="form-select sedCalc" required name="ingredients[inci_name][formula][{{$ingredient->id}}]" required>
                                      @foreach(Config::get('app.formulas') as $formula)
                                        <option @if(isset($data->ingredients->inci_name->formula->{$ingredient->id})) @if($data->ingredients->inci_name->formula->{$ingredient->id} == $formula) selected @endif @endif value="{{$formula}}">{{$formula}}</option>
                                      @endforeach
                                    </select>
                                    <div class="invalid-tooltip">Moras da uneses naziv proizvoda</div>
                                  </div>
                                  <div class="col-10">
                                    <div class="row">
                                      <div class="col-3">Koncentracija: <input type="text"  placeholder="Concentration 0.15-1.20" class="form-control conc_value" value="@if(isset($data->ingredients->inci_name->koncentracija->{$ingredient->id})) {{ $data->ingredients->inci_name->koncentracija->{$ingredient->id} }} @endif" name="ingredients[inci_name][koncentracija][{{$ingredient->id}}]">
                                      </div>
                                      <div class="col-3">SED: <input type="text"  placeholder="SED (mg/kgbw/d)" class="form-control sed_value" value="@if(isset($data->ingredients->inci_name->sed->{$ingredient->id})) {{ $data->ingredients->inci_name->sed->{$ingredient->id} }} @endif"  name="ingredients[inci_name][sed][{{$ingredient->id}}]">
                                      </div>
                                      <div class="col-3">NOAEL: <input type="text" placeholder="(mg/kgbw/d)" class="form-control noael_value" value="@if(isset($data->ingredients->inci_name->noael->{$ingredient->id})) {{ $data->ingredients->inci_name->noael->{$ingredient->id} }} @endif"  name="ingredients[inci_name][noael][{{$ingredient->id}}]">
                                      </div>
                                      <div class="col-3">MoS: <input type="text" placeholder="PODsys/SED" class="form-control mos_value" value="@if(isset($data->ingredients->inci_name->mos->{$ingredient->id})) {{ $data->ingredients->inci_name->mos->{$ingredient->id} }} @endif"  name="ingredients[inci_name][mos][{{$ingredient->id}}]">
                                      </div>
                                      <div class="col-3">MoS Text: <input type="text" placeholder="PODsys/SED" class="form-control mos_text" value="@if(isset($data->ingredients->inci_name->mos_text->{$ingredient->id})) {{ $data->ingredients->inci_name->mos_text->{$ingredient->id} }} @endif"  name="ingredients[inci_name][mos_text][{{$ingredient->id}}]">
                                      </div>
                                      <div class="col-3">Dermalna Apsorpcija: <input type="text" placeholder="(μg/cm2)" class="form-control daa_value" value="@if(isset($data->ingredients->inci_name->dermalna_apsorpcija->{$ingredient->id})) {{ $data->ingredients->inci_name->dermalna_apsorpcija->{$ingredient->id} }} @endif"  name="ingredients[inci_name][dermalna_apsorpcija][{{$ingredient->id}}]">
                                      </div>
                                      <div class="col-3">Dermalna Apsorpcija u %: <input type="text"placeholder="%" class="form-control da_value" value="@if(isset($data->ingredients->inci_name->dermalna_apsorpcija_procenti->{$ingredient->id})) {{ $data->ingredients->inci_name->dermalna_apsorpcija_procenti->{$ingredient->id} }} @endif"  name="ingredients[inci_name][dermalna_apsorpcija_procenti][{{$ingredient->id}}]">
                                      </div>
                                      <div class="col-3">A: <input type="text" placeholder="(mg/kgbw/day)" class="form-control a_value" value="@if(isset($data->ingredients->inci_name->a->{$ingredient->id})) {{ $data->ingredients->inci_name->a->{$ingredient->id} }} @endif"  name="ingredients[inci_name][a][{{$ingredient->id}}]">
                                      </div>
                                      <div class="col-3">SSA: <input type="text" placeholder="cm2" class="form-control ssa_value" value="@if(isset($data->ingredients->inci_name->ssa->{$ingredient->id})) {{ $data->ingredients->inci_name->ssa->{$ingredient->id} }} @endif"  name="ingredients[inci_name][ssa][{{$ingredient->id}}]">
                                      </div>
                                      <div class="col-3">FFAPL: <input type="text" placeholder="Frequency of application of finished product" class="form-control fappl_value" value="@if(isset($data->ingredients->inci_name->fappl->{$ingredient->id})) {{ $data->ingredients->inci_name->fappl->{$ingredient->id} }} @endif"  name="ingredients[inci_name][fappl][{{$ingredient->id}}]">
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              @endforeach
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- Container-fluid Ends-->
</div>  @endsection