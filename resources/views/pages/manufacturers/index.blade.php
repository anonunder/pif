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
                      <table class="display" id="manufacturer_table" style="width:100%">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Naziv</th>
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
                    <form class="row g-3 needs-validation" id="manufacturer_form" novalidate="" method="POST" action="{{route('companiesSave')}}"> 
                        @csrf 
                        <input type="hidden" id="manufacturer_id" name="manufacturer_id" value="">
                        <div class="col-12">
                          <h6>Osnovne informacije</h6>
                          <div class="row">
                            <div class="col-md-12 position-relative">
                              <label class="form-label" for="manufacturer_name">Naziv</label>
                              <input class="form-control" id="manufacturer_name" name="manufacturer_name" type="text" required>
                              <div class="invalid-tooltip">Moras da uneses naziv</div>
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
