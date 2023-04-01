@extends('layouts.main') @section('content')
<!-- Page Sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-sm-6">
          <h3>PDF Viewer for product: <b><a href="{{route('pdfGenerate',$product->id)}}">{{$product->name}}</a></b></h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="/">
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item"><a href="{{route('products')}}">Products</a></li>
            <li class="breadcrumb-item"><a href="{{route('productsEditIndex',$product->id)}}">{{$product->name}}</a></li>
            <li class="breadcrumb-item active">PDF Viewer</li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid dashboard-default">
    <div class="row">
         <div class="col-sm-12 text-center preview">
            <iframe src="{{$link}}" ></iframe>
        </div>
  </div>
</div>
</div> 
@endsection