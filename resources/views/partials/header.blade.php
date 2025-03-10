<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{!! csrf_token() !!}" />
    <meta name="_url" content="{!! URL::to('/') !!}" />
    <link rel="shortcut icon" href="{{ asset('images/au_logo.png') }}" type="image/x-icon">
    

    <link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/fontawesome-free/css/all.min.css') }} ">
	  <link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/toastr/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/confirm/css/jquery-confirm.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/daterangepicker/daterangepicker.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}"> 
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}"> 
  	<link rel="stylesheet" href="{{ asset('adminlte3.2/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('styles/styles.css') }}">

    

    <title>ETEEAP</title>
</head>
<body>
    
<body class="layout-top-nav">
    <div class="wrapper">
      <nav class="main-header navbar navbar-expand-md navbar-light bg-primary">
        <div class="container">
          <a href="#" class="navbar-brand">
            <img src="{{ asset('images/au_logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light text-white">ETEEAP</span>
          </a>
    
          <button class="navbar-toggler order-1 collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
    
          <div class="navbar-collapse order-3 collapse" id="navbarCollapse" style="">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
              <li class="nav-item">
                <a href="dashboard" class="nav-link text-white">
                  <i class="fa fa-home"></i> Home
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="profile" class="nav-link text-white">Profile</a>
              </li> --}}
              
            </ul>
    
            <!-- SEARCH FORM -->
            {{-- <form class="form-inline ml-0 ml-md-3">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </form> --}}
          </div>
    
          <!-- Right navbar links -->
          <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            
            <li class="nav-item dropdown">
						
              <a class="nav-link text-white" data-toggle="dropdown" href="#" aria-expanded="true">
                <i class="fa fa-user"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              
                <a href="/execute/applicants/logout" class="nav-link">
                  <i class="fas fa-sign-out-alt"></i> Log Out
                </a>
                  
              </div>
          </li>
           
          </ul>
        </div>
      </nav>
      
          {{-- @include('partials.admin.sidebar') --}}

          <div class="content-wrapper" style="min-height: 801px;">
            <!-- Content Header (Page header) -->
            <div class="content-header">
              <div class="container">
                <div class="row mb-2">
                  <div class="col-sm-6">
                    {{-- <h1 class="m-0">{{ ucwords(strtolower($header)) }}</h1> --}}
                  </div><!-- /.col -->
                  <div class="col-sm-6">
                    {{-- <ol class="breadcrumb float-sm-right">
                      <li class="breadcrumb-item"><a href="#">Home</a></li>
                      <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol> --}}
                  </div><!-- /.col -->
                </div><!-- /.row -->
              </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
        
            <!-- Main content -->
            <section class="content">
              <div class="container">


        