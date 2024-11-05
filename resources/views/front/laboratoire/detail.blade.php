@extends('front._.app')

@section('page-title', $pIndex)

@section('content')

        <section class="project-establishment">
            <div class="section-title pl-50">
                <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
                <h3>{{ $laboratoireType->nom }} - {{ $laboratoire->nom }}</h3>
            </div>
            <div class="mt-5">
                {!! $laboratoire->description !!}
            </div>
            
        </section>

@endsection
