@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
      <a href="{{ route('admin.partener.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img class="img" src="{{ $partener->getImg() }}" alt="">
                </div>
                <div class="col-md-8">
                    <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('admin.partener.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="partenerId" value="{{ $partener->id }}">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Raison Social *</label>
                                    <input type="text" class="form-control ess-is-required" name="name"
                                    data-msg="Veuiller renseigner la raison social du partenaire" value="{{ $partener->name }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Lien du site web </label>
                                    <input type="text" class="form-control" name="link"  value="{{ $partener->link }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" class="form-control" name="img" accept="image/*">
                        </div>
                        <div class="form-group">
                            <label>Balise ALT *</label>
                            <input name="alt" type="text" class="form-control ess-is-required" value="{{ $partener ? $partener->alt : '' }}" data-msg="Veuiller renseigner la balise ALT de l'image">
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

