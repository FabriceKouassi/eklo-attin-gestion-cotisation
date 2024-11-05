@extends('front._.app')

@section('page-title', $pIndex)

@section('content')
    <section class="document">
        <div class="section-title">
            <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
            <div class="d-flex-2" style="width: 100%; text-align: center;">
                <h3>{{ $title }}</h3>
                <a href="{{ route('front.document.index') }}" class="btn-return">
                    <span>← Retour</span>
                </a>
            </div>
        </div>
        <div class="gallery-container">
            <div class="search-filter-bar">
                <form action="{{ route('front.document.filter') }}" method="POST" class="w-100">
                    @csrf
                    <div class="doc-form">
                        <input type="search" placeholder="Recherche par nom du certificat, reference du document, nom de l'entreprise" id="keyword" name="keyword" class="search-keyword" value="{{ $search }}">

                        <select name="search" id="search" data-route="{{ route('front.document.index') }}" class="search-document mr-1">
                            {{-- <option disabled selected value="">Rechercher un document...</option> --}}
                            <option value="all" {{ request()->query('certificat', 'all') === 'all' ? 'selected' : '' }}>Tous les documents</option>
                            <option value="certificat-distant-signe" {{ request()->query('certificat') === 'certificat-distant-signe' ? 'selected' : '' }}>Certificat Signé</option>
                            @foreach ($documentType as $item)
                                <option value="{{ $item->slug }}" {{ Request::query('certificat') == $item->slug ? 'selected' : '' }}>{{ $item->libelle }}</option>
                            @endforeach
                        </select>

                        <select name="search_type_certificat" id="search_type_certificat" data-route="{{ route('front.document.index') }}" class="search-document mr-1 search_type_certificat" {{ request()->query('certificat') === 'certificat-distant-signe' ? '' : 'disabled' }}>
                                {{-- <option disabled selected value="">Recherche par type de certificat signé...</option> --}}
                                <option value="all" {{ request()->query('type-de-certificat', 'all') === 'all' ? 'selected' : '' }}>Tous les types de certificats signés</option>
                                {{-- <option value="certificat-distant-signe">Certificat Distant Signé</option> --}}
                            @foreach ($type_certificats_signes as $item)
                                <option value="{{ $item->libelle }}" {{ Request::query('type-de-certificat') == $item->libelle ? 'selected' : ''  }}>{{ $item->libelle }}</option>
                            @endforeach
                        </select>

                    </div>

                </form>

            </div>

            <div class="cards-container" id="listeDocuments">
                @foreach ($results as $item)
                    <div class="card">
                        <div class="card-header">
                            {{-- asset('model/assets/images/doc.jpg') --}}
                            {{-- <img src="{{ $item->getImg() }}" alt="Doctor"> --}}
                            <iframe src="{{ $item->getDoc() }}" frameborder="0" style="width: 100%;" height="400"></iframe>
                            <h4>{{ $item->title }}</h4>
                        </div>
                        {{-- <div class="card-body">
                            <p>{!! $item->description !!}</p>
                        </div> --}}
                        <div class="card-footer">
                            <a href="{{ $item->getDoc() }}" download="{{ $item->title }}" class="download-button" title="Télécharger le document" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M5 20h14v-2H5zM19 9h-4V3H9v6H5l7 7z"/></svg>
                                {{ $item->documentType->libelle }}
                            </a>
                        </div>
                    </div>
                @endforeach
                @foreach ($certif_dis as $item)
                    <div class="card">
                        <div class="card-header">
                            {{-- asset('model/assets/images/doc.jpg') --}}
                            {{-- <img src="{{ $item->getImg() }}" alt="Doctor"> --}}
                            <iframe src="{!! $item->pdf !!}" frameborder="0" style="width: 100%;" height="400"></iframe>
                            <h4>{{ $item->demandeCertificat->etablissement->nom }}</h4>
                        </div>
                        {{-- <div class="card-body">
                            <p>{!! $item->description !!}</p>
                        </div> --}}
                        <div class="card-footer">
                            <a href="{!! $item->pdf !!}" download="{{ $item->libelle }}" class="download-button" title="Télécharger le certificat de {{ $item->demandeCertificat->etablissement->nom }}" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M5 20h14v-2H5zM19 9h-4V3H9v6H5l7 7z"/></svg>
                                Certificat Signé
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>

        {{-- <div class="pagination">
            @if ($document->hasPages())
                <ul class="pager pagination">

                    @if ($document->onFirstPage())
                        <li class="disabled"><span></span></li>
                    @else
                        <li><a href="{{ $document->previousPageUrl() }}" rel="prev">← Précédent</a></li>
                    @endif

                    @foreach ($document as $element)

                        @if (is_string($element))
                            <li class="disabled"><span>{{ $element }}</span></li>
                        @endif

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $document->currentPage())
                                    <li class="active my-active"><span>{{ $page }}</span></li>
                                @else
                                    <li><a href="{{ $url }}">{{ $page }}</a></li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    @if ($document->hasMorePages())
                        <li><a href="{{ $document->nextPageUrl() }}" rel="next">Suivant →</a></li>
                    @else
                        <li class="disabled"><span></span></li>
                    @endif
                </ul>
            @endif
        </div> --}}
    </section>
@endsection

@push('scripts-search-document')

    <script src="{{ asset('model/js/searchDocument.js') }}"></script>
    {{-- <script src="{{ asset('model/js/infinit-load-document.js') }}"></script> --}}

@endpush
