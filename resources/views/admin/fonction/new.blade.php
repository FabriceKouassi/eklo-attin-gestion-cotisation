@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
      <a href="{{ route('fonction.all') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('fonction.new') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label>Libelle *</label>
                            <input type="text" class="form-control ess-is-required" name="libelle"
                            data-msg="Veuillez renseigner le libelle" value="{{Request::old('libelle') }}">
                        </div>
                    </div>
                    <div class="col-md-4">                        
                        <div class="form-group">
                            <label>Montant *</label>
                            <input type="text" class="form-control ess-is-required ess-inputmask-numeric" name="montant"
                            data-msg="Veuillez renseigner le montant" value="{{Request::old('montant')}}">
                        </div>
                    </div>
                </div>
                
                <div><small>* Obligatoire</small></div>

                <button type="submit" class="btn btn-primary btn-sm btn-icon-split mt-4">
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

