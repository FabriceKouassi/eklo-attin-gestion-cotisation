@extends('front._.app')

@section('page-title', $pIndex)

@section('content')
    <section class="directeur-section doctor-message text-center">
        <div class="section-title">
            <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
            <h3>{{ $title }}</h3>
        </div>
        <div class="directeur-box box-nv1-row mb-5">
            <div class="directeur-box-img box-nv2-c2" style="background-image: url('{{ $directeur->getImg() }}'); background-repeat: no-repeat; background-size: cover;"></div>
            <div class="box-nv2-c2">
                <p>
                    {!! $directeur->content !!}
                </p>
            </div>
        </div>
        <a href="{{ $directeur->getDoc() }}" class="btn-download-1" download="{{ $directeur->doc }}" style="{{ $directeur->doc == null ? 'visibility: hidden;' : '' }}" title="Telecharger la brochure">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M5 20h14v-2H5zM19 9h-4V3H9v6H5l7 7z"/></svg>
            Brochure
        </a>
    </section>

@endsection
