@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
        <a href="{{ route('motif.all') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i>
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('motif.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="itemId" value="{{ $motif->id }}">

                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Libelle *</label>
                                    <input type="text" class="form-control ess-is-required" name="libelle"
                                    data-msg="Veuillez renseigner le libelle" value="{{ $motif->libelle }}">
                                </div>
                            </div>
                        </div>

                        <div><small>* Obligatoire</small></div>

                        <button type="submit" class="btn btn-primary btn-sm btn-icon-split mt-2">
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

