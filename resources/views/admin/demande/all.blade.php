@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"></h1>
      <a href="{{ route('demande.new') }}" class="d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> {{ config('global.btn_save_name') }}</a>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered ess-dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                    <tr>
                        <th>Demandeurs</th>
                        <th>Motifs</th>
                        <th>Décisions</th>
                        <th width="90">Actions</th>
                    </tr>
                </thead>
                <tbody>
                       @foreach ($demandes as $item)
                            <tr>
                                <td class="text-center">
                                    <span class="badge badge-light">{{ $item->demandeur->nom }} {{ $item->demandeur->prenoms }}</span>
                                </td>
                                <td class="text-center">
                                    {{ $item->motif->libelle }}
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-danger {{ $item->decision == 0 ? 'bg-info' : ($item->decision == 1 ? 'bg-success' : 'bg-danger') }}">
                                        {{ $item->decision == 0 ? 'En attente' : ($item->decision == 1 ? 'Acceptée' : 'Refusée') }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('demande.updateForm', ['id'=>$item->id]) }}" class="btn btn-warning btn-circle btn-sm">
                                        <i class="fas fa-info-circle"></i>
                                    </a>
                                    @if (Auth::user()->role  === 'admin')
                                        <a href="{{ route('demande.delete', ['id'=>$item->id]) }}" class="btn btn-danger btn-circle btn-sm ess-link-checked"
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
