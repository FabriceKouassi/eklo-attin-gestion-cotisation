@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"> {{ $title }}<h1>
        <a href="{{ route('blog.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('blog.new') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Titre *</label>
                            <input type="text" class="form-control ess-is-required" name="title"
                            data-msg="Veuillez renseigné le titre du blog" value="">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Image*</label>
                            <input type="file" class="form-control ess-is-required" name="img" accept="image/*" data-msg="Veuillez choisir l'image d'illustration">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Balise ALT pour l'image</label>
                            <input type="text" class="form-control ess-is-required" name="img_alt"
                            data-msg="La balise ALT de l'image est importante pour le réferencement. Veuillez renseigner le champs svp" value="">
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
                            <input type="text" class="form-control" name="doc_alt">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Description *</label>
                            <textarea name="content" id="description" class="text-editor form-control ess-is-required" required rows="4"
                                data-msg="Veuillez renseigner la description"></textarea>
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

