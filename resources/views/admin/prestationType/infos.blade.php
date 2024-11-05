@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
      <a href="{{ route('prestationType.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('prestationType.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="itemId" value="{{ $prestationType->id }}">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Libelle *</label>
                                    <input type="text" class="form-control ess-is-required" name="libelle"
                                    data-msg="Veuiller renseigner le libelle" value="{{ $prestationType->libelle }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mettre en avant dans le sous-menu ?</label>
                                    <select class="form-control" name="isNav" id="isNav">
                                        <option value="0" {{ $prestationType->isNav === 0 ? 'selected="selected"' : "" }}>Non</option>
                                        <option value="1" {{ $prestationType->isNav === 1 ? 'selected="selected"' : "" }}>Oui</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="img" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" id="description" cols="3" rows="3" class="form-control text-editor">
                                        {{ $prestationType->description }}
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

