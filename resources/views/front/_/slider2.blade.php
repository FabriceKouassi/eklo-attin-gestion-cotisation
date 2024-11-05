<section class="container-body container-width" style="display: block">
    <div class="box-nv1-row content-owl">
        <div class="container-carousel">

            <div class="custom-arrows">
                <div class="prev-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="currentColor" d="m7.825 13l5.6 5.6L12 20l-8-8l8-8l1.425 1.4l-5.6 5.6H20v2z" />
                    </svg>
                </div>
                <div class="next-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M5 12h14m-6 6l6-6m-6-6l6 6" />
                    </svg>
                </div>
            </div>

            <div class="carousel">
                @foreach ($slides as $item)
                    <div style="height: 480px;" class="item">
                        <img src="{{ $item->getImg() }}" alt="{{ $item->alt }}" title="{{ $item->title }}">
                    </div>
                @endforeach
            </div>
        </div>

        <div class="cadre-info">
            <div class="carousel-infoUtils">
                @foreach ($flashInfos as $item)
                    <div class="cadre-info-owl">
                        <h4>Flash info</h4>
                        <div class="cadre-info-owl-content">
                            <h6>{!! $item->content !!}</h6>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="cadre-info-owl-search">
                <h5>Trouver une antenne proche de chez vous</h5>

                <form action="{{ route('front.search.antenne') }}" method="POST">
                    @csrf
                    <select name="antenne" id="antenne" class="search-antenne">
                            <option disabled selected value="">Rechercher une antenne...</option>
                        @foreach ($antennes as $item)
                            <option value="{{ $item->slug }}">{{ $item->nom }}</option>
                        @endforeach
                    </select>

                    <button class="btn-outlined full-width" type="submit">Rechercher</button>
                </form>
            </div>
        </div>
    </div>

</section>
