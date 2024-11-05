@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> {{ $title }}<h1>
        <a href="{{ route('strategiqueActivite.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('strategiqueActivite.new') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Choisir l'objectif strategique</label>
                            <select class="form-control ess-is-required" name="objectifID"
                                data-msg="Veuiller selectionner l'objectif strategique">
                                @foreach ($objectif as $item)
                                    <option value="{{ $item->id }}">{{ $item->content }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Activite *</label>
                            <input type="text" class="form-control text-editor ess-is-required" name="content"
                            data-msg="Veuiller renseigner l'activite" value="{{Request::old('content')}}">
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

