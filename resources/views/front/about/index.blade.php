@extends('front._.app')

@section('page-title', $pIndex)

@section('content')
    <section class="section-full-white about-detail text-center">
        <div class="section-title pl-50">
            <img src="{{ asset('model/assets/images/molecule.png') }}" alt="">
            <h3>{{ $title }}</h3>
        </div>
        <div class="back-img-parallax" style="background-image: url('{{ $about ? $about->getImg2() : '' }}');"></div>
        <div class="simple-box p-50">
            <h3>{{ $about->title ?? '' }}</h3>
            <p class="about-content">
                {!! $about->description ?? '' !!}
            </p>
            <div class="section-title pl-50 mt-5">
                <img src="{{ asset('model/assets/images/molecule.png') }}" alt="">
                <h3>Nos Objectifs</h3>
            </div>
            <p class="about-content mt-2">
                {!! $about->objectif ?? '' !!}
            </p>
        </div>
        <a href="{{ $about ? $about->getDoc() : '' }}" class="btn-download-1" download="A propos de nous" style="{{ empty($about->doc) ? 'visibility: hidden;' : '' }}">
            Telecharger le document
        </a>
    </section>
@endsection
