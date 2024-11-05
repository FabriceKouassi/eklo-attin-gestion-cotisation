@extends('front._.app')

@section('page-title', $pIndex)

@section('content')
    <section class="section-full-white text-center">
        <div class="section-title pl-50">
            <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
            <h3>{{ $title }}</h3>
        </div>
        <div class="back-img-parallax" style="background-image: url('{{ $historique->getImg() }}');"></div>
        <div class="simple-box p-50">
            <p>
                {!! $historique->content !!}
            </p>
        </div>
        <a href="{{ $historique->getDoc() }}" class="btn-download-1" download="{{ $historique->doc }}" style="{{ $historique->doc == null ? 'visibility: hidden;' : '' }}" title="Télecharger la brochure">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M5 20h14v-2H5zM19 9h-4V3H9v6H5l7 7z"/></svg>
            Brochure
        </a>
    </section>
@endsection
