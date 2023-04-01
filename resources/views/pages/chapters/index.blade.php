@extends('layouts.main')

@section('content')
<!-- Page Sidebar Ends-->
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <h3>Sadržaj</h3>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item active">Sadržaj</li>
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
                      <table class="display" id="chapter_table" style="width:100%">
                        <thead>
                          <tr>
                            <th width="50px">O.N.</th>
                            <th>Name</th>
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
                  <ul class="nav nav-tabs nav-primary" id="pills-warningtab" role="tablist">
                    @foreach(Config::get('app.available_locales') as $lang)
                    
                      <li class="nav-item">
                        <a class="nav-link @if(session()->get('locale') == $lang) active @endif" id="pills-{{$lang}}-tab" data-bs-toggle="pill" href="#pills-{{$lang}}" role="tab" aria-controls="pills-{{$lang}}" aria-selected="true">@if($lang == "sr") Srpski @else Engleski @endif</a></li>
                    
                  @endforeach</ul>
                  <div class="tab-content" id="pills-warningtabContent">

                    
                    @foreach(Config::get('app.available_locales') as $lang)
                    @php $locale = session()->get('locale'); @endphp
                    <div class="tab-pane fade @if($locale == $lang) active show @endif" id="pills-{{$lang}}" role="tabpanel" aria-labelledby="pills-{{$lang}}-tab">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card">
                              <div class="card-body">
                                <form class="row g-3 needs-validation chapter_edit_form" id="chapter_edit_form" novalidate="" method="POST" action="{{route('chapterSave')}}"> 
                                    @csrf 
                                    <input type="hidden" class="chapter_id" name="chapter_id" value="">
                                    <input type="hidden" name="language" value="{{$lang}}">
                                    <div class="col-12">
                                      <h6>Osnovne informacije</h6>
                                      <div class="row">
                                        <div class="col-md-12 position-relative">
                                          <label class="form-label" for="chapter_name_{{$lang}}">Naziv</label>
                                          <input class="form-control" id="chapter_name_{{$lang}}" name="chapter_name" type="text" required>
                                          <div class="invalid-tooltip">Moras da uneses naziv</div>
                                        </div>
                                        <div class="col-md-12 position-relative">
                                          <label class="form-label" for="chapter_content">Sadrzaj</label>
                                          <input class="form-control" name="chapter_content[0][type]" value="texteditor" type="hidden">
                                          <textarea class="form-control chapter_content" id="chapter_content_{{$lang}}" name="chapter_content[0][data][]" required></textarea>
                                          <div class="invalid-tooltip">Moras da uneses sadrzaj</div>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <button class="btn btn-primary" type="submit">Sacuvaj</button>
                                          </div>
                                      </div>
                                    </div>
            
                                </form>
                              </div>
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

          <!-- Container-fluid Ends-->
        </div>
@endsection
