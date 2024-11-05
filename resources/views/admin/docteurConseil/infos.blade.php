@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    </div>

    <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('docteur.save') }}" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        @if ($docteur)
                            <div class="col">
                                <div class="text-center p-2 m-2">
                                    <span>Image</span>
                                    <img class="img" src="{{ $docteur ? $docteur->getImg() : '' }}" alt="{{ $docteur->alt }}">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nom *</label>
                                    <input type="text" class="form-control {{ $docteur ? 'ess-is-required' : '' }}" name="nom"
                                    data-msg="Veuillez renseigner le nom du docteur" value="{{ $docteur ? $docteur->nom : '' }}" value="{{ Request::old('nom') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Fonction *</label>
                                    <input type="text" class="form-control {{ $docteur ? 'ess-is-required' : '' }}" name="fonction"
                                    data-msg="Veuillez renseigner la fonction du docteur" value="{{ $docteur ? $docteur->fonction : '' }}" value="{{ Request::old('fonction') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Balise ALT *</label>
                                    <input name="alt" type="text" class="form-control {{ $docteur ? 'ess-is-required' : '' }}" value="{{ $docteur ? $docteur->alt : '' }}" data-msg="Veuiller renseigner la balise ALT de l'image" value="{{ Request::old('alt') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control {{ $docteur ? '' : 'ess-is-required' }}" name="img" accept="image/*" data-msg="Veuillez choisir l'image">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Détail</label>
                                    <textarea name="content" class="form-control text-editor" rows="2">{{ $docteur ? $docteur->content : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div><small>* Obligatoire</small></div>

                    <button type="submit" class="btn btn-primary btn-sm btn-icon-split mt-2">
                        <span class="icon text-gray-600">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="text">Enregistrer</span>
                    </button>
            </div>
        </div>
    </form>
</div>
@endsection

