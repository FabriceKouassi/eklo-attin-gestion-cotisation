@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
      <a href="{{ route('mediatheque.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('mediatheque.update') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="itemId" value="{{ $mediatheque->id }}">
                <div class="row">
                    <div class="col-md-4">
                        @foreach ($mediatheque->getImgs() as $key => $item)
                            {{-- <img src="{{ $item }}" alt="{{ $mediatheque->title }}" style="width: 200px;"> --}}
                            <div class="image-container" style="position: relative; display: inline-block;">
                                <img src="{{ $item }}" alt="{{ $mediatheque->title }}" style="width: 200px;">
                                {{-- <button class="delete-button" onclick="deleteImage('{{ $item }}')">Supprimer</button> --}}
                                <a href="{{ route('mediatheque.delete.file', ['id' => $mediatheque->id, 'key' => $key]) }}" class="delete-button">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Titre *</label>
                                    <input type="text" class="form-control ess-is-required" name="title"
                                    data-msg="Veuillez renseigné le titre du médiatheque" value="{{ $mediatheque->title ?? ''}}"/>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Images*</label>
                                    <input type="file" class="form-control" id="multiImages" name="imgs[]" multiple accept="image/*" data-msg="Veuillez choisir les images d'illustration">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description *</label>
                                    <textarea name="content" id="description" class="text-editor form-control ess-is-required" required rows="4"
                                        data-msg="Veuillez renseigner la description">{{ $mediatheque->content }}</textarea>
                                </div>
                            </div>
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


@endsection

