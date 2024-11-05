@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
      <a href="{{ route('contact.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <form class="ess-form-checked" autocomplete="off" method="post" action="">
                        @csrf
                        <input type="hidden" name="itemID" value="{{ $contact->id }}">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Nom du visiteur</label>
                                    <input type="text" class="form-control" name="fullName"
                                    data-msg="Veuiller renseigner le titre" value="{{ $contact->fullName }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Téléphone</label>
                                    <input type="text" class="form-control" name="phone"
                                    data-msg="Veuiller renseigner le adresse" value="{{ $contact->phone }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email"
                                    data-msg="Veuiller renseigner le contact" value="{{ $contact->email }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea name="message" class="form-control" rows="6"
                                    ata-msg="Veuiller renseigner la description" readonly>{{ $contact->message }}</textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

