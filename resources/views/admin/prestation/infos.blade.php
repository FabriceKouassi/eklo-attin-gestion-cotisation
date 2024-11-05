@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
      <a href="{{ route('prestation.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('prestation.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="itemId" value="{{ $prestation->id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Choisir le type de la prestation</label>
                                    <select class="form-control" name="prestationType" data-msg="Veuiller selectionner le type de la prestation">
                                        @foreach ($prestationType as $item)
                                            <option value="{{ $item->id}}" {{ (int) $prestation->prestation_types_id === (int) $item->id ? 'selected="selected"' : "" }}>
                                                {{ $item->libelle }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Libelle *</label>
                                    <input type="text" class="form-control ess-is-required" name="libelle"
                                    data-msg="Veuiller renseigner le libelle" value="{{ $prestation->libelle }}">
                                </div>
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Document PDF</label>
                                    <input type="file" class="form-control" name="doc" accept=".pdf">
                                </div>
                            </div>
                        </div> --}}

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

