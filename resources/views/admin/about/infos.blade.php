@extends('admin/_.app')

@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('about.save') }}" enctype="multipart/form-data">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-2">
                        @if ($about)
                            <div class="col">
                                <div class="text-center p-2 m-2">
                                    <span>Image N°1</span>
                                    <img class="img1" src="{{ $about ? $about->getImg1() : '' }}" alt="{{ $about->alt1 }}" style="width: 100%;">
                                </div>
                            </div>
                            <div class="col">
                                <div class="text-center p-2 m-2">
                                    <span>Image N°2</span>
                                    <img class="img2" src="{{ $about ? $about->getImg2() : '' }}" alt="{{ $about->alt1 }}" style="width: 100%;">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Brochure (PDF)</label>
                                    <input type="file" class="form-control" name="doc" accept=".pdf">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Image A propos</label>
                                    <input type="file" class="form-control" name="img1" accept="image/*">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Image Performance (Page Acceuil)</label>
                                    <input type="file" class="form-control" name="img2" accept="image/*">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" id="description" class="text-editor form-control ess-is-required" rows="4"
                                        data-msg="Veuiller renseigner la description">{{ $about ?old("description",$about->description) : '' }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Objectif</label>
                                    <textarea name="objectif" id="objectif" class="text-editor2 form-control ess-is-required" rows="4"
                                        data-msg="Veuiller renseigner l'objectif">{{ $about ? $about->objectif : '' }}
                                    </textarea>
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
            </div>
        </div>
    </form>
</div>
@endsection

