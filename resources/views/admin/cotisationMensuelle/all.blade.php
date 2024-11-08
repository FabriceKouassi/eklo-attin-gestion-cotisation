@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
      <a href="{{ route('cotisationMensuelle.new') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> {{ config('global.btn_save_name') }}</a>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered ess-dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Membres</th>
                        <th>Periodes payées</th>
                        <th>Montants</th>
                        @if (Auth::user()->role  === 'admin')
                            <th>Gestionnaires</th>
                        @endif
                        <th width="90">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cotisationMensuelle as $item)
                        <tr>
                            <td class="text-center">
                                <span class="badge badge-light">{{ $item->user->nom }} {{ $item->user->prenoms }}</span>
                            </td>
                            <td class="text-center">
                                {{ $item->format_date($item->date_paiement) }}
                            </td>
                            <td class="text-center">
                                {{ $item->user->fonction->montant }}
                            </td>
                            @if (Auth::user()->role  === 'admin')
                                <td class="text-center">
                                    {{ $item->gestionnaire->nom }} {{ $item->gestionnaire->prenoms }}
                                </td>
                            @endif
                            
                            <td class="text-center">
                                <a href="{{ route('cotisationMensuelle.updateForm', ['id'=>$item->id]) }}" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                @if (Auth::user()->role  === 'admin')
                                    <a href="{{ route('cotisationMensuelle.delete', ['id'=>$item->id]) }}" class="btn btn-danger btn-circle btn-sm ess-link-checked"
                                        data-msg="Êtes vous sûr de vouloir supprimé ?">
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
