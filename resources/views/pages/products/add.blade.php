@extends('layouts.main') @section('content')
<!-- Page Sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-sm-6">
          <h3>Proizvodi</h3>
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
                  <input type="hidden" value="{{session()->get('locale')}}" name="product_locale">
                    <div class="col-12 mt-2">
                        <button class="btn btn-primary" type="submit">Save</button>
                      </div>
                    @csrf

                    <div class="col-10">
                      <div class="row">
                        <div class="col-md-4 position-relative">
                          <label class="form-label" for="inciName">Naziv proizvoda</label>
                          <input class="form-control" id="inciName" name="product_name" value="" type="text" required="">
                          <div class="invalid-tooltip">Moras da uneses naziv proizvoda</div>
                      </div>
                      <div class="col-md-4 position-relative">
                          <label class="form-label" for="company">Firma</label>
                          <select class="form-select digits" name="product_company" id="company">
                              @foreach($companies as $company)
                              <option value="{{$company->id}}">{{$company->name}}</option>
                              @endforeach
                            </select>
                          <div class="invalid-tooltip">Moras da uneses naziv proizvoda</div>
                      </div>
                      <div class="col-md-4 position-relative">
                        <label class="form-label" for="product_status">Status</label>
                        <select class="form-select digits" name="product_status" id="product_status">
                          <option value="0">Neobjavljeno</option>
                          <option value="1">Objavljeno</option>
                        </select>
                        <div class="invalid-tooltip">Moras da izaberes status</div>
                    </div>
                      
                      
                      <div class="col-6 position-relative">
                          <label class="form-label" for="datum">Datum</label>
                          <input class="form-control digits" type="date" name="product_create_date" value="{{\Carbon\Carbon::now()->format('Y-m-d')}}" data-bs-original-title="" title="">
                          <div class="invalid-tooltip">Moras da uneses datum</div>
                      </div>
                      
                      <div class="col-6 position-relative">
                          <label class="form-label" for="inciName">Broj formule</label>
                          <input class="form-control" id="inciName" name="number_formula" value="" type="text" required="">
                          <div class="invalid-tooltip">Moras da uneses broj formule</div>
                      </div>
                      <div class="col-6 position-relative">
                          <label class="form-label" for="inciName">Verzija</label>
                          <input class="form-control" id="inciName" name="product_version" value="" type="text" required="">
                          <div class="invalid-tooltip">Moras da uneses verziju proizvoda</div>
                      </div>
                      <div class="col-6 position-relative">
                          <label class="form-label" for="inciName">Kategorija</label>
                          <input class="form-control" id="inciName" name="product_category" value="" type="text" required="">
                          <div class="invalid-tooltip">Moras da uneses verziju proizvoda</div>
                      </div>
                      </div>
                      
                    </div>
                    <div class="col-2">
                      <img src="/noimage.jpg" class="w-100" id="product_image_preview">
                      <input class="form-control " type="file" id="product_image" value="/noimage.jpg" name="product_image" data-bs-original-title="" title="">
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
                              <div class="dropzone dropzone-primary multiFileUpload" type="{{$code}}" action="#">
                                <div class="dz-message needsclick"><i class="icon-cloud-up"></i>
                                </div>
                              </div>
                              <ol style="margin-top: 20px;" class="lista_fajlova lf_{{$code}}">
                               
                              </ol>
                            </div>
                          </div>
                        </div>
                        @endforeach
                      </div>


                    </div>
                  </div>
                </div>
                
                <div id="aneksi"></div>

                @foreach($chapters as $index => $chapter)
                @php 
                  $name      = "name_".session()->get('locale');
                  $inci_name = "inci_name_".session()->get('locale');
                  $content   = "content_".session()->get('locale');
                @endphp
                

                <div class="card mb-2">
                  <input type="hidden" value="{{$chapter->id}}" name="items[id-{{$index}}][id]">
                  <input type="hidden" value="{{$chapter->$name}}" name="items[id-{{$index}}][chapter_name]">
                  <div class="card-header">
                    <h5 class="mb-0">
                      <button type="button" class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseicon-{{$chapter->id}}" aria-expanded="false" aria-controls="collapseicon-{{$chapter->id}}">{{$chapter->$name}}</button>
                    </h5>
                  </div>
                  <div class="collapse" id="collapseicon-{{$chapter->id}}" aria-labelledby="collapseicon-{{$chapter->id}}" data-bs-parent="#accordionoc">
                    <div class="card-body">
                      @if(!empty($chapter->$content))
                      @php $content = json_decode($chapter->$content); @endphp
                      @foreach($content as $data)
                        @if($data->type == "texteditor")
                        <div class="col-md-12 position-relative">
                          <input type="hidden" value="{{$data->type}}" name="items[id-{{$index}}][data][type]" value="text">
                          <textarea class="form-control editorMDE" id="items_id_{{$chapter->id}}_{{$index}}" name="items[id-{{$index}}][data][content][0][text]">{{$content[0]->data[0]}}</textarea>
                        </div>
                        @endif
                      @endforeach
                      @endif



                      @if($chapter->id == 3)
                      <input type="hidden" value="table" name="items[id-{{$index}}][data][type]" value="table">
                      <div class="col-12 parentClone">
                        <div class="row fh_karakterisitke canClone mixture-0" data_id="0" data_index="2" chapter_id="{{$chapter->id}}">
                          <div class="col-xl-2 position-relative">
                            <label class="form-label" for="trade_ime[0]">Trade ime:</label>
                            <input class="form-control form-input-replace trade_name" required id="trade_ime[0]" name="items[id-{{$index}}][data][content][0][trade_name]" type="text">
                          </div>

                          <div class="col-xl-2 position-relative">
                            <label class="form-label" for="dobavljac_{{$chapter->id}}[0]">Dobavljac:</label>
                            <select class="form-select form-input-replace digits select2Multi dobavljac" name="items[id-{{$index}}][data][content][0][dobavljac]" id="dobavljac_{{$chapter->id}}[0]" required>
                                
                                @foreach($distributors as $distributor)
                                <option value="{{$distributor->id}}">{{$distributor->name}}</option>
                                @endforeach
                              </select>
                          </div>
                          <div class="col-xl-3 position-relative">
                            <label class="form-label" for="inci_{{$chapter->id}}[0]">INCI Name:</label>
                            <select class="form-select form-input-replace digits select2Multi inci_additional" multiple name="items[id-{{$index}}][data][content][0][inci_name][id][]" id="inci_{{$chapter->id}}[0]">
                                @foreach($ingredients as $ingredient)
                                <option value="{{$ingredient->id}}">{{$ingredient->$inci_name}}</option>
                                @endforeach
                              </select>
                          </div>

                          <div class="col-xl-1 position-relative">
                            <label class="form-label" for="fh_reference[{{$index}}]">Koncentracija:</label>
                            <input class="form-control form-input-replace main_conc" id="fh_reference[{{$index}}]" name="items[id-{{$index}}][data][content][0][koncentracija]" type="text">
                          </div>
                          <div class="col-xl-2 position-relative">
                            <label class="form-label" for="fh_reference[{{$index}}]">Necistoce:</label>
                            <input class="form-control form-input-replace" id="fh_reference[{{$index}}]" name="items[id-{{$index}}][data][content][0][necistoce]" type="text">
                          </div>
                          <div class="col-xl-1 position-relative">
                            <label class="form-label" for="fh_reference[{{$index}}]">Funkcija:</label>
                            <input class="form-control form-input-replace" id="fh_reference[{{$index}}]" name="items[id-{{$index}}][data][content][0][funkcija]" type="text">
                          </div>
                          <div class="col-xl-1 position-relative file_parent">
                            <div class="row">
                              <div class="col-6">
                                <label class="form-label" for="checkbox_spec[{{$index}}]">Spec.:</label>
                                <div class="form-check checkbox mb-0">
                                    <input class="form-check-input form-input-replace iu_check" id="checkbox_spec[0]" type="checkbox" name="items[id-{{$index}}][data][content][0][specifikacije]">
                                    <label class="form-label" for="checkbox_spec[0]"></label>
                                  </div>
                              </div>
                              <div class="col-6">
                                <label class="form-label" for="checkbox[{{$index}}]">I.U.:</label>
                                <div class="form-check checkbox mb-0">
                                    <input class="form-check-input form-input-replace iu_check" id="checkbox[0]" type="checkbox" name="items[id-{{$index}}][data][content][0][ispunjava_uslove]">
                                    <label class="form-label" for="checkbox[0]"></label>
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
                        <div class="row">
                          <div class="col-12 text-end mt-2">
                            <a class="btn btn-square btn-info" data-bs-toggle="modal" data-bs-target="#loadMixtureModal"  data-bs-original-title="" title="">load</a>
                            <a class="btn btn-square btn-success addMore" type="button" data-bs-original-title="" title="">+</a>
                          </div>
                        </div>
                        <div class="default-according style-1 faq-accordion inci_list" id="tradeList">
                          
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