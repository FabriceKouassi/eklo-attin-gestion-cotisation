@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
      <a href="{{ route('agenda.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <form class="ess-form-checked" autocomplete="off" method="post" action="{{ route('agenda.update') }}" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="itemId" value="{{ $agenda->id }}">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ $agenda->getImg() }}" alt="{{ $agenda->img }}" style="width: 100%;">
                    </div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Titre *</label>
                                    <input type="text" class="form-control ess-is-required" name="title"
                                    data-msg="Veuillez renseigné le titre du agenda" value="{{ $agenda->title ?? ''}}"/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image*</label>
                                    <input type="file" class="form-control" name="img" accept="image/*" data-msg="Veuillez choisir l'image d'illustration">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Date</label>
                                    <input type="date" class="form-control ess-is-required" name="eventDate" data-mask="jj/mm/aaaa"
                                    data-msg="Veuillez renseigner la date" value="{{ $agenda->eventDate ?? ''}}">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Heure</label>
                                    <input type="time" class="form-control ess-is-required" name="eventHour" data-mask="HH:ss"
                                    data-msg="Veuillez renseigner l'heure" value="{{ $agenda->eventHour ?? ''}}">
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
                                    <label>Lieu</label>
                                    <input type="text" class="form-control" name="location" value="{{ $agenda->location }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description *</label>
                                    <textarea name="content" id="content" class="form-control" required rows="4"
                                        data-msg="Veuillez renseigner la description">{{ $agenda->content }}</textarea>
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

