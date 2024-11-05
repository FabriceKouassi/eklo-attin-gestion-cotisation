@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
      <a href="{{ route('calendrier.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('calendrier.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="itemId" value="{{ $calendrier->id }}">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Choisir le type du vaccin</label>
                                    <select class="form-control ess-is-required" name="vaccinFamille" data-msg="Veuiller selectionner le type du vaccin">
                                        @foreach ($vaccinFamille as $item)
                                            <option value="{{ $item->id}}" {{ (int) $calendrier->vaccin_famille_id === (int) $item->id ? 'selected="selected"' : "" }}>
                                                {{ $item->libelle }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Titre du tableau *</label>
                                    <input type="text" class="form-control ess-is-required" name="title"
                                    data-msg="Veuiller renseigner le titre du tableau" value="{{ $calendrier->title }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cout du vaccin</label>
                                    <input type="number" class="form-control" name="cout"
                                    data-msg="Veuiller renseigner le cout du vaccin" value="{{ $calendrier->cout }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nom de vaccin</label>
                                    <textarea name="nom" cols="3" rows="3" class="form-control" data-msg="Veuiller renseigner le nom du vaccin">
                                        {{ trim($calendrier->nom) }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Age *</label>
                                    <textarea name="age" cols="3" rows="3" class="form-control ess-is-required" data-msg="Veuiller renseigner l'âge d'administration">
                                        {{ trim($calendrier->age) }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Frequence ou Schema Vaccinal *</label>
                                    <textarea name="frequence" cols="3" rows="3" class="text-editor form-control ess-is-required" data-msg="Veuiller renseigner la frequence ou le schema vaccinal">
                                        {{ trim($calendrier->frequence) }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Periode</label>
                                    <textarea name="periode" cols="3" rows="3" class="form-control" data-msg="Veuiller renseigner la periode vaccinale">
                                        {{ trim($calendrier->periode) }}
                                    </textarea>
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

