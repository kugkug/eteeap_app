
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ETEEAP | Log in</title>

  <link rel="stylesheet" href="{{ asset('adminlte3.2/plugins/fontawesome-free/css/all.min.css') }} ">
  <link rel="stylesheet" href="{{ asset('adminlte3.2/dist/css/adminlte.min.css') }}">

</head>

<body class="hold-transition login-page ">
    
<div class="login-box">
    <div class="login-logo">
        {{-- <a href="/"><b>ETEEAP</b> </a> --}}
        <img src="{{ asset('images/au_logo.png')}}" alt="" style="width: 200px;">
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <p class="login-box-msg">ETEEAP</p>
            <form method="post" action="/execute/login">
                @csrf
                
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control" placeholder="Username" value="{{ old('email')}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                @error('message')
                    <p class="text-danger">
                        {{$message}}
                    </p>
                @enderror
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                {{-- <a href="/admin" class="btn btn-danger btn-block" target="_blank">Admin Page</a>
                <a href="/cashier" class="btn btn-primary btn-block" target="_blank">Cashier Page</a> --}}
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('adminlte3.2/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('adminlte3.2/plugins/bootstrap/js/bootstrap.bundle.min.j') }}"></script>
<script src="{{ asset('adminlte3.2/dist/js/adminlte.js') }}"></script>
</body>
</html>
