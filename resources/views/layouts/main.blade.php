<!DOCTYPE html>
<html class="app-html" lang="sr" xml:lang="sr" xmlns= "http://www.w3.org/1999/xhtml">
  <head>
    @include('layouts.head')
  </head>
  <body class="" id="body">
  <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="dot"></div>
      <div class="dot"></div>
      <div class="dot"></div>
      <div class="dot"> </div>
      <div class="dot"></div>
    </div>
    <div class="page-wrapper null compact-wrapper" id="pageWrapper">
      <div class="page-header @if(isset($_COOKIE['sidebar'])) @if($_COOKIE['sidebar'] != 1) close_icon @endif @else close_icon @endif ">
        <div class="header-wrapper row m-0">
          <div class="header-logo-wrapper col-auto p-0">
            <div class="toggle-sidebar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid status_toggle middle sidebar-toggle"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg></div>
            <div class="logo-header-main"><a href="/"><img class="img-fluid for-light img-100" src="https://pifforcosmetics.com/wp-content/uploads/2021/11/safe-vek.svg" alt=""><img class="img-fluid for-dark" src="https://pifforcosmetics.com/wp-content/uploads/2021/11/safe-vek.svg" alt=""></a></div>
          </div>
      <div class="row">
        <div class="col-xl-3 col-sm-12">
          <select class="form-select digits" id="languageSwitcher">
            @foreach(Config::get('app.available_locales') as $lang)
              <option @if(session()->get('locale') == $lang) selected @endif value="{{$lang}}">@if($lang == "sr") Srpski @else Engleski @endif</option>
            @endforeach
          </select>
        </div>
      </div>
        </div>
      </div>
    <div class="page-body-wrapper">
    <div class="sidebar-wrapper @if(isset($_COOKIE['sidebar'])) @if($_COOKIE['sidebar'] == 1) close_icon @endif  @endif">
        @include("layouts.nav")
    </div>
    
    @yield('content')

  @include('layouts.scripts')
  </body>
</html>
