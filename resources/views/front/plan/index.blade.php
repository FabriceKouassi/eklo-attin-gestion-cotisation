@extends('front._.app')

@section('page-title', $pIndex)

@section('content')
    <section class="project-establishment">
    <div class="section-title pl-50">
        <img src="{{ asset('model/assets/images/molecule.png') }}" alt="">
        <h3>{{ $title }}</h3>
    </div>
    <div class="table-header-container">
        <header class="table-header">
            <h2>Projet d'établissement</h2>
            <p>Synopsis du projet d'établissement 2012-2015 de l'INHP</p>
        </header>
    </div>
    <div class="table-container mt-5">
        
        <div class="table-body">
            <table class="strategy-table">
                <thead>
                    <tr>
                        <th>Axes Stratégiques</th>
                        <th>Objectifs Stratégiques</th>
                        <th>Activités</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($axes as $axe)
                        @php $firstAxe = true @endphp
                        @foreach($axe->objectifs as $objectif)
                            @php $firstObjectif = true @endphp
                            @foreach($objectif->activites as $index => $activite)
                                <tr>
                                    @if($firstAxe)
                                        <td rowspan="{{ count($axe->objectifs) }}" style="vertical-align: middle; text-align: center">{{ !empty($axe->libelle) ? $axe->libelle : '' }}</td>
                                        @php $firstAxe = false @endphp
                                    @endif
                                    @if($firstObjectif)
                                        <td rowspan="{{ count($objectif->activites) }}" style="vertical-align: middle;">{{ !empty($objectif->content) ? $objectif->content : '' }}</td>
                                        @php $firstObjectif = false @endphp
                                    @endif
                                    <td rowspan="1">{!! $activite->content !!}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </section>
@endsection
