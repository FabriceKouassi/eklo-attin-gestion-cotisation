@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
      <a href="{{ route('user.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>


    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('user.new') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label>Nom *</label>
                    <input type="text" class="form-control ess-is-required" name="nom"
                    data-msg="Veuillez renseigner le nom" value="{{Request::old('nom')}}">
                </div>
                <div class="form-group">
                    <label>Prénom *</label>
                    <input type="text" class="form-control ess-is-required" name="prenoms"
                    data-msg="Veuillez renseigner le prénom" value="{{Request::old('prenoms')}}">
                </div>
                <div class="form-group">
                    <label>Email *</label>
                    <input type="text" class="form-control ess-is-required ess-inputmask-email" name="email"
                    data-msg="Veuillez renseigner l'adresse mail" value="{{Request::old('email')}}">
                </div>
                <div class="form-group">
                    <label>Téléphone </label>
                    <input type="text" data-inputmask="'mask': '99 99 99 99 99'" class="form-control" name="phone"
                    value="{{Request::old('phone')}}">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Role</label>
                    <select class="form-control ess-select2 " name="role">
                        <option value="editor">
                            Editeur
                        </option>
                        <option value="admin">
                            Administrateur
                        </option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Mot de passe *</label>
                    <input type="password" class="form-control ess-is-required" data-msg="Veuillez renseigner le mot de passe par defaut" name="password" value="{{ Request::old('password') }}">
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" class="form-control" name="img" accept="image/*">
                </div>

                <div><small>* Obligatoire</small></div>

                <button type="submit" class="btn btn-primary btn-sm btn-icon-split mt-4">
                    <span class="icon text-gray-600">
                      <i class="fas fa-arrow-right"></i>
                    </span>
                    <span class="text">Enregistrer</span>
              </button>
            </form>
        </div>
    </div>

</div>
@endsection

