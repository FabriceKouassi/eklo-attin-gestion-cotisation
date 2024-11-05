@extends('front._.app')

@section('page-title', $pIndex)

@section('content')
<section id="page-content">
    <div class="container">
        <div class="row">
            <div class="content col-lg-12">
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <h4>{{ $title }}</h4>
                    </div>
                    @foreach ($solutionMenu as $item)
                        <div class="col-lg-4">
                            <div class="card">
                                <img class="card-img-top" src="{{ $item->getImg() }}" alt="{{ $item->alt }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $item->titre }}</h5>
                                    <p class="card-text">
                                        {!! Illuminate\Support\Str::limit(strip_tags($item->description),100,' ...') !!}
                                    </p>
                                    <a href="{{ route('front.services.detail', ['slug' => $item->slug])}}" class="btn btn-primary">Voir</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="col-lg-12">
                        <div class="line"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
