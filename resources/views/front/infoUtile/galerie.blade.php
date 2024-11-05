@extends('front._.app')

@push('gallery-css')
    <link rel="stylesheet" href="{{ asset('model/css/gallery.css')}}">
    <link rel="stylesheet" href="{{ asset('model/css/lightbox.css')}}">
@endpush

@section('page-title', $pIndex)

@section('content')
<section class="mediatheque">
    <div class="section-title">
        <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
        <h3>{{ $title }}</h3>
    </div>

    <div class="gallery-container">
        <div class="gallery">
            @foreach ($mediatheques as $item)
            <div class="gallery-card">
                @foreach ($item->getImgs() as $img)
                    <a href="{{ $img ?? '' }}"  data-lightbox="roadtrip" data-title="{{ $item->title }}">
                        <img src="{{ $img ?? '' }}" alt="{{ $item->title }}">
                    </a>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>

    <div class="pagination">
        @if ($mediatheques->hasPages())
            <ul class="pager pagination">

                @if ($mediatheques->onFirstPage())
                    <li class="disabled"><span></span></li>
                @else
                    <li><a href="{{ $mediatheques->previousPageUrl() }}" rel="prev">← Précédent</a></li>
                @endif

                @foreach ($mediatheques as $element)

                    @if (is_string($element))
                        <li class="disabled"><span>{{ $element }}</span></li>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $mediatheques->currentPage())
                                <li class="active my-active"><span>{{ $page }}</span></li>
                            @else
                                <li><a href="{{ $url }}">{{ $page }}</a></li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($mediatheques->hasMorePages())
                    <li><a href="{{ $mediatheques->nextPageUrl() }}" rel="next">Suivant →</a></li>
                @else
                    <li class="disabled"><span></span></li>
                @endif
            </ul>
        @endif
    </div>

</section>

@push('gallery-script')
    <script src="{{ asset('model/js/gallery.js') }}"></script>
    <script src="{{ asset('model/js/lightbox-plus-jquery.js') }}"></script>
@endpush

@endsection
