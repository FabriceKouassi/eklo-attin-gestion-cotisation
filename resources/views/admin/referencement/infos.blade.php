@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
      <a href="{{ route('referencement.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>


    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('referencement.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="referencementId" value="{{ $referencement->id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Page liée au referencement</label>
                                    {{-- <a href="#">+</a> --}}
                                    <select class="form-control ess-select2 ess-is-required" name="pageCible"
                                        data-msg="Veuiller selectionner la page">
                                        <option value="accueil" {{ $referencement->pageCible == 'accueil' ? 'selected="selected"' : ''}}>
                                            Accueil
                                        </option>
                                        <option value="directeur" {{ $referencement->pageCible == 'directeur' ? 'selected="selected"' : ''}}>
                                            Mot du directeur
                                        </option>
                                        <option value="historique" {{ $referencement->pageCible == 'historique' ? 'selected="selected"' : ''}}>
                                            Historique
                                        </option>
                                        <option value="mission" {{ $referencement->pageCible == 'mission' ? 'selected="selected"' : ''}}>
                                            Mission
                                        </option>
                                        <option value="organisation" {{ $referencement->pageCible == 'organisation' ? 'selected="selected"' : ''}}>
                                            Organisation
                                        </option>
                                        <option value="plan" {{ $referencement->pageCible == 'plan' ? 'selected="selected"' : ''}}>
                                            Plan Stratégique
                                        </option>
                                        <option value="politique" {{ $referencement->pageCible == 'politique' ? 'selected="selected"' : ''}}>
                                            Politique Qualité
                                        </option>
                                        <option value="prestation" {{ $referencement->pageCible == 'prestation' ? 'selected="selected"' : ''}}>
                                            Prestations
                                        </option>
                                        <option value="tarification" {{ $referencement->pageCible == 'tarification' ? 'selected="selected"' : ''}}>
                                            Tarifications
                                        </option>
                                        <option value="laboratoire" {{ $referencement->pageCible == 'laboratoire' ? 'selected="selected"' : ''}}>
                                            Laboratoires
                                        </option>
                                        <option value="calendrier" {{ $referencement->pageCible == 'calendrier' ? 'selected="selected"' : ''}}>
                                            Calendrier de vaccinations
                                        </option>
                                        <option value="vaccin" {{ $referencement->pageCible == 'vaccin' ? 'selected="selected"' : ''}}>
                                            Vaccins disponible
                                        </option>
                                        <option value="galerie" {{ $referencement->pageCible == 'galerie' ? 'selected="selected"' : ''}}>
                                            Galerie photo
                                        </option>
                                        <option value="faq" {{ $referencement->pageCible == 'faq' ? 'selected="selected"' : ''}}>
                                            FAQ
                                        </option>
                                        <option value="agenda" {{ $referencement->pageCible == 'agenda' ? 'selected="selected"' : ''}}>
                                            Agendas
                                        </option>
                                        <option value="document" {{ $referencement->pageCible == 'document' ? 'selected="selected"' : ''}}>
                                            Documents
                                        </option>
                                        <option value="blog" {{ $referencement->pageCible == 'blog' ? 'selected="selected"' : ''}}>
                                            Blog
                                        </option>
                                        <option value="contact" {{ $referencement->pageCible == 'contact' ? 'selected="selected"' : ''}}>
                                            Contact
                                        </option>
                                        <option value="antenne" {{ $referencement->pageCible == 'antenne' ? 'selected="selected"' : ''}}>
                                            Antennes & Postes
                                        </option>
                                        <option value="reclamation" {{ $referencement->pageCible == 'reclamation' ? 'selected="selected"' : ''}}>
                                            Reclamation et Suggestions
                                        </option>

                                        {{-- <option value="-----------" disabled>---------------------------------------------------</option>

                                        @foreach ($solutions as $item)
                                            <option value="{{ $item->title }}" {{ $referencement->pageCible === $item->title ? 'selected="selected"' : ''}}>
                                                {{ $item->title }}
                                            </option>
                                        @endforeach --}}

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Titre du site</label>
                                    <textarea name="title" class="form-control ess-is-required" rows="2" maxlength="60" data-msg="Veuillez attribuer un titre qui concerne la page à referencer">
                                        {{ $referencement->title }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>meta_description</label>
                                    <textarea name="meta_description" class="form-control" rows="2" maxlength="230">
                                        {{ $referencement->meta_description }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>meta_robots</label>
                                    <textarea name="meta_robots" class="form-control" rows="2">
                                        {{ $referencement->meta_robots }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>meta_keywords</label>
                                    <textarea name="meta_keywords" class="form-control" rows="3">
                                        {{ $referencement->meta_keywords }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>meta_category</label>
                                    <textarea name="meta_category" class="form-control" rows="3">
                                        {{ $referencement->meta_category }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>meta_identifier_url</label>
                                    <textarea name="meta_identifier_url" class="form-control" rows="3">
                                        {{ $referencement->meta_identifier_url }}
                                    </textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>meta_reply_to</label>
                                    <textarea name="meta_reply_to" class="form-control" rows="3">
                                        {{ $referencement->meta_reply_to }}
                                    </textarea>
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

