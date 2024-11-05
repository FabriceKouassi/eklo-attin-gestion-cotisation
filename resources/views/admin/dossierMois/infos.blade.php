@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    </div>

    <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('dossier.save') }}" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        @if ($dossier)
                            <div class="col">
                                <div class="text-center p-2 m-2">
                                    <span>Image</span>
                                    <img class="img" src="{{ $dossier ? $dossier->getImg() : '' }}" alt="{{ $dossier->img_alt }}">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Titre *</label>
                                    <input type="text" class="form-control ess-is-required" name="title"
                                    data-msg="Veuillez renseigner le titre du dossier" value="{{ $dossier ? $dossier->title : '' }}" value="{{ Request::old('title') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Balise ALT de l'image*</label>
                                    <input name="img_alt" type="text" class="form-control ess-is-required" value="{{ $dossier ? $dossier->img_alt : '' }}" data-msg="Veuiller renseigner la balise ALT de l'image" value="{{ Request::old('img_alt') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image {{ empty($dossier->img) ? '*' : '' }}</label>
                                    <input type="file" class="form-control {{ empty($dossier->img) ? 'ess-is-required' : '' }}" name="img" accept="image/*" data-msg="Veuillez choisir l'image">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Balise ALT du document</label>
                                    <input name="doc_alt" type="text" class="form-control" value="{{ $dossier ? $dossier->doc_alt : '' }}" data-msg="Veuiller renseigner la balise ALT du document" value="{{ Request::old('doc_alt') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Document</label>
                                    <input type="file" class="form-control" name="doc" accept=".pdf">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Détail</label>
                                    <textarea name="content" class="form-control text-editor ess-is-required" rows="2" data-msg="Veuillez renseigner le contenu">
                                        {{ $dossier ? $dossier->content : '' }}
                                    </textarea>
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

