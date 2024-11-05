@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
    </div>

    <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('company.save') }}" enctype="multipart/form-data">
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Nom *</label>
                                    <input type="text" class="form-control ess-is-required" name="name"
                                    data-msg="Veuiller renseigner le nom de la structure" value="{{ $company ? $company->name : '' }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Balise ALT *</label>
                                    <input name="alt" type="text" class="form-control ess-is-required" value="{{ $company ? $company->alt : '' }}" data-msg="Veuiller renseigner la balise ALT de l'image">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Logo Primaire</label>
                                    <input type="file" class="form-control" name="logo1" accept="image/*">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Logo Secondaire</label>
                                    <input type="file" class="form-control" name="logo2" accept="image/*">
                                </div>
                            </div>
                        </div>

                        @if ($company)
                            <div class="row">
                                <div class="col">
                                    <div class="text-center p-2 m-2" style="width: 200px">
                                        <span>Logo primaire</span>
                                        <img class="img" src="{{ $company ? $company->getLogo1() : '' }}" alt="">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="text-center p-2 m-2">
                                        <span>Logo secondaire</span>
                                        <img class="img" src="{{ $company ? $company->getLogo2() : '' }}" alt="">
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="col-md">
                        @csrf
                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Adresse</label>
                                    <textarea name="adress" class="form-control" rows="2">{{ $company ? $company->adress : '' }}</textarea>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="col">
                                    <div class="form-group">
                                        <label>slogan</label>
                                        <input type="text" class="form-control" name="slogan"
                                        value="{{ $company ? $company->slogan : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Email 1 *</label>
                                    <input type="text" class="form-control ess-is-required ess-inputmask-email" name="email1"
                                    data-msg="Veuiller renseigner l'adresse mail 1" value="{{ $company ? $company->email1 : '' }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Téléphone 1 * </label>
                                    <input type="text" data-inputmask="'mask': '99 99 99 99 99'" class="form-control ess-is-required" name="phone1"
                                    data-msg="Veuiller renseigner le numéro de téléphone 1" value="{{ $company ? $company->phone1 : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Email 2</label>
                                    <input type="text" class="form-control ess-inputmask-email" name="email2"
                                    value="{{ $company ? $company->email2 : '' }}">
                                </div>
                                {{-- <div class="form-group">
                                    <label>Email 3</label>
                                    <input type="text" class="form-control ess-inputmask-email" name="email3"
                                    value="{{ $company ? $company->email3 : '' }}">
                                </div> --}}
                                <div class="form-group">
                                    <label>Lien Facebook </label>
                                    <input type="text" class="form-control" name="facebookLink"
                                    value="{{ $company ? $company->facebook : '' }}">
                                </div>
                                <div class="form-group">
                                    <label>Lien Linkedin </label>
                                    <input type="text" class="form-control" name="linkedinLink"
                                    value="{{ $company ? $company->linkedin : '' }}">
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-group">
                                    <label>Téléphone 2 </label>
                                    <input type="text" data-inputmask="'mask': '99 99 99 99 99'" class="form-control" name="phone2"
                                    value="{{ $company ? $company->phone2 : '' }}">
                                </div>
                                {{-- <div class="form-group">
                                    <label>Téléphone 3 </label>
                                    <input type="text" data-inputmask="'mask': '99 99 99 99 99'" class="form-control" name="phone3"
                                    value="{{ $company ? $company->phone3 : '' }}">
                                </div> --}}
                                <div class="form-group">
                                    <label>Lien Twitter </label>
                                    <input type="text" class="form-control" name="twitterLink"
                                    value="{{ $company ? $company->twitter : '' }}">
                                </div>
                                <div class="form-group">
                                    <label>Lien Youtube </label>
                                    <input type="text" class="form-control" name="youtubeLink"
                                    value="{{ $company ? $company->youtube : '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Vision</label>
                                    <textarea name="vision" class="form-control" rows="4">{{ $company ? $company->vision : '' }}</textarea>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Localisation map du siège</label>
                                    <textarea name="aspiration" class="form-control" rows="4">{{ $company ? trim($company->aspiration) : '' }}</textarea>
                                </div>
                            </div>
                            {{-- <div class="col">
                                <div class="form-group">
                                    <label>Aspiration</label>
                                    <textarea name="aspiration" class="form-control" rows="4">{{ $company ? $company->aspiration : '' }}</textarea>
                                </div>
                            </div> --}}
                        </div>

                        {{-- <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Mission</label>
                                    <textarea name="mission" class="form-control" rows="4">{{ $company ? $company->mission : '' }}</textarea>
                                </div>
                            </div>
                        </div> --}}

                        <div><small>* Obligatoire</small></div>

                        <button type="submit" class="btn btn-primary btn-sm btn-icon-split mt-2">
                            <span class="icon text-gray-600">
                                <i class="fas fa-arrow-right"></i>
                            </span>
                            <span class="text">Enregistrer</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

