@extends('admin/_.app')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>

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
            <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('client.new') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Raison Social *</label>
                            <input type="text" class="form-control ess-is-required" name="name"
                            data-msg="Veuiller renseigner la raison  social" value="{{Request::old('name')}}">
                        </div>
                    </div>
                    {{-- <div class="col">
                        <div class="form-group">
                            <label>Est-ce un partenaire ?</label>
                            <select class="form-control" name="isPartener" data-msg="Est-ce un partenaire ?">
                                <option value="0">Non (par defaut)</option>
                                <option value="1">Oui</option>
                            </select>
                        </div>
                    </div> --}}
                </div>
                <div class="form-group">
                    <label>Balise ALT *</label>
                    <input name="alt" type="text" class="form-control ess-is-required" data-msg="Veuiller renseigner la balise ALT de l'image">
                </div>
                <div class="form-group">
                    <label>Lien du site web</label>
                    <input type="text" class="form-control" name="link" value="{{Request::old('link')}}">
                </div>
                <div class="form-group">
                    <label>Logo *</label>
                    <input type="file" class="form-control ess-is-required" data-msg="Veuiller le logo de l'entreprise" name="img" accept="image/*">
                </div>
                <div><small>*Obligatoire</small></div>

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



@endsection

