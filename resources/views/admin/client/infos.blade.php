@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
      <a href="{{ route('client.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>


    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    <img class="img" src="{{ $client->getImg() }}" alt="">
                </div>
                <div class="col-md-8">
                    <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('client.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="clientId" value="{{ $client->id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Raison Social *</label>
                                    <input type="text" class="form-control ess-is-required" name="name"
                                    data-msg="Veuiller renseigner la raison social du partenaire" value="{{ $client->name }}">
                                </div>
                            </div>
                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Est-ce un partenaire ?</label>
                                    <select class="form-control" name="isPartener"
                                        data-msg="Est-ce un partenaire ?">
                                        <option value="0" {{ $client->isPartener == 0 ? 'selected="selected"' : "" }}>
                                            Non
                                        </option>
                                        <option value="1" {{ $client->isPartener == 1 ? 'selected="selected"' : "" }}>
                                            Oui
                                        </option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Balise ALT *</label>
                                    <input name="alt" type="text" class="form-control ess-is-required" value="{{ $client ? $client->alt : '' }}" data-msg="Veuiller renseigner la balise ALT de l'image">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Lien du site web </label>
                                    <input type="text" class="form-control" name="link"  value="{{ $client->link }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Logo</label>
                            <input type="file" class="form-control" name="img" accept="image/*">
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

