@extends('front._.app')

@section('page-title', $pIndex)

@section('content')
{{-- <section class="mediatheque">
    <div class="section-title">
        <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
        <h3>{{ $title }}</h3>
    </div>
    <div class="events-section">
        <div class="calendar-container">
            <div class="allantenne">
                @foreach ($antennes as $item)
                    <div class="event-card">
                        <div class="event-content">
                            <div class="event-date">
                                <span class="date-icon">&#128197;</span>
                                <span class="date">{{ $item->phone }}</span>
                            </div>
                            <div class="event-time">
                                <span class="time-icon">&#128337;</span>
                                <span class="time">{{ $item->email }}</span>
                            </div>
                            <h3 class="event-title">{{ $item->nom }}</h3>
                            <p class="event-description">{{ $item->str_limit($item->adresse, 20) }}</p>
                            <div class="download-card text-center mt-2">
                                <a href="{{ route('front.antenne.index', ['slug' => $item->slug]) }}" class="btn-see"> <i class="icon-3deffects"></i> Voir</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination">
                @if ($antennes->hasPages())
                    <ul class="pager pagination">

                        @if ($antennes->onFirstPage())
                            <li class="disabled"><span></span></li>
                        @else
                            <li><a href="{{ $antennes->previousPageUrl() }}" rel="prev">← Précédent</a></li>
                        @endif

                        @foreach ($antennes as $element)

                            @if (is_string($element))
                                <li class="disabled"><span>{{ $element }}</span></li>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $antennes->currentPage())
                                        <li class="active my-active"><span>{{ $page }}</span></li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        @if ($antennes->hasMorePages())
                            <li><a href="{{ $antennes->nextPageUrl() }}" rel="next">Suivant →</a></li>
                        @else
                            <li class="disabled"><span></span></li>
                        @endif
                    </ul>
                @endif
            </div>
        </div>
    </div>
</section> --}}

<section class="antenne">
    <div class="section-title">
        <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
        <h3>ANTENNES ET POSTES</h3>
    </div>
    <div class="container">
        <div class="contact-section">
            <div class="contact-image">
                <img src="{{ asset('model/assets/icons/bg-form.svg')}}" alt="Contactez-nous">
            </div>
            <div class="container-table">
                <h6>LISTES DES ANTENNES ( {{ $allAntennes->count() }} )</h6>

                <div class="table-contacts">
                    {{-- <div class="cadre-table-header d-flex-2">
                        <h6>ANTENNES</h6>
                        <h6>EMAILS</h6>
                        <h6>CONTACTS</h6>
                    </div> --}}

                    {{-- @foreach ($antennes as $item)
                        <div class="d-flex-2">
                            <p>
                                <a href="{{ route('front.antenne.detail', ['slug' => $item->slug]) }}" style="color: #000;">
                                    {{ $item->nom }}
                                </a>
                            </p>
                            <p>
                                <a href="{{ route('front.antenne.detail', ['slug' => $item->slug]) }}" style="color: #000;">
                                    {{ $item->email }}
                                </a>
                            </p>
                            <p>
                                <a href="{{ route('front.antenne.detail', ['slug' => $item->slug]) }}" style="color: #000;">
                                    {{ $item->phone }}
                                </a>
                            </p>
                        </div>
                    @endforeach --}}
                    <section class="table__body">
                        <table>
                            <thead>
                                <tr>
                                    <th> ANTENNES</th>
                                    <th> EMAILS</th>
                                    <th> CONTACTS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allAntennes as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('front.antenne.detail', ['slug' => $item->slug]) }}" style="color: #000;">
                                                {{ $item->nom }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('front.antenne.detail', ['slug' => $item->slug]) }}" style="color: #000;">
                                                {{ $item->email }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('front.antenne.detail', ['slug' => $item->slug]) }}" style="color: #000;">
                                                {{ $item->phone }}
                                            </a>
                                        </td>
                                    </tr>                                        
                                @endforeach
                            </tbody>
                        </table>
                    </section>

                    {{-- <div class="pagination">
                        @if ($antennes->hasPages())
                            <ul class="pager pagination">

                                @if ($antennes->onFirstPage())
                                    <li class="disabled"><span></span></li>
                                @else
                                    <li><a href="{{ $antennes->previousPageUrl() }}" rel="prev">← Précédent</a></li>
                                @endif

                                @foreach ($antennes as $element)

                                    @if (is_string($element))
                                        <li class="disabled"><span>{{ $element }}</span></li>
                                    @endif

                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            @if ($page == $antennes->currentPage())
                                                <li class="active my-active"><span>{{ $page }}</span></li>
                                            @else
                                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach

                                @if ($antennes->hasMorePages())
                                    <li><a href="{{ $antennes->nextPageUrl() }}" rel="next">Suivant →</a></li>
                                @else
                                    <li class="disabled"><span></span></li>
                                @endif
                            </ul>
                        @endif
                    </div> --}}

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
