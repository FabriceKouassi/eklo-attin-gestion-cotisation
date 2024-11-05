@extends('front._.app')


@section('page-title', $pIndex)

@section('content')
    <section class="document">
        <div class="section-title d-flex-2">
            <div class="d-flex">
                <img src="{{ asset('model/assets/images/molecule.png')}}" alt="">
                <h3>{{ $title }}</h3>
            </div>
            <div class="search-filter-bar">
                <form action="{{ route('front.document.filter') }}" method="POST" class="w-100">
                    @csrf
                    <div class="doc-form">

                        <input type="search" placeholder="Recherche par nom du certificat, reference du document, nom de l'entreprise" title="Rechercher le nom du certificat, la reference du document, nom de l'établissement, localite, type de certificat, adresse de l'établissement" id="keyword" name="keyword" class="search-keyword" value="{{ Request::old('keyword') }}">

                        <select name="search" id="search" data-route="{{ route('front.document.index') }}" class="search-document">
                                {{-- <option disabled selected value="">Rechercher un document...</option> --}}
                                <option value="all" {{ request()->query('certificat', 'all') === 'all' ? 'selected' : '' }}>Tous les documents</option>
                                <option value="certificat-distant-signe" {{ request()->query('certificat') === 'certificat-distant-signe' ? 'selected' : '' }}>Certificat Signé</option>
                            @foreach ($documentType as $item)
                                <option value="{{ $item->slug }}" {{ Request::query('certificat') == $item->slug ? 'selected' : '' }}>{{ $item->libelle }}</option>
                            @endforeach
                        </select>

                        <select name="search_type_certificat" id="search_type_certificat" data-route="{{ route('front.document.index') }}" class="search-document search_type_certificat" {{ request()->query('certificat') === 'certificat-distant-signe' ? '' : 'disabled' }}>
                                {{-- <option disabled selected value="">Recherche par type de certificat signé...</option> --}}
                                <option value="all" {{ request()->query('type-de-certificat', 'all') === 'all' ? 'selected' : '' }}>Tous les types de certificats signés</option>
                                {{-- <option value="certificat-distant-signe">Certificat Distant Signé</option> --}}
                            @foreach ($type_certificats_signes as $item)
                                <option value="{{ $item->libelle }}" {{ Request::query('type-de-certificat') == $item->libelle ? 'selected' : ''  }}>{{ $item->libelle }}</option>
                            @endforeach
                        </select>

                        {{-- <button type="submit" class="search_type_certificat_btn" disabled>Rechercher</button> --}}

                    </div>
                </form>
            </div>
        </div>

        <div class="gallery-container">
            <div class="cards-container" id="listeDocuments">

                    @foreach ($data as $item)
                        {{-- @if (request()->query('certificat') !== 'certificat-distant-signe' || request()->query('certificat', 'all') === 'all') --}}
                            @if ($item instanceof App\Models\SecondDataBaseModels\Certificat)
                                <div class="card card_certificat_normal{{ $item->id }}" id="card_certificat_normal">
                                    <div class="card-header">
                                        {{-- asset('model/assets/images/doc.jpg') --}}
                                        {{-- <img src="{{ $item->getImg() }}" alt="Doctor"> --}}
                                        <iframe src="{{ $item->pdf }}" frameborder="0" style="width: 100%;" height="400"></iframe>
                                        {{-- <h4>{{ $item->libelle }}</h4> --}}
                                        <h4>{{ $item->demandeCertificat->etablissement->nom }}</h4>
                                    </div>
                                    {{-- <div class="card-body">
                                        <p>{!! $item->description !!}</p>
                                    </div> --}}
                                    <div class="card-footer">
                                        <a href="{{ $item->pdf }}" download="{{ $item->libelle }}" class="download-button" title="Télécharger le certificat de {{ $item->demandeCertificat->etablissement->nom }}" target="_blank">
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M19.7 12.9L14 18.6h-2.3v-2.3l5.7-5.7zm3.4-.8c0 .3-.3.6-.6.9L20 15.5l-.9-.9l2.6-2.6l-.6-.6l-.7.7l-2.3-2.3l2.2-2.1c.2-.2.6-.2.9 0l1.4 1.4c.2.2.2.6 0 .9c-.2.2-.4.4-.4.6s.2.4.4.6c.3.3.6.6.5.9M3 20V4h7v5h5v1.5l2-2V8l-6-6H3c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2zm8-2.9c-.2 0-.4.1-.5.1L10 15H8.5l-2.1 1.7L7 14H5.5l-1 5H6l2.9-2.6l.6 2.3h1l.5-.1z"/></svg> --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M5 20h14v-2H5zM19 9h-4V3H9v6H5l7 7z"/></svg>
                                            Certificat Signé
                                        </a>
                                    </div>
                                </div>
                            @endif
                        {{-- @endif --}}

                        {{-- @if (request()->query('certificat') === 'certificat-distant-signe' || request()->query('certificat', 'all' ) === 'all') --}}
                            @if ($item instanceof App\Models\Document)
                                <div class="card card_certificat_normal{{ $item->id }}" id="card_certificat_normal">
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
                                            {{-- <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><path fill="currentColor" d="M6 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zm0 2h7v5h5v11H6zm2 8v2h8v-2zm0 4v2h5v-2z"/></svg> --}}
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="M5 20h14v-2H5zM19 9h-4V3H9v6H5l7 7z"/></svg>
                                            {{ $item->documentType->libelle }}
                                        </a>
                                    </div>
                                </div>
                            @endif
                        {{-- @endif --}}

                    @endforeach

            </div>

            <div class="pagination">
                <!-- Pagination buttons -->
                {{-- {{ $data->onEachSide(1)->withQueryString()->links() }} --}}

                @if ($data->hasPages())
                    <ul class="pager pagination">

                        @if ($data->onFirstPage())
                            <li class="disabled"><span></span></li>
                        @else
                            <li><a href="{{ $data->previousPageUrl() }}" rel="prev">← Précédent</a></li>
                        @endif

                        @foreach ($data as $element)

                            @if (is_string($element))
                                <li class="disabled"><span>{{ $element }}</span></li>
                            @endif

                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $data->currentPage())
                                        <li class="active my-active"><span>{{ $page }}</span></li>
                                    @else
                                        <li><a href="{{ $url }}">{{ $page }}</a></li>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        @if ($data->hasMorePages())
                            <li><a href="{{ $data->nextPageUrl() }}" rel="next">Suivant →</a></li>
                        @else
                            <li class="disabled"><span></span></li>
                        @endif
                    </ul>
                @endif
                <!-- Plus de boutons de pagination -->
            </div>
        </div>

    </section>
@endsection

@push('scripts-search-document')
    <script src="{{ asset('model/js/searchDocument.js') }}"></script>
    {{-- <script src="{{ asset('model/js/infinit-load-document.js') }}"></script> --}}
@endpush
