@extends('front._.app')

@section('page-title', $pIndex)

@section('content')
    <section class="section-full-white actualite-detail text-center">
        <div class="section-title pl-50">
            <img src="{{ asset('model/assets/images/molecule.png') }}" alt="">
            <h3>{{ $title }}</h3>
        </div>
        <div class="back-img-parallax" style="background-image: url('{{ $actualite->getImg() }}');"></div>
        <div class="simple-box p-50">
            <h3>{{ $actualite->title }}</h3>
            <p class="actualite-content">
                {!! $actualite->content !!}
            </p>
        </div>
        <a href="{{ $actualite->getDoc() }}" class="btn-download-1" download="{{ $actualite->title }}" style="{{ $actualite->doc == null ? 'visibility: hidden;' : '' }}">
            Telecharger le document
        </a>
    </section>
@endsection
