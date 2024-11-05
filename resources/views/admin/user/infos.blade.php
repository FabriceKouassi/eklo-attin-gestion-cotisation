@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
      @if (Auth::user()->role == 'admin')
        <a href="{{ route('user.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
      @endif
    </div>


    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img class="img" src="{{ $user->getImg() }}" alt="">
                </div>
                <div class="col-md-8">
                    <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('user.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="userId" value="{{ $user->id }}">

                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Nom *</label>
                                    <input type="text" class="form-control ess-is-required" name="nom"
                                    data-msg="Veuiller renseigner le nom" value="{{ $user->nom }}">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Prénom *</label>
                                    <input type="text" class="form-control ess-is-required" name="prenoms"
                                    data-msg="Veuiller renseigner le prénom" value="{{ $user->prenoms }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Email *</label>
                                    <input type="text" class="form-control ess-is-required ess-inputmask-email" name="email"
                                    data-msg="Veuiller renseigner l'adresse mail" value="{{ $user->email }}">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Téléphone </label>
                                    <input type="text" data-inputmask="'mask': '99 99 99 99 99'" class="form-control" name="phone"
                                    value="{{ $user->phone }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Etat</label>
                            <select class="form-control ess-select2 " name="enabled" {{ Auth::user()->role=='editor' ? 'disabled' : ''}}>
                                <option value="1"
                                    {{ $user->enabled==1 ? 'selected="selected"' : "" }}>
                                    Actif
                                </option>
                                <option value="0"
                                    {{ $user->enabled==0 ? 'selected="selected"' : "" }}>
                                    Désactiver
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Role</label>
                            <select class="form-control ess-select2 " name="role" {{ Auth::user()->role=='editor' ? 'disabled' : ''}}>
                                <option value="admin"
                                    {{ $user->role=='admin' ? 'selected="selected"' : "" }}>
                                    Administrateur
                                </option>
                                <option value="gestionnaire"
                                    {{ $user->role=='gestionnaire' ? 'selected="selected"' : "" }}>
                                    Gestionnaire
                                </option>
                                <option value="membre"
                                    {{ $user->role=='membre' ? 'selected="selected"' : "" }}>
                                    Membre
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control" name="img" accept="image/*">
                        </div>

                        <div class="form-group">
                            <label>Modifier le mot de passe </label>
                            <input type="password" class="form-control" name="password" value="">
                        </div>

                        <div><small>* Obligatoire</small></div>

                        <button type="submit" class="btn btn-primary btn-sm btn-icon-split mt-2">
                            <span class="icon text-gray-600">
                              <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="text">Modifier</span>
                      </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

