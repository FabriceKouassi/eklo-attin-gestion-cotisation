@extends('front._.app')

@section('page-title', $pIndex)

@section('content')

@include('front._.slider')


<section class="prestation-section container-body container-width">
    <div class="prestation-full-content container-carousel-widget">

        <div class="custom-arrows-widget">
            <div class="prev-arrow-prestation">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" d="m7.825 13l5.6 5.6L12 20l-8-8l8-8l1.425 1.4l-5.6 5.6H20v2z" />
                </svg>
            </div>
            <div class="next-arrow-prestation">
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2" d="M5 12h14m-6 6l6-6m-6-6l6 6" />
                </svg>
            </div>
        </div>

        <div class="prestation-content carousel-prestation">
            @foreach ($prestationTypeSlide as $key => $item)
                @if ($key % 2 == 0)
                    <div class="prestation-description box-nv2-c4 custom-border-outline mr-5">
                        <div class="box-nv2-icon">
                            {{-- {{ asset('model/assets/icons/icon-categorie.svg') }} --}}
                            <a href="{{ route('front.prestation.detail', ['slug' => $item->slug]) }}">
                                <img style="margin: 15px 0;" src="{{ $item->getImg() }}" alt="{{ $item->libelle }}">
                            </a>
                        </div>
                        <div class="prestation-name box-nv2-text">
                            <a href="{{ route('front.prestation.detail', ['slug' => $item->slug]) }}">{{ $item->libelle }}</a>
                        </div>
                    </div>
                @else
                    <div class="prestation-description box-nv2-c4 custom-border-solid mr-5">
                        <div class="box-nv2-icon">
                            {{-- {{ asset('model/assets/icons/icon-categorie-2.svg') }} --}}
                            <a href="{{ route('front.prestation.detail', ['slug' => $item->slug]) }}">
                                <img style="margin: 15px 0;" src="{{ $item->getImg() }}" alt="{{ $item->libelle }}">
                            </a>
                        </div>
                        <div class="prestation-name box-nv2-text">
                            <a href="{{ route('front.prestation.detail', ['slug' => $item->slug]) }}">{{ $item->libelle }}</a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</section>

<section class="about-section section-full">
    <div class="about-full-content box-nv1-row back-red color-white">
        <div class="about-content box-nv2-c2-full p-50">
            <h2 class="about-title">A Propos de l'INHP</h2>
            <p class="about-description mb-5">
                {!! $about->str_limit(strip_tags($about->description), 120) ?? '' !!}
            </p>
            <a class="btn-light-red-1" href="{{ route('front.about.index') }}">En savoir plus</a>
        </div>
        <div class="about-image box-nv2-c2-full back-img" style="background-image: url('{{ $about->getImg1() }}');"></div>
    </div>
</section>
<section class="labo-section">
    <div class="labo-content">
        @foreach ($laboratoireType as $key => $item)
            @switch($key)
                @case(0)
                        <div class="box-nv2-c3 about-bull">
                            <img src="{{ asset('model/assets/images/blue-bulle.png')}}" alt="">
                            <div class="simple-box about-bull-texte">
                                <h5>
                                    <a href="{{ route('front.laboratoireType.detail', ['slug' => $item->slug]) }}" class="btn-simple" >{{ $item->nom }}</a>
                                </h5>
                                @foreach ( $item->laboratoires as $item2)
                                <p>
                                    <a href="{{ route('front.laboratoire.detail', ['slugLaboType' => $item->slug, 'slugLabo' => $item2->slug]) }}" class="btn-simple">{{ $item2->nom }}</a>
                                </p>
                                @endforeach
                            </div>
                        </div>
                    @break
                @case(1)
                        <div class="box-nv2-c3 about-bull">
                            <img src="{{ asset('model/assets/images/red-bulle.png')}}" alt="">
                            <div class="simple-box about-bull-texte">
                                <h5>
                                    <a href="{{ route('front.laboratoireType.detail', ['slug' => $item->slug]) }}" class="btn-simple">{{ $item->nom }}</a>
                                </h5>
                                @foreach ( $item->laboratoires as $item2)
                                <p>
                                    <a href="{{ route('front.laboratoire.detail', ['slugLaboType' => $item->slug, 'slugLabo' => $item2->slug]) }}" class="btn-simple">{{ $item2->nom }}</a>
                                </p>
                                @endforeach
                            </div>
                        </div>
                    @break
                @case(2)
                        <div class="box-nv2-c3 about-bull">
                            <img src="{{ asset('model/assets/images/grey-bulle.png')}}" alt="">
                            <div class="simple-box about-bull-texte mt-5">
                                <h5>
                                    <a href="{{ route('front.laboratoireType.detail', ['slug' => $item->slug]) }}" class="btn-simple">{{ $item->nom }}</a>
                                </h5>
                                @foreach ( $item->laboratoires as $item2)
                                <p>
                                    <a href="{{ route('front.laboratoire.detail', ['slugLaboType' => $item->slug, 'slugLabo' => $item2->slug]) }}" class="btn-simple">{{ $item2->nom }}</a>
                                </p>
                                @endforeach
                            </div>
                        </div>
                    @break
                @default
            @endswitch
        @endforeach
    </div>
    <div class="labo-content-2">
        @foreach ($laboratoireType as $key => $item)
            @switch($key)
                @case(0)
                    <div class="labo-card" style="background-color: #009ef7;">
                        <div class="labo-card-content">
                            <h5>
                                <a href="{{ route('front.laboratoireType.detail', ['slug' => $item->slug]) }}" class="btn-simple">{{ $item->nom }}</a>
                            </h5>
                            @foreach ( $item->laboratoires as $item2)
                            <p>
                                <a href="{{ route('front.laboratoire.detail', ['slugLaboType' => $item->slug, 'slugLabo' => $item2->slug]) }}" class="btn-simple">{{ $item2->nom }}</a>
                            </p>
                            @endforeach
                        </div>
                    </div>
                    @break
                @case(1)
                    <div class="labo-card" style="background-color: #ff3002;">
                        <div class="labo-card-content">
                            <h5>
                                <a href="{{ route('front.laboratoireType.detail', ['slug' => $item->slug]) }}" class="btn-simple">{{ $item->nom }}</a>
                            </h5>
                            @foreach ( $item->laboratoires as $item2)
                            <p>
                                <a href="{{ route('front.laboratoire.detail', ['slugLaboType' => $item->slug, 'slugLabo' => $item2->slug]) }}" class="btn-simple">{{ $item2->nom }}</a>
                            </p>
                            @endforeach
                        </div>
                    </div>
                    @break
                @case(2)
                    <div class="labo-card" style="background-color: #858282;">
                        <div class="labo-card-content">
                            <h5>
                                <a href="{{ route('front.laboratoireType.detail', ['slug' => $item->slug]) }}" class="btn-simple">{{ $item->nom }}</a>
                            </h5>
                            @foreach ( $item->laboratoires as $item2)
                            <p>
                                <a href="{{ route('front.laboratoire.detail', ['slugLaboType' => $item->slug, 'slugLabo' => $item2->slug]) }}" class="btn-simple">{{ $item2->nom }}</a>
                            </p>
                            @endforeach
                        </div>
                    </div>
                    @break
                @default
            @endswitch
        @endforeach
    </div>
</section>

<section class="actualite-section">
    <div class="section-title">
        <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
        <h3>Actualités</h3>
    </div>
    <div class="box-nv1-row mt-5">
        <div class="box-nv2-c2 back-img rd-15" style="background-image: url('{{ !empty($actualiteFirst) ? $actualiteFirst->getImg() : '' }}');">
            <div class="actuality-indication-box">
                <div class="simple-box"><button>A la une</button></div>
                <div class="simple-box back-white rd-15 mt-30 pb-2">
                    <div class="actualite-content mb-2">
                        <h5>{{ !empty($actualiteFirst) ? $actualiteFirst->title : '' }}</h5>
                        <p>
                            {{ !empty($actualiteFirst) ? strip_tags($actualiteFirst->str_limit($actualiteFirst->content, 15)) : '' }}
                        </p>
                    </div>
                    <a class="btn-light-red-2" href="{{ route('front.actualite.detail', [!empty($actualiteFirst) ? $actualiteFirst->slug : '']) }}">En savoir plus</a>
                </div>
            </div>
        </div>
        <div class="box-nv2-c2">
            <div class="box-nv1-col">

                @if (!empty($actualites))
                    @foreach ($actualites as $key => $item)
                        <div class="simple-box back-img rd-15 {{ $key != 0 ? 'mt-2' : ''}}"
                            style="background-image: url('{{ $item->getImg() }}');">
                            <div class="actuality-indication-box">
                                <div class="simple-box back-white rd-15 mt-5 pb-2">
                                    <div class="actualite-content mb-2">
                                        <h5>{{ $item->title }}</h5>
                                        <p>
                                            {{ strip_tags($item->str_limit($item->content, 15)) }}

                                        </p>
                                    </div>
                                    <a class="btn-light-red-2" href="{{ route('front.actualite.detail', [$item->slug]) }}">En savoir plus</a>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
</section>

<section class="doctor-section doctor-advice">
    <div class="doctor-advice-title">
        <h1>DOCTEUR</h1>
        <span class="color-blue">CONSEIL</span>
    </div>
    <div class="doctor-full-content box-nv1-row">
        <div class="doctor-image simple-box-img back-img rd-15" style="background-image: url('{{ !empty($docteur) ? $docteur->getImg() : '' }}');">
        </div>
        <div class="doctor-content simple-box">
            <img src="{{ asset('model/assets/images/molecule.png') }}" alt="" class="molecule-img">
            <div class="doctor-simple-content simple-box-text mt-40">
                <div class="mb-2">
                    <h5>{{ !empty($docteur) ? $docteur->nom : '' }}</h5>
                    <span style="color: #007bff; font-weight: 500;">{{ !empty($docteur) ? $docteur->fonction : '' }}</span>
                    <p class="mt-2">
                        {{ !empty($docteur) ? strip_tags($docteur->str_limit($docteur->content, 180)) : '' }}
                    </p>
                </div>
                <a class="btn-light-red-2" href="{{ route('front.docteur.index') }}">Lire plus</a>
            </div>
        </div>
    </div>
</section>

<section class="dossier-section section-full">
    <div class="dossier-full-content box-nv1-row">
        <div class="dossier-content box-nv2-c2-full">
            <div class="section-title">
                <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
                <h3>Dossier du mois</h3>
            </div>
            <p class="p-20 bold-700">
                {{ !empty($dossier) ? strip_tags($dossier->str_limit($dossier->content, 150)) : '' }}
            </p>
            <div class="simple-box pl-50">
                <a class="btn-light-red-2" href="{{ route('front.dossier.index') }}">Lire plus</a>
            </div>
        </div>
        <div class="dossier-image box-nv2-c2-full back-img" style="background-image: url('{{ !empty($dossier) ? $dossier->getImg() : '' }}');"></div>
    </div>
</section>

<section class="mediatheque">
    <div class="section-title">
        <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
        <h3>Mediathèques</h3>
    </div>
    <div class="mediatheque-content box-nv1-row mt-5 mb-2">
        @if ( !empty($mediatheque) )
            @foreach ($mediatheque->getImgsHomePage(5) as $img)
                <div class="box-nv2-c4 back-img" style="background-image: url('{{ $img }}');"></div>
            @endforeach
        @endif
    </div>
    <div class="simple-box">
        <a class="btn-light-red-2" href="{{ route('front.galerie.index') }}">Voir la mediatheque</a>
    </div>
</section>

<section class="section-full partenaires p-50">
    <div class="custom-arrows">
        <div class="prev-arrow-partenaire">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path fill="currentColor" d="m7.825 13l5.6 5.6L12 20l-8-8l8-8l1.425 1.4l-5.6 5.6H20v2z" />
            </svg>
        </div>
        <div class="next-arrow-partenaire">
            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" d="M5 12h14m-6 6l6-6m-6-6l6 6" />
            </svg>
        </div>
    </div>

    <div class="section-title">
        <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
        <h3>Partenaires</h3>
    </div>
    <div class="box-nv1-row mt-5 carousel-partenaire">
        @foreach ($partenaires as $item)
            <div class="slide-partenaire-img" style="background-image: url('{{ $item->getImg() }}');">
                {{-- <img src="{{ $item->getImg() }}" alt="{{ $item->alt }}"> --}}
            </div>
        @endforeach
    </div>
</section>

@endsection
