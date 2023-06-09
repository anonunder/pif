@extends('layouts.main')

@section('content')
@php 
$aneksi = json_decode($product->aneks);
$specs  = json_decode($product->pdf_specifications);

$i      = 0;
$k      = 0;
@endphp
<!-- Page Sidebar Ends-->
<div class="page-body">
          <div class="container-fluid">
            <div class="page-title">
              <div class="row">
                <div class="col-sm-6">
                  <p style="font-size: 22px; margin: 0;">
                    <b>Company:</b> {{$product->company->name}}
                </p>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/"><i data-feather="home"></i></a></li>
                    <li class="breadcrumb-item active">{{$product->name}}</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid dashboard-default">
            <div class="col-xl-12">

                <div class="card">
                    <div class="card-header pb-0">
                      <h4 class="text-center">Product Information File</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                          
                            <div class="col-10">
                                <p>{{__("main.product_name")}}: <b>{{$product->name}}</b></p>
                                <p>{{__("main.formula_number")}}: <b>{{$product->formula}}</b> - {{__("main.version")}}: <b>{{$product->version}}</b> - {{__("main.category")}}: <b>{{$product->category}}</b></p>
                                @if($product->pdf_link != null)
                                <div class="cst_buttons mb-3">
                                  <a href="{{$product->pdf_link}}" download class="btn btn-danger download_button">PDF Download</a>
                                  <a href="{{$product->pdf_link}}" target="_blank" class="btn btn-success preview_button">PDF Preview</a>
                                </div>
                                
                                @endif
                              </div>
                            <div class="col-2">
                                <img class="w-100" src="{{$product->image}}">
                            </div>
                        </div>
                    </div>
                </div>

                @if($product->pdf_link != null)
                @if($aneksi)
                <div class="card">
                  <div class="card-header pb-0">
                    <h4>Aneks</h4>
                  </div>
                  <div class="card-body aneksi">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        @foreach($aneksi as $index => $aneks)
                            @php
                            if($i==0){
                                $ac = "active";
                                $sh = "show";
                            }else{
                                $ac = "";
                                $sh = "";
                            }
                            $i++;
                            @endphp
                      <li class="nav-item"><a class="nav-link {{$ac}}" id="pills-{{$index}}-tab" data-bs-toggle="pill" href="#pills-{{$index}}" role="tab" aria-controls="pills-{{$index}}" aria-selected="true">{{ str_replace("_"," ", \Str::title($index)) }}</a></li>
                      @endforeach
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        @foreach($aneksi as $index => $aneks)
                        @php
                        if($k==0){
                            $ac = "active";
                            $sh = "show";
                        }else{
                            $ac = "";
                            $sh = "";
                        }
                        $k++;
                        @endphp
                        <div class="tab-pane fade {{$ac}} {{$sh}}" id="pills-{{$index}}" role="tabpanel" aria-labelledby="pills-{{$index}}-tab">
                            @foreach($aneks as $file)
                            <p class="mb-0 m-t-10"><a href="{{$file}}" target="_blank">{{basename($file)}}</a></p>
                            @endforeach
                        </div>
                  @endforeach
                    </div>
                  </div>
                </div>
                {{-- <div class="card">
                    <div class="card-header pb-0">
                      <h4>{{__("main.specifications")}}</h4>
                    </div>
                    <div class="card-body">
                      
                    
  
                      @php $i = 0; $k = 0;@endphp
  
                      <ul class="nav nav-pills " id="pills-spec" role="tablist">
                          @foreach($specs as $index => $spec)
                              @php
                              if($i==0){
                                  $ac = "active";
                                  $sh = "show";
                              }else{
                                  $ac = "";
                                  $sh = "";
                              }
                              $i++;
                              @endphp
                        <li class="nav-item"><a class="nav-link {{$ac}}" id="pills-{{$index}}-tab" data-bs-toggle="pill" href="#pills-{{$index}}" role="tab" aria-controls="pills-{{$index}}" aria-selected="true">{{ str_replace("_"," ", \Str::title($spec->trade_name)) }}</a></li>
                        @endforeach
                      </ul>
                      <div class="tab-content" id="pills-specContent">
                          @foreach($specs as $index => $spec)
                          @php
                          if($k==0){
                              $ac = "active";
                              $sh = "show";
                          }else{
                              $ac = "";
                              $sh = "";
                          }
                          $k++;
                          @endphp
                          <div class="tab-pane fade {{$ac}} {{$sh}}" id="pills-{{$index}}" role="tabpanel" aria-labelledby="pills-{{$index}}-tab">
                              <p class="mb-0 m-t-10"><a href="{{$spec->url}}" target="_blank">{{basename($spec->url)}}</a></p>
                          </div>
                    @endforeach
                        
                      </div>
                      
                      
                      
                    </div>
                  </div> --}}
                  @endif
                  @endif



              </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
@endsection
