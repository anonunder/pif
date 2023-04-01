@extends('layouts.main') @section('content')
<!-- Page Sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-sm-6">
          <h3>{{__("main.products")}} </h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="/">
                <i data-feather="home"></i>
              </a>
            </li> 
            <li class="breadcrumb-item active"><a href="{{route('products')}}">Products</a></li>
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
                <form class="row g-3 needs-validation" id="productForm" novalidate="" method="POST" action="{{route('productsStore')}}" enctype="multipart/form-data"> 
                  @csrf
                <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}">
                  <input type="hidden" value="{{session()->get('locale')}}" name="product_locale">
                    <div class="col-6 mt-2">
                        <button class="btn btn-primary" type="submit">Save</button>
                      </div>
                      <div class="col-6 text-end cst_buttons">
                        
                        @if($product->pdf_link == null)
                        <a href="{{route('pdfGenerate',$product->id)}}" class="btn btn-danger download_button">PDF Generate</a>
                        @else
                        <a href="{{route('pdfGenerate',$product->id)}}" class="btn btn-danger download_button">PDF Download</a>

                        @endif
                          <a href="{{route('pdfViewer',$product->id)}}" target="_blank" class="btn btn-success preview_button">PDF Preview</a>
                      </div>
                    <div class="col-10">
                    <div class="row">
                      <div class="col-md-4 position-relative">
                        <label class="form-label" for="inciName">Naziv proizvoda</label>
                        <input class="form-control" id="inciName" name="product_name" value="{{$product->name}}" type="text" required="">
                        <div class="invalid-tooltip">Moras da uneses naziv proizvoda</div>
                    </div>
                    <div class="col-md-4 position-relative">
                        <label class="form-label" for="company">Firma</label>
                        <select class="form-select digits" name="product_company" id="company">
                            @foreach($companies as $company)
                            <option @if($company->id == $product->company_id) selected @endif value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                          </select>
                        <div class="invalid-tooltip">Moras da uneses naziv proizvoda</div>
                    </div>
                    <div class="col-md-4 position-relative">
                      <label class="form-label" for="company">Status</label>
                      <select class="form-select digits" name="product_status" id="status">
                        <option @if($product->status == 0) selected @endif value="0">Neobjavljeno</option>
                        <option @if($product->status == 1) selected @endif value="1">Objavljeno</option>
                        </select>
                      <div class="invalid-tooltip">Moras da izaberes status</div>
                  </div>
                    
                    <div class="col-6 position-relative">
                        <label class="form-label" for="datum">Datum</label>
                        <input class="form-control digits" type="date" name="product_create_date" value="{{\Carbon\Carbon::parse($product->created_at)->format('Y-m-d')}}" data-bs-original-title="" title="">
                        <div class="invalid-tooltip">Moras da uneses datum</div>
                    </div>
                    
                    <div class="col-6 position-relative">
                        <label class="form-label" for="inciName">Broj formule</label>
                        <input class="form-control" id="inciName" name="number_formula" value="{{$product->formula}}" type="text" required="">
                        <div class="invalid-tooltip">Moras da uneses broj formule</div>
                    </div>
                    <div class="col-6 position-relative">
                        <label class="form-label" for="inciName">Verzija</label>
                        <input class="form-control" id="inciName" name="product_version" value="{{$product->version}}" type="text" required="">
                        <div class="invalid-tooltip">Moras da uneses verziju proizvoda</div>
                    </div>
                    <div class="col-6 position-relative">
                        <label class="form-label" for="inciName">Kategorija</label>
                        <input class="form-control" id="inciName" name="product_category" value="{{$product->category}}" type="text" required="">
                        <div class="invalid-tooltip">Moras da uneses verziju proizvoda</div>
                    </div>
                  </div>
                </div>
                <div class="col-2">
                  <img src="{{$product->image}}" class="w-100" id="product_image_preview">
                  <input class="form-control " type="file" id="product_image" value="{{$product->image}}" name="product_image" data-bs-original-title="" title="">
                </div>
                <div class="default-according style-1 faq-accordion" id="accordionoc">
                <div class="card mb-2">
                  <div class="card-header">
                    <h5 class="mb-0">
                      <button type="button" class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseicon-aneks" aria-expanded="false" aria-controls="collapseicon-aneks">Aneksi</button>
                    </h5>
                  </div>
                  <div class="collapse" id="collapseicon-aneks" aria-labelledby="collapseicon-aneks" data-bs-parent="#accordionoc">
                    <div class="card-body">
                      <div class="default-according style-1 faq-accordion" id="aneksiAccordion">
                        @foreach($aneksi as $code => $aneks)
                        <div class="card mb-2">
                          <div class="card-header">
                            <h5 class="mb-0">
                              <button type="button" class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseicon-{{$code}}" aria-expanded="false" aria-controls="collapseicon-{{$code}}">{{$aneks}}</button>
                            </h5>
                          </div>
                          <div class="collapse" id="collapseicon-{{$code}}" aria-labelledby="collapseicon-{{$code}}" data-bs-parent="#aneksiAccordion">
                            <div class="card-body">
                              <div class="dropzone dropzone-primary multiFileUpload" id="aneks_upload_{{$code}}" type="{{$code}}" action="#">
                                <div class="dz-message needsclick"><i class="icon-cloud-up"></i>
                                </div>
                              </div>
                              <ol style="margin-top: 20px;" class="lista_fajlova lf_{{$code}}">
                                @if(isset($aneks_u->$code))
                                @foreach($aneks_u->$code as $dokument)
                                  <li><a href="{{$dokument}}" target="_blank">{{basename($dokument)}}</a></li>
                                @endforeach
                                @endif
                              </ol>
                            </div>
                          </div>
                        </div>
                        
                        @endforeach
                        
                      </div>
                    </div>
                  </div>
                </div>
                <div id="aneksi">
                  @if($aneks_u)
                    @foreach($aneks_u as $code => $aneks_files)
                      @foreach($aneks_files as $dokument)
                        <input type="hidden" name="aneksi[{{$code}}][]" value="{{$dokument}}">
                      @endforeach
                    @endforeach
                  @endif
                </div>
                @if(!$items)
                  @php \Redirect::route('productsAddIndex') @endphp
                @endif
                @foreach($items as $index => $chapter)
                
                @php
                  $chapterOb = \App\Models\Chapters::find($chapter->id);

                  $name      = "name_".session()->get('locale');
                  $inci_name = "inci_name_".session()->get('locale');
                  $content   = "content_".session()->get('locale');
                @endphp
                

                <div class="card mb-2">
                  <input type="hidden" value="{{$chapter->id}}" name="items[{{$index}}][id]">
                  <input type="hidden" value="{{$chapterOb->$name}}" name="items[{{$index}}][chapter_name]">
                  <div class="card-header">
                    <h5 class="mb-0">
                      <button type="button" class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseicon-{{$chapter->id}}" aria-expanded="false" aria-controls="collapseicon-{{$chapter->id}}">{{$chapterOb->$name}}</button>
                    </h5>
                  </div>
                  <div class="collapse" id="collapseicon-{{$chapter->id}}" aria-labelledby="collapseicon-{{$chapter->id}}" data-bs-parent="#accordionoc">
                    <div class="card-body">
                      @if(!empty($chapter->data->content))
                      @php 
                      $content = $chapter->data->content;
                      // $content = json_decode($chapterOb->$content);
                      // (isset($content[0]->data[0]) ? $content[0]->data[0] : "")
                      @endphp
                      @foreach($content as $data)
                        @if($chapter->data->type == "texteditor")
                        <div class="col-md-12 position-relative">
                          <input type="hidden" value="{{$chapter->data->type}}" name="items[{{$index}}][data][type]" value="text">
                          <textarea class="form-control editorMDE" id="items_id_{{$chapter->id}}_{{$index}}" name="items[{{$index}}][data][content][0][text]">{{$content[0]->text}}</textarea>
                        </div>
                        @endif
                      @endforeach
                      @else
                      <div class="col-md-12 position-relative">
                      <input type="hidden" value="texteditor" name="items[{{$index}}][data][type]" value="text">
                      <textarea class="form-control editorMDE" id="items_id_{{$chapter->id}}_{{$index}}" name="items[{{$index}}][data][content][0][text]"></textarea>
                    </div>
                      @endif



                      @if($chapter->id == 3)
                      @php
                        $tradeList = $chapter->data->content;
                        // print_r($chapter);
                        // die();
                      @endphp
                      <input type="hidden" value="table" name="items[{{$index}}][data][type]" value="table">
                      <div class="col-12 parentClone">
                      @foreach($tradeList as $n => $trade)
                      @php 
                        if(isset($trade->inci_name->id)){
                          $ids = $trade->inci_name->id;
                        }
                        
                      @endphp

                          <div class="row fh_karakterisitke canClone mixture-{{$n}}" data_id="{{$n}}" data_index="{{str_replace('id-','',$index)}}" chapter_id="{{$chapter->id}}">
                            <div class="col-xl-2 position-relative">
                              <label class="form-label" for="trade_ime[{{$n}}]">Trade ime:</label>
                              <input class="form-control form-input-replace trade_name" required id="trade_ime[{{$n}}]" value="{{$trade->trade_name}}" name="items[{{$index}}][data][content][{{$n}}][trade_name]" type="text">
                            </div>
  
                            <div class="col-xl-2 position-relative">
                              <label class="form-label" for="dobavljac_{{$chapter->id}}[{{$n}}]">Dobavljac:</label>
                              <select class="form-select form-input-replace digits select2Multi dobavljac" name="items[{{$index}}][data][content][{{$n}}][dobavljac]" id="dobavljac_{{$chapter->id}}[{{$n}}]" required>
                                  
                                  @foreach($distributors as $distributor)
                                  @if(isset($trade->dobavljac))
                                    @php $did = $trade->dobavljac; @endphp
                                  @else
                                  @php $did = 0; @endphp
                                  
                                  @endif
                                  <option @if($distributor->id == $did) selected @endif value="{{$distributor->id}}">{{$distributor->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                            <div class="col-xl-3 position-relative">
                              <label class="form-label" for="inci_{{$chapter->id}}[{{$n}}]">INCI Name:</label>
                              
                                <select class="form-select form-input-replace digits select2Multi inci_additional" required multiple name="items[{{$index}}][data][content][{{$n}}][inci_name][id][]" id="inci_{{$chapter->id}}[{{$n}}]">
                                @foreach($ingredients as $ingredient)
                                <option @if(in_array($ingredient->id,$ids)) selected @endif value="{{$ingredient->id}}">{{$ingredient->$inci_name}}</option>
                                @endforeach
                              </select>
                            </div>
                            
                            <div class="col-xl-1 position-relative">
                              <label class="form-label" for="fh_reference[{{$index}}]">Koncentracija:</label>
                              <input class="form-control form-input-replace main_conc" id="fh_reference[{{$index}}]" value="{{$trade->koncentracija}}" name="items[{{$index}}][data][content][{{$n}}][koncentracija]" type="text">
                            </div>
                            <div class="col-xl-2 position-relative">
                              <label class="form-label" for="fh_reference[{{$index}}]">Necistoce:</label>
                              <input class="form-control form-input-replace" id="fh_reference[{{$index}}]" value="{{$trade->necistoce}}" name="items[{{$index}}][data][content][{{$n}}][necistoce]" type="text">
                            </div>
                            <div class="col-xl-1 position-relative">
                              <label class="form-label" for="fh_reference[{{$index}}]">Funkcija:</label>
                              <input class="form-control form-input-replace" id="fh_reference[{{$index}}]" value="{{$trade->funkcija}}" name="items[{{$index}}][data][content][{{$n}}][funkcija]" type="text">
                            </div>
                            <div class="col-xl-1 position-relative file_parent">
                              <div class="row">
                                <div class="col-6">
                                  <label class="form-label" for="checkbox_spec[{{$index}}]">Spec.:</label>
                                  <div class="form-check checkbox mb-0">
                                      <input class="form-check-input form-input-replace iu_check" id="checkbox_spec[{{$n}}]" @if(isset($trade->specifikacije)) checked @endif type="checkbox" name="items[{{$index}}][data][content][{{$n}}][specifikacije]">
                                      <label class="form-label" for="checkbox_spec[{{$n}}]"></label>
                                    </div>
                                </div>
                                <div class="col-6">
                                  <label class="form-label" for="checkbox[{{$index}}]">I.U.:</label>
                                  <div class="form-check checkbox mb-0">
                                      <input class="form-check-input form-input-replace iu_check" id="checkbox[{{$n}}]" @if(isset($trade->ispunjava_uslove)) checked @endif type="checkbox" name="items[{{$index}}][data][content][{{$n}}][ispunjava_uslove]">
                                      <label class="form-label" for="checkbox[{{$n}}]"></label>
                                    </div>
                                </div>
                              </div>
                            </div>
                            <div class="handleParent">
                              <i class="icofont icofont-cursor-drag handle"></i>
                            </div>
                            <div class="col position-relative align-self-end text-end">
                              <a class="btn btn-square btn-info saveMixture" type="button" data-bs-original-title="" title="">save</a>
                              <a class="btn btn-square btn-danger removeItem" type="button" data-bs-original-title="" title="">x</a>
                            </div>
                          </div>
                      @endforeach
                      
                      <div class="row">
                        <div class="col-12 text-end mt-2">
                          <a class="btn btn-square btn-info" data-bs-toggle="modal" data-bs-target="#loadMixtureModal"  data-bs-original-title="" title="">load</a>
                          <a class="btn btn-square btn-success addMore" type="button" data-bs-original-title="" title="">+</a>
                        </div>
                      </div>
                      <div class="default-according style-1 faq-accordion inci_list" id="tradeList">

                      @foreach($tradeList as $n => $trade)
                        @php 
                           if(isset($trade->inci_name->id)){
                              $ids = $trade->inci_name->id;
                            }
                            $sum = 0;
                            if(isset($trade->inci_name->koncentracija)){
                              
                               $t = (array)$trade->inci_name->koncentracija;
                              $sum += array_sum($t);
                            }
                            
                        @endphp
                        <div class="card mb-2">
                            <div class="card-header">
                              <h5 class="mb-0">
                                <button type="button" class="btn btn-link collapsed inci_parent inci_p_{{$n}}" data-bs-toggle="collapse" data-bs-target="#collapseicon-tradeList_{{$n}}" aria-expanded="false" aria-controls="collapseicon-tradeList"><i class="icofont icofont-arrow-right"></i><span>{{$trade->trade_name}}</span> <sup class="all_conc">{{$sum}}%</sup></button>
                              </h5>
                            </div>
                            <div class="collapse" id="collapseicon-tradeList_{{$n}}" aria-labelledby="collapseicon-tradeList" data-bs-parent="#tradeList">
                              <div class="card-body card_{{$n}}">

                                <div class="additional_ul">
                                  <div class="additional_list_{{$n}}">
                                    <div class="row">
                                      <div class="col-2 align-self-center">
                                        <p>Additional</p>
                                      </div>
                                        <div class="col-10">
                                          <div class="row">
                                            <div class="col-3">Necistoce: <input type="text"  placeholder="" class="form-control " value="@if(isset($trade->additional->necistoce)) {{$trade->additional->necistoce}} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][necistoce]"></div>


                                            <div class="col-3">Funkcija: <input type="text"  placeholder="" class="form-control " value="@if(isset($trade->additional->funkcija)) {{$trade->additional->funkcija}} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][funkcija]"></div>

                                            <div class="col-3">Regulatorni status: <input type="text"  placeholder="" class="form-control " value="@if(isset($trade->additional->regulatory_status)) {{$trade->additional->regulatory_status }} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][regulatory_status]"> </div>

                                            <div class="col-3">Molekulska masa (MW): <input type="text"  placeholder="Text | Referenca" class="form-control " value="@if(isset($trade->additional->molekulska_masa)) {{$trade->additional->molekulska_masa }} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][molekulska_masa]"> </div>

                                            <div class="col-3">Opis: <input type="text"  placeholder="Text | Referenca" class="form-control "value="@if(isset($trade->additional->opis)) {{$trade->additional->opis}} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][opis]">  </div>

                                            <div class="col-3">Log Pow: <input type="text"  placeholder="Text | Referenca" class="form-control "value="@if(isset($trade->additional->log_pow)) {{$trade->additional->log_pow}} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][log_pow]">  </div>

                                            <div class="col-3">Tacka topljenja: <input type="text"  placeholder="Text | Referenca" class="form-control "value="@if(isset($trade->additional->tacka_topljenja)) {{$trade->additional->tacka_topljenja}} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][tacka_topljenja]">  </div>

                                            <div class="col-3">Rastvorljivost: <input type="text"  placeholder="Text | Referenca" class="form-control "value="@if(isset($trade->additional->rastvorljivost)) {{ $trade->additional->rastvorljivost}} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][rastvorljivost]">  </div>

                                            <div class="col-3">Akutna toksičnost oralno: <input type="text"  placeholder="" class="form-control "value="@if(isset($trade->additional->akutna_toksicnost_oralno)) {{ $trade->additional->akutna_toksicnost_oralno}} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][akutna_toksicnost_oralno]">  </div>

                                            <div class="col-3">Akutna toksičnost dermalno: <input type="text"  placeholder="" class="form-control "value="@if(isset($trade->additional->akutna_toksicnost_dermalno)) {{ $trade->additional->akutna_toksicnost_dermalno}} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][akutna_toksicnost_dermalno]">  </div>

                                            <div class="col-3">Akutna toksičnost inhalacija: <input type="text"  placeholder="" class="form-control "value="@if(isset($trade->additional->akutna_toksicnost_inhalacija)) {{$trade->additional->akutna_toksicnost_inhalacija}} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][akutna_toksicnost_inhalacija]">  </div>

                                            <div class="col-3">Iritacija kože/korozija: <input type="text"  placeholder="" class="form-control "value="@if(isset($trade->additional->iritacija_koze)) {{ $trade->additional->iritacija_koze }} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][iritacija_koze]">  </div>

                                            <div class="col-3">Iritacija oka: <input type="text"  placeholder="" class="form-control "value="@if(isset($trade->additional->iritacija_oka)) {{ $trade->additional->iritacija_oka }} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][iritacija_oka]">  </div>

                                            <div class="col-3">Senzitizacija: <input type="text"  placeholder="" class="form-control "value="@if(isset($trade->additional->senzitizacija)) {{ $trade->additional->senzitizacija }} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][senzitizacija]">  </div>
                                            
                                            <div class="col-3">Hronična (ponovljena) izloženost: <input type="text"  placeholder="" class="form-control "value="@if(isset($trade->additional->hronicna_ponovljena_izlozenost)) {{ $trade->additional->hronicna_ponovljena_izlozenost }} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][hronicna_ponovljena_izlozenost]">  </div>

                                            <div class="col-3">Mutagenost/Genotoksičnost: <input type="text"  placeholder="" class="form-control "value="@if(isset($trade->additional->mategenost_genotoksicnost)) {{ $trade->additional->mategenost_genotoksicnost }} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][mategenost_genotoksicnost]">  </div>

                                            <div class="col-3">Karcinogenost: <input type="text"  placeholder="" class="form-control "value="@if(isset($trade->additional->karcinogenost)) {{ $trade->additional->karcinogenost }} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][karcinogenost]">  </div>

                                            <div class="col-3">Reproduktivna toksičnost: <input type="text"  placeholder="" class="form-control "value="@if(isset($trade->additional->reproduktivna_toksicnost)) {{ $trade->additional->reproduktivna_toksicnost }} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][reproduktivna_toksicnost]">  </div>

                                            <div class="col-3">Toksikokinetički podaci: <input type="text"  placeholder="" class="form-control "value="@if(isset($trade->additional->toksikokineticki_podaci)) {{ $trade->additional->toksikokineticki_podaci }} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][toksikokineticki_podaci]">  </div>

                                            <div class="col-3">Fototoksicnost: <input type="text"  placeholder="" class="form-control "value="@if(isset($trade->additional->fototoksicnost)) {{ $trade->additional->fototoksicnost }} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][fototoksicnost]">  </div>
                                            
                                            <div class="col-3">Podaci o ispitivanjima na ljudima: <input type="text"  placeholder="" class="form-control "value="@if(isset($trade->additional->podaci_o_ispitivanjima_na_ljudima)) {{ $trade->additional->podaci_o_ispitivanjima_na_ljudima }} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][podaci_o_ispitivanjima_na_ljudima]">  </div>

                                            <div class="col-3">Ostali podaci: <input type="text"  placeholder="" class="form-control "value="@if(isset($trade->additional->ostali_podaci)) {{ $trade->additional->ostali_podaci }} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][ostali_podaci]">  </div>

                                            <div class="col-3">Zakljucak: <input type="text"  placeholder="" class="form-control "value="@if(isset($trade->additional->zakljucak)) {{ $trade->additional->zakljucak }} @endif"  name="items[{{$index}}][data][content][{{$n}}][additional][zakljucak]">  </div>


                                            <div class="col-12 references">Reference: 
                                              @if(isset($trade->additional->reference))
                                              @foreach($trade->additional->reference as $referenca)
                                              <div class="row reference">
                                                <div class="col-11">
                                                  <input type="text"  placeholder="" class="form-control " value="{{$referenca}}"  name="items[{{$index}}][data][content][{{$n}}][additional][reference][]">
                                                </div>
                                                <div class="col-1 text-end">
                                                  <a class="btn btn-square btn-danger referenceRemove" type="button" data-bs-original-title="" title="">x</a>
                                                </div>
                                              </div>
                                              @endforeach
                                              @else
                                              <div class="row reference">
                                                <div class="col-11">
                                                  <input type="text" placeholder="" class="form-control " value=""  name="items[{{$index}}][data][content][{{$n}}][additional][reference][]">
                                                </div>
                                                <div class="col-1 text-end">
                                                  <a class="btn btn-square btn-danger referenceRemove" type="button" data-bs-original-title="" title="">x</a>
                                                </div>
                                              </div>
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
                                  <div class="inci_list_{{$n}}">
                                    @php 
                                      $ingredients = App\Models\Ingredients::find($ids);
                                    @endphp
                                    @foreach($ingredients as $ingredient)
                                    <div class="row trade_li inci_li_e_{{$n}}_{{$ingredient->id}}"  data_id="{{$n}}">
                                      <div class="col-2 align-self-center">
                                        <p>{{$ingredient->$inci_name}}</p>
                                        <p>SED (mg/kgbw/day):</p>
                                        <select class="form-select sedCalc" required name="items[{{$index}}][data][content][{{$n}}][inci_name][formula][{{$ingredient->id}}]">
                                          
                                          @foreach(Config::get('app.formulas') as $formula)
                                            {{-- <option value="{{$formula}}">{{$formula}}</option> --}}
                                            <option @if(isset($trade->inci_name->formula->{$ingredient->id})) @if($trade->inci_name->formula->{$ingredient->id} == $formula) selected @endif @endif value="{{$formula}}">{{$formula}}</option>
                                          @endforeach
                                        </select>
                                        <div class="invalid-tooltip">Moras da uneses naziv proizvoda</div>
                                      </div>
                                      <div class="col-10">
                                        <div class="row">
                                          <div class="col-3">Koncentracija: <input type="text"  placeholder="Concentration 0.15-1.20" class="form-control conc_value" value="@if(isset($trade->inci_name->koncentracija->{$ingredient->id})) {{ $trade->inci_name->koncentracija->{$ingredient->id} }} @endif" name="items[{{$index}}][data][content][{{$n}}][inci_name][koncentracija][{{$ingredient->id}}]">
                                          </div>
                                          <div class="col-3">SED: <input type="text"  placeholder="SED (mg/kgbw/d)" class="form-control sed_value" value="@if(isset($trade->inci_name->sed->{$ingredient->id})) {{ $trade->inci_name->sed->{$ingredient->id} }} @endif"  name="items[{{$index}}][data][content][{{$n}}][inci_name][sed][{{$ingredient->id}}]">
                                          </div>
                                          <div class="col-3">NOAEL: <input type="text" placeholder="(mg/kgbw/d)" class="form-control noael_value" value="@if(isset($trade->inci_name->noael->{$ingredient->id})) {{ $trade->inci_name->noael->{$ingredient->id} }} @endif"  name="items[{{$index}}][data][content][{{$n}}][inci_name][noael][{{$ingredient->id}}]">
                                          </div>
                                          <div class="col-3">MoS: <input type="text" placeholder="PODsys/SED" class="form-control mos_value" value="@if(isset($trade->inci_name->mos->{$ingredient->id})) {{ $trade->inci_name->mos->{$ingredient->id} }} @endif"  name="items[{{$index}}][data][content][{{$n}}][inci_name][mos][{{$ingredient->id}}]">
                                          </div>
                                          <div class="col-3">MoS Text: <input type="text" placeholder="PODsys/SED" class="form-control mos_text" value="@if(isset($trade->inci_name->mos_text->{$ingredient->id})) {{ $trade->inci_name->mos_text->{$ingredient->id} }} @endif"  name="items[{{$index}}][data][content][{{$n}}][inci_name][mos_text][{{$ingredient->id}}]">
                                          </div>
                                          <div class="col-3">Dermalna Apsorpcija: <input type="text" placeholder="(μg/cm2)" class="form-control daa_value" value="@if(isset($trade->inci_name->dermalna_apsorpcija->{$ingredient->id})) {{ $trade->inci_name->dermalna_apsorpcija->{$ingredient->id} }} @endif"  name="items[{{$index}}][data][content][{{$n}}][inci_name][dermalna_apsorpcija][{{$ingredient->id}}]">
                                          </div>
                                          <div class="col-3">Dermalna Apsorpcija u %: <input type="text"placeholder="%" class="form-control da_value" value="@if(isset($trade->inci_name->dermalna_apsorpcija_procenti->{$ingredient->id})) {{ $trade->inci_name->dermalna_apsorpcija_procenti->{$ingredient->id} }} @endif"  name="items[{{$index}}][data][content][{{$n}}][inci_name][dermalna_apsorpcija_procenti][{{$ingredient->id}}]">
                                          </div>
                                          <div class="col-3">A: <input type="text" placeholder="(mg/kgbw/day)" class="form-control a_value" value="@if(isset($trade->inci_name->a->{$ingredient->id})) {{ $trade->inci_name->a->{$ingredient->id} }} @endif"  name="items[{{$index}}][data][content][{{$n}}][inci_name][a][{{$ingredient->id}}]">
                                          </div>
                                          <div class="col-3">SSA: <input type="text" placeholder="cm2" class="form-control ssa_value" value="@if(isset($trade->inci_name->ssa->{$ingredient->id})) {{ $trade->inci_name->ssa->{$ingredient->id} }} @endif"  name="items[{{$index}}][data][content][{{$n}}][inci_name][ssa][{{$ingredient->id}}]">
                                          </div>
                                          <div class="col-3">FFAPL: <input type="text" placeholder="Frequency of application of finished product" class="form-control fappl_value" value="@if(isset($trade->inci_name->fappl->{$ingredient->id})) {{ $trade->inci_name->fappl->{$ingredient->id} }} @endif"  name="items[{{$index}}][data][content][{{$n}}][inci_name][fappl][{{$ingredient->id}}]">
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
                        @endforeach
                      </div>
                    </div>
                      @endif
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </form>
              </div>
            </div>
          </div>
          
        </div>
      </div>
  </div>
  <!-- Container-fluid Ends-->
</div> 

@include("pages.modals.mixtureLoad")
@endsection