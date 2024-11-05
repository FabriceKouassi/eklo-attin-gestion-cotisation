@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">{{ $title }}</h1>
      <a href="{{ route('user.new') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> Nouvel utilisateur</a>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered ess-dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                      <tr>
                            <th></th>
                            <th>Dernière connexion</th>
                            <th>Nom et prénoms</th>
                            <th>Contacts</th>
                            <th class="text-center">Etat | Role</th>
                            <th width="90"></th>
                      </tr>
                </thead>
                <tbody>
                    @foreach ($users as $item)
                        <tr>
                            <td class="text-center"><a class="img" style="background-image: url('{{ $item->getImg() }}');"></a></td>
                            <td>{{ $item->last_login !== null ? $item->diffForHumans($item->last_login) : 'Jamais' }}</td>
                            <td>{{ $item->nom }} {{ $item->prenoms }}</td>
                            <td>
                                {{ $item->email }}
                                <?= $item->phone ? "<br>#".$item->phone : "" ?>
                            </td>
                            <td class="text-center">
                                @if ($item->enabled == 1)
                                    <span class="badge badge-light">Actif</span>
                                    <span class="badge badge-light text-light {{ $item->role == 'membre' ? 'bg-info' : ($item->role == 'gestionnaire' ? 'bg-warning' : 'bg-success') }}">
                                        {{ $item->role == 'membre' ? 'Membre' : ($item->role == 'gestionnaire' ? 'Gestionnaire' : 'Administrateur') }}
                                    </span>
                                @else
                                    <span class="badge badge-danger">Désactivé</span>
                                    <span class="badge badge-danger {{ $item->role == 'membre' ? 'bg-info' : ($item->role == 'gestionnaire' ? 'bg-warning' : 'bg-success') }}">
                                        {{ $item->role == 'membre' ? 'Membre' : ($item->role == 'gestionnaire' ? 'Gestionnaire' : 'Administrateur') }}
                                    </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('user.updateForm', [$item->id]) }}" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{ route('user.delete', [$item->id]) }}" class="btn btn-danger btn-circle btn-sm ess-link-checked"
                                    data-msg="Souhaitez-vous suprimer définitivement ce utilisateur ({{ $item->nom }} {{ $item->prenoms }})">
                                    <i class="fas fa-trash"></i>
                                </a>
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
