@extends('front._.app')

@section('page-title', $pIndex)

@section('content')
    <section class="section-full-white blog-detail text-center">
        <div class="section-title pl-50">
            <img src="{{ asset('model/assets/images/molecule.png') }}" alt="">
            <h3>{{ $title }}</h3>
        </div>
        <div class="back-img-parallax" style="background-image: url('{{ $docteur->getImg() }}');"></div>
        <div class="simple-box p-50">
            <p class="blog-content">
                {!! $docteur->content !!}
            </p>
        </div>
    </section>
@endsection
