@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
      <a href="{{ route('tarification.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('tarification.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="itemId" value="{{ $tarification->id }}">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Titre *</label>
                                    <input type="text" class="form-control ess-is-required" name="title" maxlength="190"
                                    data-msg="Veuiller renseigner le titre de la tarification" value="{{ $tarification->title }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="content" class="text-editor form-control ess-is-required" rows="4" data-msg="Veuiller renseigner la description">
                                        {{ $tarification->content }}
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

