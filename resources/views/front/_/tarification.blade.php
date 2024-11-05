<section class="section-full">
    <div class="box-nv1-row back-red color-white">
        <div class="box-nv2-c2-full p-50">
            <div class="mb-5">
                <h2>A Propos de l'INHP</h2>
                <p>
                    {{ $about ? strip_tags($about->str_limit($about->description, 100)) : '' }}
                </p>
            </div>
            <a class="btn-light-red-1" href="{{ route('front.about.index') }}">En savoir plus</a>
        </div>
        <div class="box-nv2-c2-full back-img" style="background-image: url('{{ $about ? $about->getImg2() : '' }}');"></div>
    </div>
    <div class="box-nv1-row">
        @foreach ($tarifications as $key => $item)

            @switch($key)
                @case(0)
                        <div class="box-nv2-c3 about-bull">
                            <img src="{{ asset('model/assets/images/blue-bulle.png')}}" alt="">
                            <div class="simple-box about-bull-texte">
                                <h5>{{ $item->title }}</h5>
                                <p>
                                    {{-- $item->frequence --}}
                                </p>
                            </div>
                        </div>
                    @break
                @case(1)
                        <div class="box-nv2-c3 about-bull">
                            <img src="{{ asset('model/assets/images/red-bulle.png')}}" alt="">
                            <div class="simple-box about-bull-texte">
                                <h5>{{ $item->title }}</h5>
                                <p>
                                    {{-- $item->frequence --}}
                                </p>
                            </div>
                        </div>
                    @break
                @case(2)
                        <div class="box-nv2-c3 about-bull">
                            <img src="{{ asset('model/assets/images/grey-bulle.png')}}" alt="">
                            <div class="simple-box about-bull-texte">
                                <h5>{{ $item->nom }}</h5>
                                <p>
                                    {{ $item->frequence }}
                                </p>
                            </div>
                        </div>
                    @break
                @default

            @endswitch

        @endforeach

    </div>
</section>
