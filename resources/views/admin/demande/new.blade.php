@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> {{ $title }}<h1>
        <a href="{{ route('demande.all') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('demande.new') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Choisir le demandeur</label>
                            <select class="form-control ess-is-required" name="demandeur_id"
                                data-msg="Veuillez selectionner le demandeur">
                                <option value="" selected disabled>Sélectionner un demandeur</option>
                                @foreach ($demandeurs as $item)
                                    <option value="{{ $item->id }}" {{ old('demandeur_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->nom }} {{ $item->prenoms }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Choisir le motif de la demande *</label>
                            <select class="form-control ess-is-required" name="motif_id"
                                data-msg="Veuillez selectionner le motif de la demande">
                                <option value="" selected disabled>Sélectionner le motif</option>
                                @foreach ($motifs as $item)
                                    <option value="{{ $item->id }}" {{ old('motif_id') == $item->id ? 'selected' : '' }}>
                                        {{ $item->libelle }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description *</label>
                            <textarea name="description" id="description" class="form-control ess-is-required" rows="4"
                                data-msg="Veuillez renseigner la description de la demande"></textarea>
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

