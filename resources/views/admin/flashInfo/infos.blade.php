@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
      <a href="{{ route('flashInfo.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('flashInfo.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="itemId" value="{{ $flashInfo->id }}">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Contenu *</label>
                                    <textarea name="content" class="form-control text-editor ess-is-required" rows="2" data-msg="Veuillez renseigner le contenu">
                                        {{ $flashInfo ? $flashInfo->content : '' }}
                                    </textarea>
                                    {{-- <input type="text" class="form-control ess-is-required" name="content"
                                    data-msg="Veuillez renseigné le contenu" value="{{ $flashInfo->content }}"> --}}
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

