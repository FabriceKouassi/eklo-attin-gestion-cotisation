@extends('front._.app')

@section('page-title', $pIndex)

@section('content')
    <section class="project-establishment">
        <div class="section-title pl-50">
            <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
            <h3>{{ $title }}</h3>
        </div>
        <div class="table-container mt-5">
            @foreach ($vaccin as $item)
                <header class="table-header">
                    <p style="font-weight: 600; text-transform: uppercase; font-size: 18px">{{ $item->libelle }}</p>
                </header>
                <table class="strategy-table mb-2">
                    <thead>
                        <tr>
                            <th>PERIODE</th>
                            <th>VACCINS</th>
                            <th>AGE D’ADMINISTRATION</th>
                            <th>FREQUENCE</th>
                            <th>COUT (FCFA)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($item->vaccinsDisponibles as $item2)
                            <tr>
                                <td data-label="Axes Stratégiques">{{ $item2->periode }}</td>
                                <td data-label="Objectifs Stratégiques">{{ $item2->nom }}</td>
                                <td data-label="Activités">{{ $item2->age }}</td>
                                <td data-label="Activités">{!! $item2->frequence !!}</td>
                                <td data-label="Activités">{{ !empty($item2->cout) ? $item2->cout.' F/dose' : '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        </div>
    </section>
@endsection
