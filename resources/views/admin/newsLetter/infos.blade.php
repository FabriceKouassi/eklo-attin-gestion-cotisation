@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
      <a href="{{ route('newsletter.all') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-arrow-left fa-sm text-white-50"></i></a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row">
                <div class="col-md">
                    <input type="hidden" name="itemId" value="{{ $newsLetter->id }}">

                    <div class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                <label>Nom et prénoms</label>
                                <input type="text" class="form-control" name="email"
                                data-msg="Veuiller renseigner l'email" value="{{ $newsLetter->nom }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" class="form-control" name="phone"
                                data-msg="Veuiller renseigner le contact" value="{{ $newsLetter->email }}" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

