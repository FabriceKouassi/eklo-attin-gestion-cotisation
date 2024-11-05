@extends('front._.app')

@section('page-title', $title)

@section('content')
<section id="page-content" class="sidebar-right">
    <div class="container">
        <div class="row">

            <div class="content col-lg-9">
                <div class="page-title mb-5">
                    <h1>{{ $service->titre }}</h1>
                    {{-- <div class="breadcrumb float-left">
                        <ul>
                            <li><a href="#">Home</a>
                            </li>
                            <li><a href="#">Blog</a>
                            </li>
                            <li class="active"><a href="#">Sidebar Right</a>
                            </li>
                        </ul>
                    </div> --}}
                </div>
                <div id="blog">
                    <div class="post-item">
                        <div class="post-item-wrap">
                            <div class="post-image">
                                <a href="#">
                                    <img alt="" src="{{ $service->getImg() }}" style="width: 50%">
                                </a>
                                <span class="post-meta-category"><a href="#">Sevenrone IT</a></span>
                            </div>
                            <div class="post-item-description">
                                <h2>
                                    <a href="#">{{ $service->sousTitre }}</a>
                                </h2>
                                <p>
                                    {!! $service->description !!}
                                </p>
                                {{-- <a href="#" class="item-link">Read More <i class="icon-chevron-right"></i></a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('front._.recentPost')

        </div>
    </div>
</section>
@endsection
