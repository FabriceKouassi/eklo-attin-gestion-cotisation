@extends('front._.app')

@section('page-title', $pIndex)

@section('content')

        <section class="project-establishment">
            <div class="section-title pl-50">
                <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
                <h3>{{ $retourPrestationType->libelle }}</h3>
            </div>
            <div class="mt-5">
                {!! $retourPrestationType->description !!}
            </div>
            <div class="table-container mt-5" style="{{ count($prestation) > 0 ? '' : 'visibility: hidden;' }}">
                <header class="table-header">
                    {{-- <p>Synopsis du projet d'établissement 2012-2015 de l'INHP</p> --}}
                </header>
                <table class="strategy-table">
                    <thead>
                        <tr>
                            <th>Les differentes prestations</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prestation as $item)
                            <tr>
                                <td data-label="Activités">{{ $item->libelle }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

@endsection
