@extends('front._.app')

@section('page-title', $pIndex)

@section('content')

    <section class="tarification-section-container">
        <div class="section-title pl-50">
            <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
            <h3 style="font-size: 1rem">TARIFICATION</h3>
        </div>

        <div class="container-tarification">
            @foreach ($tarifications as $key => $item)
                @if ($key % 2 == 0)
                    <div class="tarification-section content-tarification">
                        <div class="tarification-image">
                            <img src="{{ asset('model/assets/icons/tarification.svg')}}" alt="Contactez-nous">
                        </div>
                        <div style="color: #009ef7;" class="cadre-tarification">
                            <h5>{{ $item->title }}</h5>

                            <div class="box-nv2-icon">
                                <img style="margin: 15px 0;" src="{{ asset('model/assets/icons/icon-categorie.svg')}}" alt="inhp-1">
                            </div>
                            <p style="">
                                {!! $item->content !!}
                            </p>
                        </div>
                    </div>
                @else
                    <div class="tarification-section content-tarification" style="">
                        <div class="tarification-image">
                            <img src="{{ asset('model/assets/icons/tarification.svg')}}" alt="Contactez-nous">
                        </div>
                        <div style="background-color: #009ef7; color: white;" class="cadre-tarification">
                            <h5>{{ $item->title }}</h5>
                            <div class="box-nv2-icon">
                                <img style="margin: 15px 0;" src="{{ asset('model/assets/icons/icon-categorie-2.svg')}}" alt="inhp-1">
                            </div>
                            <p>
                                {!! $item->content !!}
                            </p>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="pagination">
            @if ($tarifications->hasPages())
                <ul class="pager pagination">

                    @if ($tarifications->onFirstPage())
                        <li class="disabled"><span></span></li>
                    @else
                        <li><a href="{{ $tarifications->previousPageUrl() }}" rel="prev">← Précédent</a></li>
                    @endif

                    @foreach ($tarifications as $element)

                        @if (is_string($element))
                            <li class="disabled"><span>{{ $element }}</span></li>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $tarifications->currentPage())
                                    <li class="active my-active"><span>{{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    @if ($tarifications->hasMorePages())
                        <li><a href="{{ $tarifications->nextPageUrl() }}" rel="next">Suivant →</a></li>
                    @else
                        <li class="disabled"><span></span></li>
                    @endif
                </ul>
            @endif
        </div>
    </section>
@endsection
