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
            <div class="row">
                <div class="col-md-4">
                    <img class="img" src="{{ $member->getImg() }}" alt="">
                </div>
                <div class="col-md">
                    <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('admin.member.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="memberId" value="{{ $member->id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nom *</label>
                                    <input type="text" class="form-control" name="name"
                                    data-msg="Veuiller renseigner le nom" value="{{ $member->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Contact</label>
                                    <input type="text" class="form-control" name="contact"
                                    data-msg="Veuiller renseigner le contact" value="{{ $member->contact }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fonction *</label>
                                    <input type="text" class="form-control ess-is-required" name="fonction"
                                    data-msg="Veuiller renseigner la fonction" value="{{ $member->fonction }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email"
                                    data-msg="Veuiller renseigner le email" value="{{ $member->email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Lien Facebook</label>
                                    <input type="text" class="form-control" name="facebookLink"
                                    data-msg="Veuiller renseigner lien facebook" value="{{ $member->facebookLink }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Lien Twitter</label>
                                    <input type="text" class="form-control" name="twitterLink"
                                    data-msg="Veuiller renseigner lien twitter" value="{{ $member->twitterLink }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Lien LinkedIn</label>
                                    <input type="text" class="form-control" name="linkedinLink"
                                    data-msg="Veuiller renseigner lien linkedIn" value="{{ $member->linkedinLink }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Balise ALT *</label>
                                    <input name="alt" type="text" class="form-control ess-is-required" value="{{ $member ? $member->alt : '' }}" data-msg="Veuiller renseigner la balise ALT de l'image">
                                </div>
                            </div>
                            {{-- <div class="col-md-12">
                                <div class="form-group">
                                    <label>Domaines d'intervention *</label>
                                    <textarea name="domaine_intervention" class="text-editor form-control ess-is-required" rows="4"
                                        data-msg="Veuiller renseigner les domaines d'intervention">{{ $member->domaine_intervention }}
                                    </textarea>
                                </div>
                            </div> --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Image de face ou profil</label>
                                    <input type="file" class="form-control"
                                    data-msg="Veuiller selectionner l'image" name="img" accept="image/*">
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

    </div>
</div>


@endsection

