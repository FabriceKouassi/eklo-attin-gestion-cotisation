@extends('admin/_.app')


@section('content')
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800"></h1>
      <a href="{{ route('referencement.new') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
        <i class="fas fa-plus fa-sm text-white-50"></i> {{ config('global.btn_save_name') }}</a>
    </div>

    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered ess-dataTable" width="100%" cellspacing="0">
                <thead class="thead-dark">
                        <tr>
                            <th>Titre</th>
                            <th class="text-center">Page cible</th>
                            <th width="90">Actions</th>
                        </tr>
                </thead>
                <tbody>
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

                       @foreach ($referencement as $item)
                        <tr>
                            <td class="text-center">
                                {{ $item->title ?? '' }}
                            </td>
                            <td class="text-center">
                                @foreach ($options as $value => $label)
                                    @if ($item->pageCible == $value)
                                        <span class="badge badge-success">{{ $label }}</span>
                                    @endif
                                @endforeach                                
                            </td>
                            <td class="text-center">
                                <a href="{{ route('referencement.updateForm', ['id'=>$item->id]) }}" class="btn btn-warning btn-circle btn-sm">
                                    <i class="fas fa-info-circle"></i>
                                </a>
                                <a href="{{ route('referencement.delete', ['id'=>$item->id]) }}" class="btn btn-danger btn-circle btn-sm ess-link-checked"
                                    data-msg="Souhaitez-vous suprimer définitivement ce document">
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
