@extends('layouts.main')

@section('content')
<!-- Page Sidebar Ends-->
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Firme</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item active">Firme</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid dashboard-default">
            <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive theme-scrollbar">
                      <table class="display" id="company_table" style="width:100%">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Naziv</th>
                            <th>Duze ime</th>
                            <th>Adresa</th>
                            <th>PIB</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Ajax sourced data Ends-->
            <div class="col-sm-12">
                <div class="card">
                  <div class="card-body">
                    <form class="row g-3 needs-validation" id="company_form" novalidate="" method="POST" action="{{route('companiesSave')}}"> 
                        @csrf 
                        <input type="hidden" id="company_id" name="company_id" value="">
                        <div class="col-12">
                          <h6>Osnovne informacije</h6>
                          <div class="row">
                            <div class="col-md-12 position-relative">
                              <label class="form-label" for="company_name">Naziv</label>
                              <input class="form-control" id="company_name" name="company_name" type="text" required>
                              <div class="invalid-tooltip">Moras da uneses naziv</div>
                            </div>
                            <div class="col-md-12 position-relative">
                              <label class="form-label" for="company_responsible_person">Odgovorna osoba</label>
                              <input class="form-control" id="company_responsible_person" name="company_responsible_person" type="text" required>
                              <div class="invalid-tooltip">Moras da uneses ime odgovorne osobe</div>
                            </div>
                            <div class="col-md-12 position-relative">
                              <label class="form-label" for="company_email">Email</label>
                              <input class="form-control" id="company_email" name="company_email" type="text" required>
                              <div class="invalid-tooltip">Moras da uneses email</div>
                            </div>
                            <div class="col-md-12 position-relative">
                              <label class="form-label" for="company_phone">Broj telefona</label>
                              <input class="form-control" id="company_phone" name="company_phone" type="text" required>
                              <div class="invalid-tooltip">Moras da uneses broj telefona</div>
                            </div>
                            <div class="col-md-12 position-relative">
                              <label class="form-label" for="company_address">Adresa</label>
                              <input class="form-control" id="company_address" name="company_address" type="text" required>
                              <div class="invalid-tooltip">Moras da uneses adresu firme</div>
                            </div>
                            <div class="col-md-12 position-relative">
                              <label class="form-label" for="company_pib">PIB</label>
                              <input class="form-control" id="company_pib" name="company_pib" type="text" required>
                              <div class="invalid-tooltip">Moras da uneses PIB</div>
                            </div>
                            <div class="col-md-12 position-relative">
                              <label class="form-label" for="company_id_number">Maticni broj</label>
                              <input class="form-control" id="company_id_number" name="company_id_number" type="text" required>
                              <div class="invalid-tooltip">Moras da uneses maticni broj</div>
                            </div>
                            <div class="col-md-12 position-relative">
                              <label class="form-label" for="company_contact_phone">Kontakt broj</label>
                              <input class="form-control" id="company_contact_phone" name="company_contact_phone" type="text" required>
                              <div class="invalid-tooltip">Moras da uneses kontakt broj</div>
                            </div>

                            <div class="col-6 mt-2">
                                <button class="btn btn-info" saveasnew type="submit">Sacuvaj kao novo</button>
                              </div>
                              <div class="col-6 mt-2 text-end">
                                <button class="btn btn-primary" type="submit">Sacuvaj</button>
                              </div>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
@endsection
