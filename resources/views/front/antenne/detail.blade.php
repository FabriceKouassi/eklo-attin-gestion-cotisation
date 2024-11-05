@extends('front._.app')

@section('page-title', $pIndex)

@section('content')
<section class="mediatheque">
    <div class="section-title">
        <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
        <h3>{{ $title }}</h3>
    </div>
    <div class="antenne-section events-section">
        <div class="antenne-buttons scroll-buttons">
            <button class="scroll-up">&#9650;</button>
            <div class="antenne-list events-list">
                @foreach ($antennes as $item)
                    <div class="antenne-card event-card">
                        <div class="antenne-content event-content">
                            <div class="antenne-date event-date">
                                <span class="date-icon">&#128197;</span>
                                <span class="date">{{ $item->phone ?? '' }}</span>
                            </div>
                            <div class="event-time">
                                <span class="time-icon">&#128337;</span>
                                <span class="time email">{{ $item->email ?? '' }}</span>
                            </div>
                            <h3 class="event-title"><a href="{{ route('front.antenne.detail', ['slug' => $item->slug]) }}">{{ $item->nom ?? '' }}</a></h3>
                            <p class="event-description">{{ $item->str_limit($item->adresse, 20) ?? '' }}</p>
                            <div class="download-card text-center mt-2">
                                <a href="{{ route('front.antenne.detail', ['slug' => $item->slug]) }}" class="btn-see"> <i class="icon-3deffects"></i> Voir</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="scroll-down">&#9660;</button>
        </div>
        <div class="antenne-container">
            <div class="antenne-card event-card">
                <div class="antenne-content event-content">
                    <div class="event-date">
                        <span class="date-icon">&#128197;</span>
                        <span class="date">{{ $antenne->phone ?? '' }}</span>
                    </div>
                    <div class="event-time">
                        <span class="time-icon">&#128337;</span>
                        <span class="time email">{{ $antenne->email ?? '' }}</span>
                    </div>
                    <h3 class="event-title">{{ $antenne->nom ?? '' }}</h3>
                    <p class="event-description">{{ $antenne->adresse ?? '' }}</p>
                </div>
            </div>
            <div class="antenne-location download-card text-center mt-2">
                {!! $antenne->map ?? '' !!}
                {{-- <iframe src="" frameborder="0" width="800" height="400"></iframe> --}}
            </div>
        </div>
    </div>
</section>
@endsection
