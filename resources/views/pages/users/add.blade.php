@extends('layouts.main') @section('content')
@php

@endphp
<!-- Page Sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-sm-6">
          <h3>User:</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="/">
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item active">
              <a href="{{route('users')}}">Users</a>
            </li>
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
              <form class="row g-3 needs-validation" novalidate="" method="POST" action="{{route('userStore')}}" enctype="multipart/form-data">
                @csrf
                <div class="col-6 mt-2">
                  <button class="btn btn-primary" type="submit">Save</button>
                </div>
                <div class="col-12 parentClone">
                    <div class="row fh_karakterisitke canClone mixture-0 canClone" data_id="0">
                      <div class="col-xl-6 position-relative">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control form-input-replace trade_name" value="" required id="name" name="name" type="text">
                      </div>
                      <div class="col-xl-6 position-relative">
                        <label class="form-label" for="email">Email</label>
                        <input class="form-control form-input-replace trade_name" value="" required id="email" name="email" type="text">
                      </div>
                      <div class="col-xl-6 position-relative">
                        <label class="form-label" for="password">Password</label>
                        <div class="row">
                            <div class="col-10">
                                <input class="form-control form-input-replace trade_name" value="" required id="password" name="password" type="text">
                            </div>
                            <div class="col-2 align-self-center">
                                <button class="btn btn-pill btn-primary btn-air-primary" id="generate" type="button" data-bs-original-title="" title="">Generate</button>   
                            </div>
                        </div>
                      </div>
                      <div class="col-xl-6 position-relative">
                        <label class="form-label" for="companies">Companies</label>
                        <select class="form-select form-input-replace digits select2Multi " required multiple name="companies[]" id="companies">
                            @foreach($companies as $company)
                            <option value="{{$company->id}}">{{$company->name}}</option>
                            @endforeach
                          </select>
                      </div>
                      
                      
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <!-- Container-fluid Ends-->
</div>  @endsection