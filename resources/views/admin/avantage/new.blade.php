@extends('admin/_.app')

@section('content')

<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
      <a href="{{ route('admin.avantage.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('admin.avantage.new') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Solution Cible *</label>
                    {{-- <a href="#">+</a> --}}
                    <select class="form-control ess-select2 ess-is-required" name="avantageSolution"
                        data-msg="Veuillez selectionner la solution cible">
                        @foreach ($solutions as $item)
                            <option value="{{ $item->id}}">{{ $item->title }}</option>
                        @endforeach
                        @foreach ($signElectroTitle as $item)
                            <option value="{{ $item->id}}">{{ $item->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Description *</label>
                    <textarea name="description" class="text-editor form-control ess-is-required" rows="4"
                    data-msg="Veuiller renseigner la description">{{ Request::old('description') }}</textarea>
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
@endsection

