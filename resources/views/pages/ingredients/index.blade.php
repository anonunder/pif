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
         <!-- Zero Configuration  Starts-->
         <div class="col-sm-12">
          <div class="card">
            <div class="card-body">
              <div class="table-responsive theme-scrollbar">
                <table class="display" id="basic-1">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>INCI Name</th>
                      <th>CAS Broj</th>
                      <th>Content</th>
                      <th>Datum kreiranja</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php
                      $locale = session()->get('locale');
                      $name    = "inci_name_".$locale;
                      $content = "content_".$locale;
                      @endphp
                    @foreach($ingredients as $ingredient)
                    <tr>
                      <td>{{$ingredient->id}}</td>
                      <td>{{$ingredient->$name}}</td>
                      <td>{{$ingredient->cas_number}}</td>
                      <td>{!!($ingredient->$content == null) ? '<i style="color: red;" class="icofont icofont-ui-close"></i>' : '<i style="color: green;" class="icofont icofont-ui-check"></i>'!!}</td>
                      <td>{{\Carbon\Carbon::parse($ingredient->created_at)->format("d-M-Y")}}</td>
                      <td> 
                        <ul class="action"> 
                          <li class="edit"> <a href="{{route('ingredientsEditIndex',$ingredient->id)}}"><i class="icon-pencil-alt"></i></a></li>
                          <li class="delete"><a href="#"><i class="icon-trash"></i></a></li>
                        </ul>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
  </div>
</div>
  <!-- Container-fluid Ends-->
</div> 
@endsection