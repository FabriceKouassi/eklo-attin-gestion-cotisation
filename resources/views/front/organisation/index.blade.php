@extends('front._.app')

@section('page-title', $pIndex)

@section('content')
    <section class="section-full-white">
        <div class="text-justify">
            <div class="section-title pl-50">
                <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
                <h3>{{ $title }}</h3>
            </div>
            <div class="back-img-parallax" style="background-image: url('{{ $organisation->getImg() }}');"></div>
            <div class="simple-box p-50">
                <p>
                    {!! $organisation->content !!}
                </p>
            </div>
        </div>
        <div class="text-center">
            <a href="{{ $organisation->getDoc() }}" class="btn-download-1" download="{{ $organisation->doc }}" style="{{ $organisation->doc == null ? 'visibility: hidden;' : '' }}" title="Télecharger la brochure">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M5 20h14v-2H5zM19 9h-4V3H9v6H5l7 7z"/></svg>
                Brochure
            </a>
        </div>
    </section>
@endsection
