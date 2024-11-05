@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
      <a href="{{ route('admin.member.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>


    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('admin.member.new') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nom *</label>
                            <input type="text" class="form-control ess-is-required" name="name"
                            data-msg="Veuiller renseigner le nom" value="{{Request::old('name')}}">
                        </div>
                        <div class="form-group">
                            <label>Fonction *</label>
                            <input type="text" class="form-control ess-is-required" name="fonction"
                            data-msg="Veuiller renseigner la fonction" value="{{Request::old('fonction')}}">
                        </div>
                        <div class="form-group">
                            <label>Contact</label>
                            <input type="text" class="form-control" name="contact"
                            data-msg="Veuiller renseigner le contact" value="{{Request::old('contact')}}">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email"
                            data-msg="Veuiller renseigner le email" value="{{Request::old('email')}}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Lien Facebook</label>
                            <input type="text" class="form-control" name="facebookLink"
                            data-msg="Veuiller renseigner lien facebook" value="{{Request::old('facebookLink')}}">
                        </div>
                        <div class="form-group">
                            <label>Lien Twitter</label>
                            <input type="text" class="form-control" name="twitterLink"
                            data-msg="Veuiller renseigner lien twitter" value="{{Request::old('twitterLink')}}">
                        </div>
                        <div class="form-group">
                            <label>Lien LinkedIn</label>
                            <input type="text" class="form-control" name="linkedinLink"
                            data-msg="Veuiller renseigner lien linkedIn" value="{{Request::old('linkedinLink')}}">
                        </div>
                        {{-- <div class="form-group">
                            <label>Domaines d'intervention *</label>
                            <textarea name="domaine_intervention" class="text-editor form-control ess-is-required" rows="4"
                                data-msg="Veuiller renseigner les domaines d'intervention">
                                {{Request::old('domaine_intervention') }}
                            </textarea>
                        </div> --}}
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Image de face ou profil *</label>
                                    <input type="file" class="form-control ess-is-required"
                                    data-msg="Veuiller selectionner l'image" name="img" accept="image/*">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Balise ALT *</label>
                                    <input name="alt" type="text" class="form-control ess-is-required" data-msg="Veuiller renseigner la balise ALT de l'image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div><small>* Obligatoire</small></div>

                <button type="submit" class="btn btn-primary btn-sm btn-icon-split mt-3">
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

