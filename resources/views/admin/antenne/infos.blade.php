@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
      <a href="{{ route('antenne.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4" style="width: 100px">
                    {!! $antenne->map !!}
                    {{-- <iframe src="{{ $antenne->map }}" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> --}}
                </div>
                <div class="col-md-8">
                    <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('antenne.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="itemId" value="{{ $antenne->id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nom *</label>
                                    <input type="text" class="form-control ess-is-required" name="nom" maxlength="190"
                                    data-msg="Veuiller renseigner le nom de l'antenne" value="{{ $antenne->nom }}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Contact </label>
                                    <input type="text" data-inputmask="'mask': '99 99 99 99 99'" class="form-control" name="phone"
                                    data-msg="Veuiller renseigner le contact" value="{{ $antenne->phone }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control ess-inputmask-email" name="email"
                                    value="{{ $antenne->email }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Adresse</label>
                                    <textarea name="adresse" class="form-control" rows="4">{{ $antenne->adresse }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Localisation (Copiez & Coller l'adresse map)</label>
                                    <textarea name="map" class="form-control" rows="4">{{ $antenne->map }}</textarea>
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

