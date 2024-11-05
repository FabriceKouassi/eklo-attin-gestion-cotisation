@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> {{ $title }}<h1>
        <a href="{{ route('laboratoire.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('laboratoire.new') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Choisir le type du laboratoire</label>
                            <select class="form-control" name="laboratoireType"
                                data-msg="Veuiller selectionner le type du laboratoire">
                                @foreach ($laboratoireType as $item)
                                    <option value="{{ $item->id }}">{{ $item->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Nom *</label>
                            <input type="text" class="form-control ess-is-required" name="nom" maxlength="190"
                            data-msg="Veuillez renseigner le nom du laboratoire" value="{{ Request::old('nom') }}">
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
                            <label>Description *</label>
                            <input type="text" class="form-control ess-is-required text-editor" name="description" maxlength="190"
                            data-msg="Veuillez renseigner la description du laboratoire" value="{{ Request::old('description') }}">
                        </div>
                    </div>
                    {{-- <div class="col-md-6">
                        <div class="form-group">
                            <label>Icon *</label>
                            <input type="file" class="form-control ess-is-required" name="icon" accept=".png" data-msg="Veuillez choisir l'icone du laboratoire">
                        </div>
                    </div> --}}
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

