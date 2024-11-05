<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>{{ config('global.name') }} | {{ $title }}</title>


<!-- Custom fonts for this template-->
<link href="{{ asset('admin/plugin/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="{{ asset('admin/plugin/jquery-confirm@3.3.2/jquery-confirm.min.css') }}">
<!-- Custom styles for this template-->
<link href="{{ asset('admin/css/sb-admin-2.css') }}" rel="stylesheet">

<link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

</head>

<body class="login-page" style="background-image: url('{{ asset('admin/img/inhp-login-bg.jpg') }}')">
    <br><br><br>

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center eee">
        <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5 login-form">
            <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-6 d-none d-lg-block bg-login-image">
                    <div class="text-center m-3">
                        <img class="img login-logo" src="{{ $company ? $company->getLogo1() : '' }}" alt="{{ $company ? $company->alt : '' }}">
                    </div>
                </div>
                <div class="col-lg-6">
                <div class="p-5">
                    <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">ESPACE ADMIN</h1>
                    </div>
                    <form class="user ess-form-checked" autocomplete="off" action="{{ route('login.form') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user ess-is-required @error('email') is-invalid @enderror"
                            name="email" placeholder="Addresse mail..." data-msg="Veuiller renseigner votre email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user ess-is-required @error('password') is-invalid @enderror"
                             name="password" placeholder="Mot de passe" data-msg="Veuiller renseigner votre mot de passe"
                             required autocomplete="current-password">
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox small">
                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                <label class="custom-control-label" for="customCheck">Restez connecter</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-user btn-block">
                            Se Connecter
                        </button>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="small" href="{{ route('resetPassword.form') }}">Mot de passe oublié ?</a> <br>
                        <a class="small" href="{{ route('front.index') }}">Site Web</a>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </div>


    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admin/plugin/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/plugin/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{ asset('admin/plugin/jquery-easing/jquery.easing.min.js') }}"></script>
  <!-- Jquery confirm -->
  <script src="{{ asset('admin/plugin/jquery-confirm@3.3.2/jquery-confirm.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('js/script.js') }}"></script>


  @if(Session::has('ess-msg'))
  <script>
      $( document ).ready(function() {
          $.confirm({
              title: 'Message!',
              typeAnimated: true,
              content: "<?= Session::get('ess-msg') ?>",
              buttons: {
                  somethingElse: {
                      text: 'Fermer',
                      action: function(){
                      }
                  }
              }
          });
      });
  </script>
@endif

</body>

</html>
