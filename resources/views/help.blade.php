@extends('layouts.main')

@section('content')
<!-- Page Sidebar Ends-->
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Pomoć</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item active">Pomoć</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
        <div class="container-fluid dashboard-default">
            <div class="default-according style-1 faq-accordion" id="accordionoc">
                <div class="card mb-2">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseicon-proizvodi" aria-expanded="false" aria-controls="collapseicon-aneks">Proizvodi</button>
                        </h5>
                    </div>
                    <div class="collapse" id="collapseicon-proizvodi" aria-labelledby="collapseicon-proizvodi" data-bs-parent="#accordionoc">
                    <div class="card-body">
                        <div class="default-according style-1 faq-accordion" id="accordionoc">
                        asd
                        </div>
                    </div>
                    </div>
                </div>
                


                <div class="card mb-2">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseicon-sastojci" aria-expanded="false" aria-controls="collapseicon-aneks">Sastojci</button>
                        </h5>
                    </div>
                    <div class="collapse" id="collapseicon-sastojci" aria-labelledby="collapseicon-sastojci" data-bs-parent="#accordionoc">
                    <div class="card-body">
                        <div class="default-according style-1 faq-accordion" id="accordionoc">
                        asd
                        </div>
                    </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseicon-smese" aria-expanded="false" aria-controls="collapseicon-aneks">Smeše</button>
                        </h5>
                    </div>
                    <div class="collapse" id="collapseicon-smese" aria-labelledby="collapseicon-smese" data-bs-parent="#accordionoc">
                    <div class="card-body">
                        <div class="default-according style-1 faq-accordion" id="accordionoc">
                        asd
                        </div>
                    </div>
                    </div>
                </div>


                <div class="card mb-2">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseicon-kompanije" aria-expanded="false" aria-controls="collapseicon-aneks">Kompanije</button>
                        </h5>
                    </div>
                    <div class="collapse" id="collapseicon-kompanije" aria-labelledby="collapseicon-kompanije" data-bs-parent="#accordionoc">
                    <div class="card-body">
                        <div class="default-according style-1 faq-accordion" id="accordionoc">
                        asd
                        </div>
                    </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseicon-korisnici" aria-expanded="false" aria-controls="collapseicon-aneks">Korisnici</button>
                        </h5>
                    </div>
                    <div class="collapse" id="collapseicon-korisnici" aria-labelledby="collapseicon-korisnici" data-bs-parent="#accordionoc">
                    <div class="card-body">
                        <div class="default-according style-1 faq-accordion" id="accordionoc">
                        asd
                        </div>
                    </div>
                    </div>
                </div>

                <div class="card mb-2">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <button type="button" class="btn btn-link collapsed" data-bs-toggle="collapse" data-bs-target="#collapseicon-sadrzaj" aria-expanded="false" aria-controls="collapseicon-aneks">Sadržaj</button>
                        </h5>
                    </div>
                    <div class="collapse" id="collapseicon-sadrzaj" aria-labelledby="collapseicon-sadrzaj" data-bs-parent="#accordionoc">
                    <div class="card-body">
                        <div class="default-according style-1 faq-accordion" id="accordionoc">
                        asd
                        </div>
                    </div>
                    </div>
                </div>

            </div>
        </div>
          <!-- Container-fluid Ends-->
    </div>
@endsection
