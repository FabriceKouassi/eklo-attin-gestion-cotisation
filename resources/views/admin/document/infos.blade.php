@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
      <a href="{{ route('document.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('document.update') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="itemId" value="{{ $document->id }}">
                <div class="row">
                    <div class="col-md-4">
                        {{-- <img src="{{ $document->getImg() }}" alt="{{ $document->img_alt }}" style="width: 100%;"> --}}
                        <iframe src="{{ $document->getDoc() }}" frameborder="0" style="width: 100%; height: 50vh;"></iframe>
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Choisir le type du laboratoire</label>
                                    <select class="form-control" name="documentType" data-msg="Veuiller selectionner le type de document">
                                        @foreach ($documentType as $item)
                                            <option value="{{ $item->id}}" {{ (int) $document->document_types_id === (int) $item->id ? 'selected="selected"' : "" }}>
                                                {{ $item->libelle }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Titre *</label>
                                    <input type="text" class="form-control ess-is-required" name="title"
                                    data-msg="Veuillez renseigné le titre du document" value="{{ $document->title ?? ''}}"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" class="form-control" name="img" accept="image/*" data-msg="Veuillez choisir l'image d'illustration">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Balise ALT pour l'image</label>
                                    <input type="text" class="form-control ess-is-required" name="img_alt"
                                    data-msg="La balise ALT de l'image est importante pour le réferencement. Veuillez renseigner le champs svp" value="{{ $document->img_alt ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Brochure (PDF)</label>
                                    <input type="file" class="form-control" name="doc" accept=".pdf">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Balise ALT pour le document</label>
                                    <input type="text" class="form-control" name="doc_alt" value="{{ $document->doc_alt }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description *</label>
                                    <textarea name="description" id="description" class="form-control ess-is-required" required rows="4"
                                        data-msg="Veuillez renseigner la description">{{ $document->description }}</textarea>
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

