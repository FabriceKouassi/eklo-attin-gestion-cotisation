@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> {{ $title }}<h1>
        <a href="{{ route('cotisationMensuelle.all') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('cotisationMensuelle.new') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-1">                        
                        <div class="form-group">
                            <label>Payé *</label>
                            <input type="checkbox" class="form-control ess-is-required" name="status" value="payé" data-msg="Cocher payé pour continuer le processus"
                                {{ old('status') == 'payé' ? 'checked' : '' }} style="width: 1.5em">
                        </div>
                    </div>
                    <div class="col-md-11">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Utilisateur</label>
                            <select class="form-control ess-is-required" id="cotisation_mensuelle_user_id" name="user_id"
                                data-msg="Veuillez selectionner l'utilisateur">
                                <option value="">Sélectionner un utilisateur</option>
                                @foreach($users as $item)
                                    <option value="{{ $item->id }}">
                                        {{ $item->nom }} {{ $item->prenoms }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Périodes non payées</label>
                            <select class="form-control ess-is-required" id="periods" name="periods[]" multiple
                            data-msg="Veuillez selectionner le ou les périodes non payées">
                                <option value="">Sélectionner des périodes</option>
                            </select>
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

