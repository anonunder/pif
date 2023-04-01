
    <div>
    <div class="logo-wrapper"><a href="{{route('home')}}"><img class="img-fluid for-light" src="https://pifforcosmetics.com/wp-content/uploads/2021/11/safe-vek.svg" style="max-width: 50px" alt=""></a>
        <div class="back-btn"><i data-feather="grid"></i></div>
        <div class="toggle-sidebar icon-box-sidebar" checked="checked"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid status_toggle middle sidebar-toggle"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg></div>
        </div>
    <div class="logo-icon-wrapper"><a href="{{route('home')}}">
        <div class="icon-box-sidebar"><i data-feather="grid"></i></div></a></div>
    <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
        <ul class="sidebar-links" id="simple-bar">
            <li class="back-btn">
                <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
            </li>
            <li class="menu-box"> 
                <ul>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('home')}}">
                            <i data-feather="home"></i>
                            <span>Početna</span>
                        </a>
                    </li>
                </ul>
            </li>
            @role("admin")
            <li class="menu-box"> 
                <ul>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="chevrons-right"></i><span class="lan-3">Proizvodi</span></a>
                    <ul class="sidebar-submenu">
                        <li><a class="lan-4" href="{{route('products')}}">Lista proizvoda</a></li>
                        <li><a class="lan-5" href="{{route('productsAddIndex')}}">Dodaj proizvod</a></li>
                    </ul>
                    </li>
                </ul>
            </li>
            <li class="menu-box"> 
                <ul>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="chevrons-right"></i><span class="lan-3">Sastojci</span></a>
                    <ul class="sidebar-submenu">
                        <li><a class="lan-4" href="{{route('ingredients')}}">Lista sastojaka</a></li>
                        <li><a class="lan-5" href="{{route('ingredientsAddIndex')}}">Dodaj sastojak</a></li>
                    </ul>
                    </li>
                </ul>
            </li>
            <li class="menu-box"> 
                <ul>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="chevrons-right"></i><span class="lan-3">Smeše</span></a>
                    <ul class="sidebar-submenu">
                        <li><a class="lan-4" href="{{route('mixtures')}}">Lista smeša</a></li>
                        <li><a class="lan-5" href="{{route('mixturesAddIndex')}}">Dodaj smešu</a></li>
                    </ul>
                    </li>
                </ul>
            </li>
            
            <li class="menu-box"> 
                <ul>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="home"></i><span class="lan-3">Kompanije</span></a>
                    <ul class="sidebar-submenu">
                        <li><a class="lan-5" href="{{route('distributors')}}">Distributeri</a></li>
                        <li><a class="lan-5" href="{{route('manufacturers')}}">Proizvodjaci</a></li>
                        <li><a class="lan-5" href="{{route('companies')}}">Firme</a></li>
                    </ul>
                    </li>
                </ul>
            </li>
            
            <li class="menu-box"> 
                <ul>
                    <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="users"></i><span class="lan-3">Korisnici</span></a>
                    <ul class="sidebar-submenu">
                        <li><a class="lan-5" href="{{route('users')}}">Lista korisnika</a></li>
                        <li><a class="lan-5" href="{{route('userAdd')}}">Dodaj korisnika</a></li>
                    </ul>
                    </li>
                </ul>
            </li>
            <li class="menu-box"> 
                <ul>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('chapters')}}">
                            <i data-feather="book-open"></i>
                            <span>Sadržaj</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="menu-box"> 
                <ul>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('help')}}">
                            <i data-feather="help-circle"></i>
                            <span>Pomoć</span>
                        </a>
                    </li>
                </ul>
            </li>
            {{-- <li class="menu-box"> 
                <ul>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('home')}}">
                            <i data-feather="settings"></i>
                            <span>Opcije</span>
                        </a>
                    </li>
                </ul>
            </li> --}}
            @endrole
            <li class="menu-box"> 
                <ul>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title link-nav" href="{{route('logout')}}">
                            <i data-feather="user-minus"></i>
                            <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
    </div>