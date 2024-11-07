@extends('admin/_.app')


@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
      <a href="{{ route('demande.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('demande.update') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="itemId" value="{{ $demande->id }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Choisir le demandeur *</label>
                            <select class="form-control ess-is-required" name="demandeur_id" data-msg="Veuillez selectionner le demandeur">
                                @foreach ($demandeurs as $item)
                                    <option value="{{ $item->id}}" {{ (int) $demande->demandeur_id === (int) $item->id ? 'selected="selected"' : "" }}>
                                        {{ $item->nom }} {{ $item->prenoms }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Choisir le motif de la demande *</label>
                            <select class="form-control ess-is-required" name="motif_id" data-msg="Veuillez selectionner le motif de la demande">
                                @foreach ($motifs as $item)
                                    <option value="{{ $item->id}}" {{ (int) $demande->motif_id === (int) $item->id ? 'selected="selected"' : "" }}>
                                        {{ $item->libelle }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Decision *</label>

                            <select class="form-control ess-select2 " name="decision" {{ Auth::user()->role == 'admin' ? '' : 'disabled' }}>
                                <option value="1"
                                    {{ $demande->decision == 1 ? 'selected="selected"' : "" }}>
                                    Acceptée
                                </option>
                                <option value="0"
                                    {{ $demande->decision == 0 ? 'selected="selected"' : "" }}>
                                    En attente
                                </option>
                                <option value="2"
                                    {{ $demande->decision == 2 ? 'selected="selected"' : "" }}>
                                    Refusée
                                </option>
                            </select>

                        </div>
                    </div>
                                        
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description *</label>
                            <textarea name="description" id="description" class="form-control ess-is-required" rows="4"
                                data-msg="Veuillez renseigner la description">{{ $demande->description }}</textarea>
                        </div>
                    </div>
                </div>

                <div><small>* Obligatoire</small></div>

                @if (Auth::user()->role == 'admin')
                    <button type="submit" class="btn btn-primary btn-sm btn-icon-split mt-3">
                        <span class="icon text-gray-600">
                        <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="text">Enregistrer</span>
                    </button>
                @endif

            </form>
        </div>
    </div>
</div>
@endsection

