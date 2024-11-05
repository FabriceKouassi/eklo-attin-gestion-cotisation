@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
    </div>

    <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('mission.save') }}" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        @if ($mission)
                            <div class="col">
                                <div class="text-center p-2 m-2">
                                    <span>Image</span>
                                    <img class="img" src="{{ $mission ? $mission->getImg() : '' }}" alt="{{ $mission->alt }}">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>ALT</label>
                                    <input type="text" class="form-control" name="alt"
                                    data-msg="Veuillez renseigner le titre du mission" value="{{ $mission ? $mission->alt : '' }}" value="{{ Request::old('alt') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image {{ empty($mission->img) ? '*' : '' }}</label>
                                    <input type="file" class="form-control {{ empty($mission->img) ? 'ess-is-required' : '' }}" name="img" accept="image/*" data-msg="Veuillez choisir l'image">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Document {{ empty($mission->doc) ? '*' : '' }}</label>
                                    <input type="file" class="form-control {{ empty($mission->doc) ? 'ess-is-required' : '' }}" name="doc" accept=".pdf" data-msg="Veuillez choisir le document">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Détail</label>
                                    <textarea name="content" class="form-control text-editor ess-is-required" rows="2" data-msg="Veuillez renseigner le contenu">
                                        {{ $mission ? $mission->content : '' }}
                                    </textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div><small>* Obligatoire</small></div>

                    <button type="submit" class="btn btn-primary btn-sm btn-icon-split mt-2">
                        <span class="icon text-gray-600">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="text">Enregistrer</span>
                    </button>
            </div>
        </div>
    </form>
</div>
@endsection

