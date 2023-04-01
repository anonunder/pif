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
  <!-- Container-fluid starts-->
  <div class="container-fluid dashboard-default">
    <div class="row">
      <div class="col-sm-12">
        <div class="card">
          <div class="card-body">
            <form class="row g-3 needs-validation" novalidate="" method="POST" action="{{route('ingrediendsStore')}}"> @csrf <div class="col-12">
                <h6>Osnovne informacije</h6>
                <div class="row">
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="inciName">INCI Name</label>
                    <input class="form-control" id="inciName" name="inci_name" type="text" required>
                    <div class="invalid-tooltip">Moras da uneses INCI naziv</div>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="casNumber">CAS Number</label>
                    <input class="form-control" id="casNumber" name="cas_number" type="text" required>
                    <div class="invalid-tooltip">Moras da uneses CAS broj</div>
                  </div>
                </div>
              </div>
              <hr>
              <div class="col-12 parentClone">
                <h6>Kompozicije</h6>
                <div class="row kompozicija canClone" data_id="0">
                  <div class="col-md position-relative">
                    <label class="form-label" for="k_chemical_name[0]">Chemical name:</label>
                    <textarea class="form-control" id="k_chemical_name[0]" name="items[kompozicija][0][chemical_name]" type="text"></textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="concetration[0]">Concentration (%):</label>
                    <textarea class="form-control" id="concetration[0]" name="items[kompozicija][0][concetration]" type="text"></textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="k_cas_no[0]">CAS No:</label>
                    <textarea class="form-control" id="k_cas_no[0]" name="items[kompozicija][0][cas_no]" type="text"></textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="k_ec_no[0]">EC No:</label>
                    <textarea class="form-control" id="k_ec_no[0]" name="items[kompozicija][0][ec_no]" type="text"></textarea>
                  </div>
                  <div class="col-1 position-relative align-self-end text-end">
                    <button class="btn btn-square btn-danger removeItem" type="button" data-bs-original-title="" title="">x</button>
                  </div>
                </div>
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
                    <textarea class="form-control editorMDE" id="necistoce" name="necistoce" type="text" ></textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="funkcija">Funkcija:</label>
                    <textarea class="form-control editorMDE" id="funkcija" name="funkcija" type="text" ></textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="regulatory_status">Regulatorni status:</label>
                    <textarea class="form-control editorMDE" id="regulatory_status" name="regulatory_status" type="text" >Uredba 1223/2009 EU: <br>Direktiva 1227/2008 EC: </textarea>
                  </div>
                </div>
              </div>
              <hr>
              <div class="col-12 parentClone">
                <h6>Fizičko-hemijske karakteristike</h6>
                <div class="row fh_karakterisitke canClone" data_id="0">
                  <div class="col-md position-relative">
                    <label class="form-label" for="kt_karakteristika[0]">Karakteristike:</label>
                    <textarea class="form-control" id="kt_karakteristika[0]" name="items[fh_karakteristika][0][karakteristike]">Molekulska masa (MW)</textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="fh_vrednost[0]">Vrednost:</label>
                    <textarea class="form-control" id="fh_vrednost[0]" name="items[fh_karakteristika][0][vrednost]" ></textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="fh_reference[0]">Reference:</label>
                    <textarea class="form-control" id="fh_reference[0]" name="items[fh_karakteristika][0][reference]"></textarea>
                  </div>
                  <div class="col-1 position-relative align-self-end text-end">
                    <button class="btn btn-square btn-danger removeItem" type="button" data-bs-original-title="" title="">x</button>
                  </div>
                </div>
                
                <div class="row fh_karakterisitke canClone" data_id="1">
                  <div class="col-md position-relative">
                    <label class="form-label" for="kt_karakteristika[1]">Karakteristike:</label>
                    <textarea class="form-control" id="kt_karakteristika[1]" name="items[fh_karakteristika][1][karakteristike]">Opis</textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="fh_vrednost[1]">Vrednost:</label>
                    <textarea class="form-control" id="fh_vrednost[1]" name="items[fh_karakteristika][1][vrednost]" ></textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="fh_reference[1]">Reference:</label>
                    <textarea class="form-control" id="fh_reference[1]" name="items[fh_karakteristika][1][reference]" ></textarea>
                  </div>
                  <div class="col-1 position-relative align-self-end text-end">
                    <button class="btn btn-square btn-danger removeItem" type="button" data-bs-original-title="" title="">x</button>
                  </div>
                </div>

                <div class="row fh_karakterisitke canClone" data_id="2">
                  <div class="col-md position-relative">
                    <label class="form-label" for="kt_karakteristika[2]">Karakteristike:</label>
                    <textarea class="form-control" id="kt_karakteristika[2]" name="items[fh_karakteristika][2][karakteristike]">Log Pow</textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="fh_vrednost[2]">Vrednost:</label>
                    <textarea class="form-control" id="fh_vrednost[2]" name="items[fh_karakteristika][2][vrednost]" ></textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="fh_reference[2]">Reference:</label>
                    <textarea class="form-control" id="fh_reference[2]" name="items[fh_karakteristika][2][reference]"></textarea>
                  </div>
                  <div class="col-1 position-relative align-self-end text-end">
                    <button class="btn btn-square btn-danger removeItem" type="button" data-bs-original-title="" title="">x</button>
                  </div>
                </div>

                <div class="row fh_karakterisitke canClone" data_id="3">
                  <div class="col-md position-relative">
                    <label class="form-label" for="kt_karakteristika[3]">Karakteristike:</label>
                    <textarea class="form-control" id="kt_karakteristika[3]" name="items[fh_karakteristika][3][karakteristike]" >Tačka topljenja</textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="fh_vrednost[3]">Vrednost:</label>
                    <textarea class="form-control" id="fh_vrednost[3]" name="items[fh_karakteristika][3][vrednost]" ></textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="fh_reference[3]">Reference:</label>
                    <textarea class="form-control" id="fh_reference[3]" name="items[fh_karakteristika][3][reference]" ></textarea>
                  </div>
                  <div class="col-1 position-relative align-self-end text-end">
                    <button class="btn btn-square btn-danger removeItem" type="button" data-bs-original-title="" title="">x</button>
                  </div>
                </div>

                <div class="row fh_karakterisitke canClone" data_id="4">
                  <div class="col-md position-relative">
                    <label class="form-label" for="kt_karakteristika[4]">Karakteristike:</label>
                    <textarea class="form-control" id="kt_karakteristika[4]" name="items[fh_karakteristika][4][karakteristike]"  >Rastvorljivost</textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="fh_vrednost[4]">Vrednost:</label>
                    <textarea class="form-control" id="fh_vrednost[4]" name="items[fh_karakteristika][4][vrednost]" ></textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="fh_reference[4]">Reference:</label>
                    <textarea class="form-control" id="fh_reference[4]" name="items[fh_karakteristika][4][reference]" ></textarea>
                  </div>
                  <div class="col-1 position-relative align-self-end text-end">
                    <button class="btn btn-square btn-danger removeItem" type="button" data-bs-original-title="" title="">x</button>
                  </div>
                </div>

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
                    <textarea class="form-control editorMDE" id="akutna_toksicnost_oralno" name="akutna_toksicnost_oralno" type="text" >LD50></textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="akutna_toksicnost_dermalno">Akutna toksičnost dermalno:</label>
                    <textarea class="form-control editorMDE" id="akutna_toksicnost_dermalno" name="akutna_toksicnost_dermalno" type="text" >LD50></textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="akutna_toksicnost">Akutna toksičnost,inhalaciono:</label>
                    <textarea class="form-control editorMDE" id="akutna_toksicnost" name="akutna_toksicnost" type="text" >LD50>

                    </textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="iritacija_koze">Iritacija kože/korozija:</label>
                    <textarea class="form-control editorMDE" id="iritacija_koze" name="iritacija_koze" type="text" ></textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="iritacija_oka">Iritacija oka:</label>
                    <textarea class="form-control editorMDE" id="iritacija_oka" name="iritacija_oka" type="text" ></textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="senzitizacija">Senzitizacija:</label>
                    <textarea class="form-control editorMDE" id="senzitizacija" name="senzitizacija" type="text" ></textarea>
                  </div>
                </div>
              </div>
              <div class="col-12 parentClone">
                <h6>Dermalna apsorpcija:</h6>
                <div class="row d_apsorpcija canClone" >
                  <div class="col-md position-relative">
                    <label class="form-label" for="d_vrednost">Vrednost (%):</label>
                    <textarea class="form-control" id="d_vrednost" name="items[d_apsorpcija][vrednost]" type="text"></textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="d_komentar">Komentar/zaključak:</label>
                    <textarea class="form-control" id="d_komentar" name="items[d_apsorpcija][komentar]" type="text"></textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="d_reference">Reference:</label>
                    <textarea class="form-control" id="d_reference" name="items[d_apsorpcija][reference]" type="text"></textarea>
                  </div>
                </div>
              </div>
              <hr>
              <div class="col-12 parentClone">
                <div class="row kompozicija" >
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="hronicna_izlozenost">Hronična (ponovljena) izloženost:</label>
                    <textarea class="form-control editorMDE" id="hronicna_izlozenost" name="hronicna_izlozenost" type="text" ></textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="muragenost_genotoksicnost">Mutagenost/Genotoksičnost:</label>
                    <textarea class="form-control editorMDE" id="muragenost_genotoksicnost" name="muragenost_genotoksicnost" type="text" ></textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="karcinogenost">Karcinogenost:</label>
                    <textarea class="form-control editorMDE" id="karcinogenost" name="karcinogenost" type="text" ></textarea>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="row kompozicija">
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="reproduktivna_toksicnost">Reproduktivna toksičnost:</label>
                    <textarea class="form-control editorMDE" id="reproduktivna_toksicnost" name="reproduktivna_toksicnost" type="text" ></textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="toksikokineticki_podaci">Toksikokinetički podaci:</label>
                    <textarea class="form-control editorMDE" id="toksikokineticki_podaci" name="toksikokineticki_podaci" type="text" ></textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="fototoksicnost">Fototoksičnost:</label>
                    <textarea class="form-control editorMDE" id="fototoksicnost" name="fototoksicnost" type="text" ></textarea>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="row kompozicija">
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="podaci_o_ispitivanjima_ljudi">Podaci o ispitivanjima na ljudima:</label>
                    <textarea class="form-control editorMDE" id="podaci_o_ispitivanjima_ljudi" name="podaci_o_ispitivanjima_ljudi" type="text" ></textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="ostali_podaci">Ostali podaci:</label>
                    <textarea class="form-control editorMDE" id="ostali_podaci" name="ostali_podaci" type="text"></textarea>
                  </div>
                </div>
              </div>
              <hr>
              <div class="col-12 parentClone">
                <h6>NOAEL vrednosti za procenu rizika</h6>
                <div class="row noael" data_id="0">
                  <div class="col-md position-relative">
                    <label class="form-label" for="n_noael">NOAEL(mg/kgbw/d):</label>
                    <textarea class="form-control" id="n_noael" name="items[noael][noael]" type="text"></textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="n_inhalation">NOAEC inhalation:</label>
                    <textarea class="form-control" id="n_inhalation" name="items[noael][inhalation]" type="text"></textarea>
                  </div>
                  <div class="col-md position-relative">
                    <label class="form-label" for="n_reference">Reference:</label>
                    <textarea class="form-control" id="n_reference" name="items[noael][reference]" type="text"></textarea>
                  </div>
                </div>
              </div>
              <hr>
              
              <div class="col-12">
                <div class="row kompozicija">
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="zakljucak">Zakljucak:</label>
                    <textarea class="form-control editorMDE" id="zakljucak" name="zakljucak" type="text" ></textarea>
                  </div>
                  <div class="col-md-12 position-relative">
                    <label class="form-label" for="z_ostali_podaci">Ostali podaci:</label>
                    <textarea class="form-control editorMDE" id="z_ostali_podaci" name="z_ostali_podaci" type="text" ></textarea>
                  </div>
                </div>
              </div>
              <div class="col-12 parentClone">
                <h6>Reference</h6>
                <div class="row kompozicija canClone" data_id="0">
                  <div class="col-11 position-relative">
                    <label class="form-label" for="r_text[0]">Text:</label>
                    <textarea class="form-control" id="r_text[0]" name="items[reference][0][text]" type="text"></textarea>
                  </div>
                  <div class="col-1 position-relative align-self-end text-end">
                    <button class="btn btn-square btn-danger removeItem" type="button" data-bs-original-title="" title="">x</button>
                  </div>
                </div>
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