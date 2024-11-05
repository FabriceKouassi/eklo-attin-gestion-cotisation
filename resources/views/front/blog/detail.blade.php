@extends('front._.app')

@section('page-title', $pIndex)

@section('content')
    <section class="section-full-white blog-detail text-center">
        <div class="section-title pl-50">
            <img src="{{ asset('model/assets/images/molecule.png') }}" alt="">
            <h3>{{ $title }}</h3>
        </div>
        <div class="back-img-parallax" style="background-image: url('{{ $blog->getImg() }}');"></div>
        <div class="simple-box p-50">
            <h3>{{ $blog->title }}</h3>
            <p class="blog-content">
                {!! $blog->content !!}
            </p>
        </div>
        <a href="{{ $blog->getDoc() }}" class="btn-download-1" download="{{ $blog->title }}" style="{{ $blog->doc == null ? 'visibility: hidden;' : '' }}">
            Telecharger le document
        </a>
    </section>
@endsection
