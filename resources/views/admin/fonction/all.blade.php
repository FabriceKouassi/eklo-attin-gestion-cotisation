@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
      <a href="{{ route('fonction.new') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> {{ config('global.btn_save_name') }}</a>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered ess-dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                      <tr>
                            <th>Libelle</th>
                            <th>Montant</th>
                            <th width="90"></th>
                      </tr>
                </thead>
                <tbody>
                    @foreach ($fonctions as $item)
                        <tr>
                            <td>{{ $item->libelle }}</td>
                            <td>
                                {{ $item->montant }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('fonction.updateForm', [$item->id]) }}" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                @if (Auth::user()->role  === 'admin')
                                    <a href="{{ route('fonction.delete', [$item->id]) }}" class="btn btn-danger btn-circle btn-sm ess-link-checked"
                                        data-msg="Voulez vous supprimer cet enregistrement ?">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </div>


</div>
@endsection