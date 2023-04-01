@extends('layouts.main') @section('content')
<!-- Page Sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-sm-6">
          <h3>Ingredients</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item active">Ingredients</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  @php
  $locale = session()->get('locale');
  $name   = "inci_name_".$locale;
  @endphp
  <!-- Container-fluid starts-->
  <div class="container-fluid dashboard-default">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <form class="row g-3 needs-validation" novalidate="" method="POST" action="{{route('ingrediendsStore')}}"> 
              @csrf 
              <input type="hidden" name="ingredient_id" value="{{$ingredient->id}}">
              <div class="col-12">
                <h6>Osnovne informacije</h6>
                <div class="row">
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="inciName">INCI Name</label>
                    <input class="form-control" id="inciName" name="inci_name" value="{{$ingredient->$name}}" type="text" required>
                    <div class="invalid-tooltip">Moras da uneses INCI naziv</div>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="casNumber">CAS Number</label>
                    <input class="form-control" id="casNumber" name="cas_number" value="{{$ingredient->cas_number}}" type="text" required>
                    <div class="invalid-tooltip">Moras da uneses CAS broj</div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="col-12 parentClone">
                <h6>Kompozicije</h6>
                @foreach($items->items->kompozicija as $index => $value)
                <div class="row kompozicija canClone" data_id="{{$index}}">
                  <div class="col-md position-relative">
                    <label class="form-label" for="k_chemical_name[{{$index}}]">Chemical name:</label>
                    <textarea class="form-control" id="k_chemical_name[{{$index}}]" name="items[kompozicija][{{$index}}][chemical_name]" type="text">@if(isset($value->chemical_name)){!!$value->chemical_name!!} @endif</textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="concetration[{{$index}}]">Concentration (%):</label>
                    <textarea class="form-control" id="concetration[{{$index}}]" name="items[kompozicija][{{$index}}][concetration]" type="text">{!!$value->concetration!!}</textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="k_cas_no[{{$index}}]">CAS No:</label>
                    <textarea class="form-control" id="k_cas_no[{{$index}}]" name="items[kompozicija][{{$index}}][cas_no]" type="text">{!!$value->cas_no!!}</textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="k_ec_no[{{$index}}]">EC No:</label>
                    <textarea class="form-control" id="k_ec_no[{{$index}}]" name="items[kompozicija][{{$index}}][ec_no]" type="text">{!!$value->ec_no!!}</textarea>
                  </div>
                  <div class="col-1 position-relative align-self-end text-end">

                    <button class="btn btn-square btn-info removeItem" type="button" data-bs-original-title="" title="">x</button>
                  </div>
                </div>
                @endforeach
                <div class="row">
                  <div class="col-12 text-end mt-2">
                    <button class="btn btn-square btn-success addMore" type="button" data-bs-original-title="" title="">+</button>
                  </div>
                </div>
              </div>
              <hr>
              <div class="col-12">
                <div class="row">
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="necistoce">Nečistoće:</label>
                    <textarea class="form-control editorMDE" id="necistoce" name="necistoce">{!!$items->necistoce!!}</textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="funkcija">Funkcija:</label>
                    <textarea class="form-control editorMDE" id="funkcija" name="funkcija">{!!$items->funkcija!!}</textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="regulatory_status">Regulatorni status:</label>
                    <textarea class="form-control editorMDE" id="regulatory_status" name="regulatory_status">{!!$items->regulatory_status!!}</textarea>
                  </div>
                </div>
              </div>
              <hr>
              <div class="col-12 parentClone">
                <h6>Fizičko-hemijske karakteristike</h6>
                @foreach($items->items->fh_karakteristika as $index => $value)
                <div class="row fh_karakterisitke canClone" data_id="{{$index}}">
                  <div class="col-md position-relative">
                    <label class="form-label" for="kt_karakteristika[{{$index}}]">Karakteristike:</label>
                    <textarea class="form-control" id="kt_karakteristika[{{$index}}]" name="items[fh_karakteristika][{{$index}}][karakteristike]">{!!$value->karakteristike!!}</textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="fh_vrednost[{{$index}}]">Vrednost:</label>
                    <textarea class="form-control" id="fh_vrednost[{{$index}}]" name="items[fh_karakteristika][{{$index}}][vrednost]">{!!$value->vrednost!!}</textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="fh_reference[{{$index}}]">Reference:</label>
                    <textarea class="form-control" id="fh_reference[{{$index}}]" name="items[fh_karakteristika][{{$index}}][reference]">{!!$value->reference!!}</textarea>
                  </div>
                  <div class="col-1 position-relative align-self-end text-end">
                    <button class="btn btn-square btn-danger removeItem" type="button" data-bs-original-title="" title="">x</button>
                  </div>
                </div>
                @endforeach
                <div class="row">
                  <div class="col-12 text-end mt-2">
                    <button class="btn btn-square btn-success addMore" type="button" data-bs-original-title="" title="">+</button>
                  </div>
                </div>
              </div>
              <hr>
              <div class="col-12">
                <h6>Toksikološki podaci</h6>
                <div class="row fh_karakterisitke">
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="akutna_toksicnost_oralno">Akutna toksičnost oralno:</label>
                    <textarea class="form-control editorMDE" id="akutna_toksicnost_oralno" name="akutna_toksicnost_oralno">{!!$items->akutna_toksicnost_oralno!!}</textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="akutna_toksicnost_dermalno">Akutna toksičnost dermalno:</label>
                    <textarea class="form-control editorMDE" id="akutna_toksicnost_dermalno" name="akutna_toksicnost_dermalno">{!!$items->akutna_toksicnost_dermalno!!}</textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="akutna_toksicnost">Akutna toksičnost,inhalaciono:</label>
                    <textarea class="form-control editorMDE" id="akutna_toksicnost" name="akutna_toksicnost">{!!$items->akutna_toksicnost!!}</textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="iritacija_koze">Iritacija kože/korozija:</label>
                    <textarea class="form-control editorMDE" id="iritacija_koze" name="iritacija_koze">{!!$items->iritacija_koze!!}</textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="iritacija_oka">Iritacija oka:</label>
                    <textarea class="form-control editorMDE" id="iritacija_oka" name="iritacija_oka">{!!$items->iritacija_oka!!}</textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="senzitizacija">Senzitizacija:</label>
                    <textarea class="form-control editorMDE" id="senzitizacija" name="senzitizacija">{!!$items->senzitizacija!!}</textarea>
                  </div>
                </div>
              </div>
              <div class="col-12 parentClone">
                <h6>Dermalna apsorpcija:</h6>
                <div class="row d_apsorpcija">

                  <div class="col-md position-relative">
                    <label class="form-label" for="d_vrednost">Vrednost (%):</label>
                    <textarea class="form-control" id="d_vrednost" name="items[d_apsorpcija][vrednost]">{!!$items->items->d_apsorpcija->vrednost!!}</textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="d_komentar">Komentar/zaključak:</label>
                    <textarea class="form-control" id="d_komentar" name="items[d_apsorpcija][komentar]">{!!$items->items->d_apsorpcija->komentar!!}</textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="d_reference">Reference:</label>
                    <textarea class="form-control" id="d_reference" name="items[d_apsorpcija][reference]">{!!$items->items->d_apsorpcija->reference!!}</textarea>
                  </div>
                </div>
              </div>
              <hr>
              <div class="col-12 parentClone">
                <div class="row kompozicija" >
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="hronicna_izlozenost">Hronična (ponovljena) izloženost:</label>
                    <textarea class="form-control editorMDE" id="hronicna_izlozenost" name="hronicna_izlozenost">{!!$items->hronicna_izlozenost!!}</textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="muragenost_genotoksicnost">Muragenost/Genotoksičnost:</label>
                    <textarea class="form-control editorMDE" id="muragenost_genotoksicnost" name="muragenost_genotoksicnost" >{!!$items->muragenost_genotoksicnost!!}</textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="karcinogenost">Karcinogenost:</label>
                    <textarea class="form-control editorMDE" id="karcinogenost" name="karcinogenost">{!!$items->karcinogenost!!}</textarea>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="row kompozicija">
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="reproduktivna_toksicnost">Reproduktivna toksičnost:</label>
                    <textarea class="form-control editorMDE" id="reproduktivna_toksicnost" name="reproduktivna_toksicnost" >{!!$items->reproduktivna_toksicnost!!}</textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="toksikokineticki_podaci">Toksikokinetički podaci:</label>
                    <textarea class="form-control editorMDE" id="toksikokineticki_podaci" name="toksikokineticki_podaci">{!!$items->toksikokineticki_podaci!!}</textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="fototoksicnost">Fototoksičnost:</label>
                    <textarea class="form-control editorMDE" id="fototoksicnost" name="fototoksicnost"></textarea>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="row kompozicija">
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="podaci_o_ispitivanjima_ljudi">Podaci o ispitivanjima na ljudima:</label>
                    <textarea class="form-control editorMDE" id="podaci_o_ispitivanjima_ljudi" name="podaci_o_ispitivanjima_ljudi" >{!!$items->podaci_o_ispitivanjima_ljudi!!}</textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="ostali_podaci">Ostali podaci:</label>
                    <textarea class="form-control editorMDE" id="ostali_podaci" name="ostali_podaci">{!!$items->ostali_podaci!!}</textarea>
                  </div>
                </div>
              </div>
              <hr>
              <div class="col-12 parentClone">
                <h6>NOAEL vrednosti za procenu rizika</h6>
                <div class="row noael">
                  <div class="col-md position-relative">
                    <label class="form-label" for="n_noael">NOAEL(mg/kgbw/d):</label>
                    <textarea class="form-control" id="n_noael" name="items[noael][noael]">{!!$items->items->noael->noael!!}</textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="n_inhalation">NOAEC inhalation:</label>
                    <textarea class="form-control" id="n_inhalation" name="items[noael][inhalation]">{!!$items->items->noael->inhalation!!}</textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="n_reference">Reference:</label>
                    <textarea class="form-control" id="n_reference" name="items[noael][reference]">{!!$items->items->noael->reference!!}</textarea>
                  </div>
                </div>
              </div>
              <hr>
              <div class="col-12">
                <div class="row kompozicija">
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="zakljucak">Zakljucak:</label>
                    <textarea class="form-control editorMDE" id="zakljucak" name="zakljucak">{!!$items->zakljucak!!}</textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="z_ostali_podaci">Ostali podaci:</label>
                    <textarea class="form-control editorMDE" id="z_ostali_podaci" name="z_ostali_podaci">{!!$items->z_ostali_podaci!!}</textarea>
                  </div>
                </div>
              </div>
              <div class="col-12 parentClone">
                <h6>Reference</h6>
                @foreach($items->items->reference as $index => $value)
                <div class="row kompozicija canClone" data_id="{{$index}}">
                  <div class="col-11 position-relative">
                    <label class="form-label" for="r_text[{{$index}}]">Text:</label>
                    <textarea class="form-control" id="r_text[{{$index}}]" name="items[reference][{{$index}}][text]">{!!$value->text!!}</textarea>
                  </div>
                  <div class="col-1 position-relative align-self-end text-end">
                    <button class="btn btn-square btn-danger removeItem" type="button" data-bs-original-title="" title="">x</button>
                  </div>
                </div>
                @endforeach
                <div class="row">
                  <div class="col-12 text-end mt-2">
                    <button class="btn btn-square btn-success addMore" type="button" data-bs-original-title="" title="">+</button>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <button class="btn btn-primary" type="submit">Sacuvaj</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends-->
</div> @endsection