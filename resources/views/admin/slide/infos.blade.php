@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
      <a href="{{ route('slide.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="col">
                        <span>Image</span>
                        <img class="img my-2" src="{{ $slide->getImg() }}" alt="Image">
                    </div>
                </div>
                <div class="col-md-8">
                    <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('slide.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="itemId" value="{{ $slide->id }}">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Texte (40 caractères maximum)</label>
                                    <input type="text" class="form-control" name="text"
                                    data-msg="Veuiller renseigner le texte" value="{{ $slide->text }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Etat</label>
                                    <select class="form-control ess-select2 " name="enabled">
                                        <option value="1"
                                            {{ $slide->enabled==1 ? 'selected="selected"' : "" }}>
                                            Actif
                                        </option>
                                        <option value="0"
                                            {{ $slide->enabled==0 ? 'selected="selected"' : "" }}>
                                            Inactif
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control"
                                    data-msg="Veuiller selectionner l'image " name="img" accept="image/*">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Balise ALT image *</label>
                                    <input name="alt" value="{{ $slide ? $slide->alt : '' }}" type="text" class="form-control" data-msg="Veuiller renseigner la balise ALT de l'image ">
                                </div>
                            </div>
                        </div>

                        <div><small>* Obligatoire</small></div>

                        <button type="submit" class="btn btn-primary btn-sm btn-icon-split mt-3">
                            <span class="icon text-gray-600">
                              <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="text">Modifier</span>
                      </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

