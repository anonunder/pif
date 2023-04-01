@extends('layouts.main') @section('content')
<!-- Page Sidebar Ends-->
<div class="page-body">
  <div class="container-fluid">
    <div class="page-title">
      <div class="row">
        <div class="col-sm-6">
          <h3>Mixtures</h3>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.html">
                <i data-feather="home"></i>
              </a>
            </li>
            <li class="breadcrumb-item active">Mixtures</li>
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
                <table class="display" id="mixtures_table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Create date</th>
                      <th>Action</th>
                    </tr>
                  </thead>
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