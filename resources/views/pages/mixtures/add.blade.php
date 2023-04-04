@extends('layouts.main') @section('content')
@php
    $name         = "name_".session()->get('locale');
    $inci_name    = "inci_name_".session()->get('locale');
    $content      = "content_".session()->get('locale');
    $ingredients  = App\Models\Ingredients::all();
    $distributors = App\Models\Distributors::all();

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
  <!-- Container-fluid starts-->
  <div class="container-fluid dashboard-default">
    <div class="faq-wrap">
      <div class="row">
        <div class="col-lg-12">
          <div class="row">
            <div class="col-12">
              <form class="row g-3 needs-validation" novalidate="" method="POST" action="{{route('mixtureStore')}}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" value="{{session()->get('locale')}}" name="product_locale">
                <div class="col-6 mt-2">
                  <button class="btn btn-primary" type="submit">Save</button>
                </div>
                <div class="col-12 parentClone">
                    <div class="row fh_karakterisitke canClone mixture-0 canClone" data_id="0">
                      <div class="col-xl-4 position-relative">
                        <label class="form-label" for="trade_ime[0]">Trade ime:</label>
                        <input class="form-control form-input-replace trade_name" value="" required id="trade_ime[0]" name="mixture[trade_name]" type="text">
                      </div>

                      <div class="col-xl-3 position-relative">
                        <label class="form-label" for="dobavljac[0]">Dobavljac:</label>
                        <select class="form-select form-input-replace digits select2Multi dobavljac" name="mixture[dobavljac]" id="dobavljac[0]" required>
                            
                            @foreach($distributors as $distributor)
                            <option value="{{$distributor->id}}">{{$distributor->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      <div class="col-xl-5 position-relative">
                        <label class="form-label" for="inci[0]">INCI Name:</label>
                        <select class="form-select form-input-replace digits select2Multi inci_additional" multiple name="mixture[inci_name][id][]" id="inci[0]">
                            @foreach($ingredients as $ingredient)
                                <option  value="{{$ingredient->id}}">{{$ingredient->$inci_name}}</option>
                            @endforeach
                          </select>
                      </div>

                      <div class="col-xl-3 position-relative">
                        <label class="form-label" for="konc">Koncentracija:</label>
                        <input class="form-control form-input-replace main_conc" value="" id="konc" name="mixture[koncentracija]" type="text">
                      </div>
                      <div class="col-xl-3 position-relative">
                        <label class="form-label" for="necistoce">Necistoce:</label>
                        <input class="form-control form-input-replace" value="" id="necistoce" name="mixture[necistoce]" type="text">
                      </div>
                      <div class="col-xl-2 position-relative">
                        <label class="form-label" for="funkcija">Funkcija:</label>
                        <input class="form-control form-input-replace" value="" id="funkcija" name="mixture[funkcija]" type="text">
                      </div>
                      <div class="col-xl-3">
                        <label class="form-label" for="specifikacija">Specifikacija:</label>
                        <div class="form-check checkbox mb-0">
                            <input class="form-check-input form-input-replace iu_check" id="checkbox_spec" type="checkbox" name="mixture[specifikacija]">
                            <label class="form-label" for="checkbox_spec"></label>
                          </div>
                      </div>
                      <div class="col-xl-1 position-relative">
                        <label class="form-label" for="checkbox">I.U.:</label>
                        <div class="form-check checkbox mb-0">
                            <input class="form-check-input form-input-replace iu_check" id="checkbox" type="checkbox" name="mixture[ispunjava_uslove]">
                            <label class="form-label" for="checkbox"></label>
                          </div>
                      </div>
                    <div class="default-according style-1 faq-accordion inci_list" id="tradeList">
                      <div class="card mb-2">
                        <div class="card-header">
                          <h5 class="mb-0">
                            <button type="button" class="btn btn-link collapsed inci_parent inci_p_0" data-bs-toggle="collapse" data-bs-target="#collapseicon-tradeList_0" aria-expanded="false" aria-controls="collapseicon-tradeList"><i class="icofont icofont-arrow-right"></i><span></span> <sup class="all_conc"></sup></button>
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
                                        <div class="col-3">Necistoce: <input type="text"  placeholder="" value="" class="form-control" name="ingredients[additional][necistoce]"></div>
                    
                                        <div class="col-3">Funkcija: <input type="text" value="" placeholder="" class="form-control" name="ingredients[additional][funkcija]"></div>
                    
                                        <div class="col-3">Regulatorni status: <input type="text" value="" placeholder="" class="form-control " name="ingredients[additional][regulatory_status]"> </div>
                    
                                        <div class="col-3">Molekulska masa (MW): <input type="text"  value="" placeholder="Text | Referenca" class="form-control" name="ingredients[additional][molekulska_masa]"> </div>
                    
                                        <div class="col-3">Opis: <input type="text"  value="" placeholder="Text | Referenca" class="form-control " name="ingredients[additional][opis]">  </div>
                    
                                        <div class="col-3">Log Pow: <input type="text"  value="" placeholder="Text | Referenca" class="form-control" name="ingredients[additional][log_pow]">  </div>
                    
                                        <div class="col-3">Tacka topljenja: <input type="text"  value="" placeholder="Text | Referenca" class="form-control" name="ingredients[additional][tacka_topljenja]">  </div>
                    
                                        <div class="col-3">Rastvorljivost: <input type="text"  value="" placeholder="Text | Referenca" class="form-control" name="ingredients[additional][rastvorljivost]">  </div>
                    
                                        <div class="col-3">Akutna toksičnost oralno: <input type="text" value="" placeholder="" class="form-control "  name="ingredients[additional][akutna_toksicnost_oralno]">  </div>
                    
                                        <div class="col-3">Akutna toksičnost dermalno: <input type="text" value="" placeholder="" class="form-control " name="ingredients[additional][akutna_toksicnost_dermalno]">  </div>
                    
                                        <div class="col-3">Akutna toksičnost inhalacija: <input type="text" value="" placeholder="" class="form-control "  name="ingredients[additional][akutna_toksicnost_inhalacija]">  </div>
                    
                                        <div class="col-3">Iritacija kože/korozija: <input type="text" value="" placeholder="" class="form-control " name="ingredients[additional][iritacija_koze]">  </div>
                    
                                        <div class="col-3">Iritacija oka: <input type="text" value="" placeholder="" class="form-control " name="ingredients[additional][iritacija_oka]">  </div>
                    
                                        <div class="col-3">Senzitizacija: <input type="text" value="" placeholder="" class="form-control "  name="ingredients[additional][senzitizacija]">  </div>
                                        
                                        <div class="col-3">Hronična (ponovljena) izloženost: <input type="text" value="" placeholder="" class="form-control " name="ingredients[additional][hronicna_ponovljena_izlozenost]">  </div>
                    
                                        <div class="col-3">Mutagenost/Genotoksičnost: <input type="text" value="" placeholder="" class="form-control " name="ingredients[additional][mategenost_genotoksicnost]">  </div>
                    
                                        <div class="col-3">Karcinogenost: <input type="text" value="" placeholder="" class="form-control " name="ingredients[additional][karcinogenost]">  </div>
                    
                                        <div class="col-3">Reproduktivna toksičnost: <input type="text" value="" placeholder="" class="form-control " name="ingredients[additional][reproduktivna_toksicnost]">  </div>
                    
                                        <div class="col-3">Toksikokinetički podaci: <input type="text" value="" placeholder="" class="form-control "  name="ingredients[additional][toksikokineticki_podaci]">  </div>
                    
                                        <div class="col-3">Fototoksicnost: <input type="text" value="" placeholder="" class="form-control "  name="ingredients[additional][fototoksicnost]">  </div>
                                        
                                        <div class="col-3">Podaci o ispitivanjima na ljudima: <input type="text" value="" placeholder="" class="form-control " name="ingredients[additional][podaci_o_ispitivanjima_na_ljudima]">  </div>
                    
                                        <div class="col-3">Ostali podaci: <input type="text" value="" placeholder="" class="form-control " name="ingredients[additional][ostali_podaci]">  </div>
                    
                                        <div class="col-3">Zakljucak: <input type="text" value="" placeholder="" class="form-control " name="ingredients[additional][zakljucak]">  </div>
                    
                    
                                        <div class="col-12 references">Reference: 
                                          <div class="row reference">
                                            <div class="col-11">
                                              <input type="text" value="" placeholder="" class="form-control "  name="ingredients[additional][reference][]">
                                            </div>
                                            <div class="col-1 text-end">
                                              <a class="btn btn-square btn-danger referenceRemove" type="button" data-bs-original-title="" title="">x</a>
                                            </div>
                                          </div>
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