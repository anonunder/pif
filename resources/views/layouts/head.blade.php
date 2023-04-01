<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="tivo admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
<meta name="keywords" content="admin template, Tivo admin template, dashboard template, flat admin template, responsive admin template, web app">
<meta name="author" content="pixelstrap">
<meta name="csrf-token" content="{{csrf_token()}}">
<link rel="icon" href="/assets/images/favicon/favicon.png" type="image/x-icon">
<link rel="shortcut icon" href="/assets/images/favicon/favicon.png" type="image/x-icon">
<title>PIF</title>


@if(Route::currentRouteName() == "ingredientsAddIndex" || Route::currentRouteName() == "ingredientsEditIndex")
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/summernote.css">
@endif


@if(Route::currentRouteName() == "userEdit" || Route::currentRouteName() == "userAdd" || Route::currentRouteName() == "productsAddIndex" || Route::currentRouteName() == "productsEditIndex" || Route::currentRouteName() == "mixturesAddIndex" || Route::currentRouteName() == "mixturesEditIndex")
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/summernote.css">
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/dropzone.css">
@endif


@if(Route::currentRouteName() == "home" || Route::currentRouteName() == "companies" || Route::currentRouteName() == "manufacturers" || Route::currentRouteName() == "distributors" || Route::currentRouteName() == "mixtures")
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/sweetalert2.css">
@endif

@if(Route::currentRouteName() == "ingredients" || Route::currentRouteName() == "products"  || Route::currentRouteName() == "users")
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
@endif
@if(Route::currentRouteName() == "chapters")
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/datatables.css">
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/summernote.css">

@endif

<link rel="stylesheet" type="text/css" href="/assets/css/vendors/font-awesome.css">
<!-- ico-font-->
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/icofont.css">
<!-- Themify icon-->
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/themify.css">
<!-- Flag icon-->
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/flag-icon.css">
<!-- Feather icon-->
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/feather-icon.css">
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/scrollbar.css">
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/animate.css">
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/chartist.css">
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/prism.css">
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/vector-map.css">
<!-- Bootstrap css-->
<link rel="stylesheet" type="text/css" href="/assets/css/vendors/bootstrap.css">
<!-- App css-->
<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
<link id="color" rel="stylesheet" href="/assets/css/color-1.css" media="screen">
<!-- Responsive css-->
<link rel="stylesheet" type="text/css" href="/assets/css/responsive.css">