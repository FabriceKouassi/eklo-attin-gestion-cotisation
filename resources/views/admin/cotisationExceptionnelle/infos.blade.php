@extends('admin/_.app')


@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
      <a href="{{ route('cotisationExceptionnelle.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('cotisationExceptionnelle.update') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="itemId" value="{{ $cotisationExceptionnelles->id }}">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Choisir le demandeur *</label>
                            <select class="form-control ess-is-required" name="demande_id" data-msg="Veuillez selectionner le demandeur">
                                @foreach ($demandes as $item)
                                    <option value="{{ $item->id }}" {{ (int) $cotisationExceptionnelles->demande_id === (int) $item->id ? 'selected="selected"' : "" }}>
                                        {{ $item->demandeur->nom }} {{ $item->demandeur->prenoms }} - # {{ $item->motif->libelle }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Choisir le contributeur *</label>
                            <select class="form-control ess-is-required" name="contributeur_id" data-msg="Veuillez selectionner le demandeur">
                                @foreach ($contributeurs as $item)
                                    <option value="{{ $item->id}}" {{ (int) $cotisationExceptionnelles->contributeur_id === (int) $item->id ? 'selected="selected"' : "" }}>
                                        {{ $item->nom }} {{ $item->prenoms }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Montant *</label>
                            <input type="text" class="form-control ess-is-required ess-inputmask-numeric" name="montant"
                            data-msg="Veuillez renseigner le montant" value="{{ $cotisationExceptionnelles->montant }}">
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

