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
                    <div class="blog-card">
                        <a href="{{ route('front.blog.detail', [$item->slug]) }}">
                            <img src="{{ $item->getImg() }}" alt="{{ $item->alt }}" class="blog-image">
                            <h5>{{ $item->title }}</h5>
                        </a>
                        <p>{{ $item->alt }}</p>
                        <div class="blog-info">
                            <a href="{{ route('front.blog.detail', [$item->slug]) }}" class="read-more">Lire l'article</a>
                            <span class="date">28/02/2024</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="blog-pagination">
                <!-- Les boutons de pagination -->
                <button>1</button>
                <button>2</button>
                <!-- Plus de boutons -->
            </div>
        </div>

    </section>
@endsection
