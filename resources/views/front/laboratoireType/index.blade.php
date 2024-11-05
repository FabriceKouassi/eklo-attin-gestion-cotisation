@extends('front._.app')

@section('page-title', $pIndex)

@section('content')

    <section class="mediatheque">
        <div class="section-title">
            <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
            <h3>{{ $title }}</h3>
        </div>
        <div class="events-section">
            <div class="calendar-container">
                <div class="allantenne">
                    @foreach ($prestationTypes as $item)
                        <div class="event-card">
                            <img src="{{ $item->getImg() }}" alt="Image de l'événement" class="prestation-img">
                            <div class="event-content text-center d-flex">
                                <a href="{{ route('front.prestation.detail', [$item->slug]) }}">
                                    <h3 class="event-title">{{ $item->libelle }}</h3>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="pagination">
                    @if ($prestationTypes->hasPages())
                        <ul class="pager pagination">

                            @if ($prestationTypes->onFirstPage())
                                <li class="disabled"><span></span></li>
                            @else
                                <li><a href="{{ $prestationTypes->previousPageUrl() }}" rel="prev">← Précédent</a></li>
                            @endif

                            @foreach ($prestationTypes as $element)

                                @if (is_string($element))
                                    <li class="disabled"><span>{{ $element }}</span></li>
                                @endif

                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        @if ($page == $prestationTypes->currentPage())
                                            <li class="active my-active"><span>{{ $page }}</span></li>
                                        @else
                                            <li><a href="{{ $url }}">{{ $page }}</a></li>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            @if ($prestationTypes->hasMorePages())
                                <li><a href="{{ $prestationTypes->nextPageUrl() }}" rel="next">Suivant →</a></li>
                            @else
                                <li class="disabled"><span></span></li>
                            @endif
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </section>

    {{-- <div class="table-container mt-5">
        <header class="table-header">
            <p>Synopsis du projet d'établissement 2012-2015 de l'INHP</p>
        </header>
        <table class="strategy-table">
            <thead>
                <tr>
                    <th>Les differentes prestations</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($prestationTypes as $item)
                    <tr>
                        <td data-label="Activités">{{ $item->libelle }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div> --}}

@endsection
