@extends('front._.app')

@section('page-title', $pIndex)

@section('content')
    <section class="blog">
        <div class="section-title">
            <img src="{{ asset('model/assets/images/molecule.png') }}" alt="">
            <h3>{{ $title }}</h3>
        </div>
        <div class="blog-section">
            <div class="blog-grid">
                @foreach ($blog as $item)
                    <div class="blog-card" style="background-image: url('{{-- $item->getImg() --}}');">
                        <a href="{{ route('front.blog.detail', [$item->slug]) }}">
                            <img src="{{ $item->getImg() }}" alt="{{ $item->alt }}" class="blog-image">
                            <h5>{{ $item->title }}</h5>
                        </a>
                        <p>{{ $item->alt }}</p>
                        <div class="blog-info">
                            <a href="{{ route('front.blog.detail', [$item->slug]) }}" class="read-more">Lire l'article</a>
                            <span class="date">{{ date("d-m-Y", strtotime($item->created_at)) }}  ({{ date("H:i", strtotime($item->created_at)) }})</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="pagination">
                @if ($blog->hasPages())
                    <ul class="pager pagination">

                        @if ($blog->onFirstPage())
                            <li class="disabled"><span></span></li>
                        @else
                            <li><a href="{{ $blog->previousPageUrl() }}" rel="prev">← Précédent</a></li>
                        @endif

                        @foreach ($blog as $element)

                            @if (is_string($element))
                                <li class="disabled"><span>{{ $element }}</span></li>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $blog->currentPage())
                                        <li class="active my-active"><span>{{ $page }}</span></li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        @if ($blog->hasMorePages())
                            <li><a href="{{ $blog->nextPageUrl() }}" rel="next">Suivant →</a></li>
                        @else
                            <li class="disabled"><span></span></li>
                        @endif
                    </ul>
                @endif
            </div>
        </div>

    </section>
@endsection
