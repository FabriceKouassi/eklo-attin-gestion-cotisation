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
            <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('referencement.new') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Page liée au referencement *</label>
                            <select class="form-control ess-select2 ess-is-required" name="pageCible"
                                data-msg="Veuiller selectionner la page">

                                {{-- <option value="accueil">Accueil</option>
                                <option value="directeur">Mot du directeur</option>
                                <option value="historique">Historique</option>
                                <option value="mission">Mission</option>
                                <option value="organisation">Organisation</option>
                                <option value="plan">Plan Stratégique</option>
                                <option value="politique">Politique Qualité</option>
                                <option value="prestation">Prestations</option>
                                <option value="tarification">Tarifications</option>
                                <option value="laboratoire">Laboratoires</option>
                                <option value="calendrier">Calendrier de vaccinations</option>
                                <option value="vaccin">Vaccins disponible</option>
                                <option value="galerie">Galerie photo</option>
                                <option value="faq">FAQ</option>
                                <option value="agenda">Agendas</option>
                                <option value="document">Documents</option>
                                <option value="blog">Blog</option>
                                <option value="contact">Contact</option>
                                <option value="antenne">Antennes & Postes</option>
                                <option value="reclamation">Reclamation et Suggestions</option> --}}

                                @php
                                    $options = [
                                        'accueil' => 'Accueil',
                                        'directeur' => 'Mot du directeur',
                                        'historique' => 'Historique',
                                        'mission' => 'Mission',
                                        'organisation' => 'Organisation',
                                        'plan' => 'Plan Stratégique',
                                        'politique' => 'Politique Qualité',
                                        'prestation' => 'Prestations',
                                        'tarification' => 'Tarifications',
                                        'laboratoire' => 'Laboratoires',
                                        'calendrier' => 'Calendrier de vaccinations',
                                        'vaccin' => 'Vaccins disponible',
                                        'galerie' => 'Galerie photo',
                                        'faq' => 'FAQ',
                                        'agenda' => 'Agendas',
                                        'document' => 'Documents',
                                        'blog' => 'Blog',
                                        'contact' => 'Contact',
                                        'antenne' => 'Antennes & Postes',
                                        'reclamation' => 'Réclamation et Suggestions',
                                    ];
                                @endphp

                                @foreach ($options as $value => $label)
                                    @if (!in_array($value, $existingPages))
                                        <option value="{{ $value }}">{{ $label }}</option>
                                    @endif
                                @endforeach

                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Titre du site *</label>
                            <textarea name="title" class="form-control" rows="2" maxlength="60" value="{{ Request::old('title') }}"
                            data-msg="Veuiller saisir le titre"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>meta_description *</label>
                            <textarea name="meta_description" class="form-control ess-is-required" rows="2" maxlength="230"
                            data-msg="Veuiller saisir la meta_description"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>meta_robots *</label>
                            <textarea name="meta_robots" class="form-control ess-is-required" rows="2"
                            data-msg="Veuiller saisir la meta_robots"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>meta_keywords *</label>
                            <textarea name="meta_keywords" class="form-control ess-is-required" rows="3"
                            data-msg="Veuiller saisir la meta_keywords"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>meta_category *</label>
                            <textarea name="meta_category" class="form-control" rows="3"
                            data-msg="Veuiller saisir la meta_category"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>meta_identifier_url *</label>
                            <textarea name="meta_identifier_url" class="form-control" rows="3"
                            data-msg="Veuiller saisir la meta_identifier_url"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>meta_reply_to *</label>
                            <textarea name="meta_reply_to" class="form-control" rows="3"
                            data-msg="Veuiller saisir la meta_reply_to"></textarea>
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

