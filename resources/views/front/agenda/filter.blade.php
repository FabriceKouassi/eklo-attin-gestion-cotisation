@extends('front._.app')

@section('page-title', $pIndex)

@section('content')
    <section class="doctor-message text-center">
        <div class="section-title">
            <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
            <div class="d-flex-2" style="width: 100%; text-align: center;">
                <h3>{{ $title }}</h3>
                <a href="{{ route('front.agenda.index') }}" class="btn-return">
                    <span>← Retour</span>
                </a>
            </div>
        </div>
        <div class="box-nv1-row mb-5">
            <div class="box-nv2-c2" style="background-image: url('{{ $agenda->getImg() }}'); background-repeat: no-repeat; background-size: cover; height: 50vh;"></div>
            <div class="box-nv2-c2">
                <div class="event-date">
                    <span class="date-icon">&#128197;</span>
                    <span class="date">{{ date('d/m/Y', strtotime($agenda->eventDate)) }}</span>
                </div>
                <div class="event-time">
                    <span class="time-icon">&#128337;</span>
                    <span class="time">{{ $agenda->eventHour }}</span>
                </div>
                <div class="event-location">
                    <span class="location-icon">&#128205;</span>
                    <span class="location color-red">{{ $agenda->location }}</span>
                </div>
                <h3 class="event-title">
                    {{-- <a href="{{ route('front.agenda.index', ['slug' => $item->slug]) }}">{{ $item->title }}</a> --}}
                    {{ $agenda->title }}
                </h3>
                <p>
                    {!! $agenda->content !!}
                </p>
            </div>
        </div>
        <a href="{{ $agenda->getDoc() }}" class="btn-download-1" download="{{ $agenda->doc }}" style="{{ $agenda->doc == null ? 'visibility: hidden;' : '' }}">
            Telecharger le document
        </a>
    </section>
@endsection
