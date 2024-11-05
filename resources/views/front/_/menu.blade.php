<section class="container-width section-nav">
    <div class="mini-header-nav">
        <div class="header-logo-slogan">
            <div class="header-logo-card">
                <a href="{{ route('front.index') }}">
                    <img src="{{ !empty($company) ? $company->getLogo1() : '' }}" alt="{{ !empty($company) ? $company->alt : '' }}" width="200" class="logo1">
                </a>

                <div class="caption">{{ !empty($company) ? $company->slogan : '' }}</div>

                <a href="{{ route('front.index') }}">
                    <img src="{{ !empty($company) ? $company->getLogo2() : '' }}" alt="{{ !empty($company) ? $company->alt : '' }}" width="100" class="logo2">
                </a>

                <a class="body1 mobile-menu-icon1" onclick="showSecondMenu()" id="mobile_menu_icon1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="currentColor" d="M3 4h18v2H3zm0 7h18v2H3zm0 7h18v2H3z"/></svg>
                </a>
            </div>
            <div class="header-menu-card">
                <div class="divider"></div>

                <a class="body1 mobile-menu-icon" onclick="showSecondMenu()" id="mobile_menu_icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 24 24"><path fill="currentColor" d="M3 4h18v2H3zm0 7h18v2H3zm0 7h18v2H3z"/></svg>
                </a>
                <nav style="margin-bottom: 20px;" class="menu-principal" id="menu_principal">
                    <ul>
                        <li><a href="{{ route('front.index') }}" class="body1 {{ $pIndex == 'accueil' ? 'active' : ''}}">Accueil</a></li>
                        <li>
                            <a href="#" class="body1
                                {{ $pIndex == 'presentation' ? 'active' : ''}}
                                {{ ($pIndex=='directeur' || $pIndex=='historique' || $pIndex=='mission' || $pIndex=='organisation' || $pIndex=='plan' || $pIndex=='politique') ? 'active' : '' }}
                                "
                                data-page="presentation">
                                Présentation
                            </a>
                            <ul class="submenu">
                                <li><a href="{{ route('front.directeur.index') }}" class="body1 {{ $pIndex == 'directeur' ? 'active' : ''}}" data-page="directeur">Mot du directeur</a></li>
                                <li><a href="{{ route('front.historique.index') }}" class="body1 {{ $pIndex == 'historique' ? 'active' : ''}}" data-page="historique">Historique</a></li>
                                <li>
                                    <a href="#" class="body1 {{ ($pIndex == 'mission' || $pIndex=='organisation') ? 'active' : ''}}" data-page="missions">Mission et organisation</a>
                                    <ul class="subsubmenu">
                                        <li><a href="{{ route('front.mission.index') }}" class="mission.html {{ $pIndex == 'mission' ? 'active' : ''}}" data-page="mission">Mission</a></li>
                                        <li>
                                            <a href="{{ route('front.organisation.index') }}" class="body1 {{ $pIndex == 'organisation' ? 'active' : ''}}" data-page="organisation">Organisation</a>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="{{ route('front.plan.index') }}" class="body1 {{ $pIndex == 'plan' ? 'active' : ''}}" data-page="strategique">Plan strategique</a>
                                </li>
                                <li><a href="{{ route('front.politique.index')}}" class="body1 {{ $pIndex == 'politique' ? 'active' : ''}}" data-page="politique">Politique qualité</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a class="body1
                            {{ $pIndex == 'prestation' ? 'active' : ''}}
                            " data-page="prestation" href="#">Prestation</a>
                            <ul class="submenu">
                                <li>
                                    <a  href="{{ route('front.prestation.index') }}" class="mission.html {{ $pIndex == 'prestationAll' ? 'active' : ''}}" data-page="mission">
                                        Toutes les prestations
                                    </a>
                                </li>
                                @foreach ($prestationType as $key => $item)
                                    <li>
                                        <a href="{{ route('front.prestation.detail', [$item->slug]) }}" class="mission.html" data-page="{{ $item->slug }}" style="text-transform: lowercase;">
                                            {{ $item->libelle }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        <li><a href="{{ route('front.tarification.index') }}" class="body1 {{ $pIndex == 'tarification' ? 'active' : ''}}" data-page="tarification">Tarification</a></li>
                        <li>
                            <a href="#" class="body1
                                {{ ($pIndex=='calendrier' || $pIndex=='vaccin' || $pIndex=='faq' || $pIndex=='galerie') ? 'active' : '' }}
                            " data-page="infos_utiles">Infos utiles</a>
                            <ul class="submenu">
                                <li><a href="{{ route('front.calendrier.index') }}" class="mission.html {{ $pIndex == 'calendrier' ? 'active' : ''}}" data-page="mission">Calendrier de
                                        vaccination</a></li>
                                <li><a href="{{ route('front.vaccin.index') }}" class=" {{ $pIndex == 'vaccin' ? 'active' : ''}}" data-page="organisation">Vaccins
                                        disponible</a></li>
                                <li><a href="{{ route('front.galerie.index') }}" class="mission.html {{ $pIndex == 'galerie' ? 'active' : ''}}" data-page="mission">Galérie photo</a></li>
                                <li><a href="{{ route('front.faq.index') }}" class="body1 {{ $pIndex == 'faq' ? 'active' : ''}}" data-page="organisation">FAQ</a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('front.agenda.index') }}" class="body1 {{ $pIndex == 'agenda' ? 'active' : ''}}" data-page="agenda">Agenda</a></li>
                        <li><a href="{{ route('front.document.index') }}" class="body1 {{ $pIndex == 'document' ? 'active' : ''}}" data-page="documents">Documents</a></li>
                        <li><a href="{{ route('front.blog.index') }}" class="body1 {{ $pIndex == 'blog' ? 'active' : ''}}" data-page="blog">Blog</a></li>
                        <li><a href="#" class="body1 {{ ($pIndex == 'contact' || $pIndex == 'antenne' || $pIndex == 'reclamation') ? 'active' : ''}}" data-page="contacts">Nous Joindres</a>
                            <ul class="submenu">
                                <li><a href="{{ route('front.contact.index') }}" class="contacts.html {{ ($pIndex == 'contact') ? 'active' : ''}}" data-page="contacts">Contactez-nous</a></li>
                                <li><a href="{{ route('front.antenne.index') }}" class="mission.html {{ ($pIndex == 'antenne') ? 'active' : ''}}" data-page="antenne">Antennes & Postes</a></li>
                                <li><a href="{{ route('front.reclamation.index') }}" class="mission.html {{ ($pIndex == 'reclamation') ? 'active' : ''}}" data-page="reclamation">Reclamations & Suggestions</a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
            @include('front._.menuMobile')

        </div>


    </div>

    <div class="cadre-social">
        <a href="{{ !empty($company) ? $company->twitter : '' }}" target="_blank"><img src="{{ asset('model/assets/icons/twitter.svg')}}" alt="twitter"></a>
        <a href="{{ !empty($company) ? $company->facebook : '' }}" target="_blank"><img src="{{ asset('model/assets/icons/facebook.svg')}}" alt="facebook"></a>
        <a href="{{ !empty($company) ? $company->youtube : '' }}" target="_blank"><img src="{{ asset('model/assets/icons/youtube.svg')}}" alt="youtube"></a>
        <!-- <div class="body2">info@inhp.ci</div> -->
    </div>

</section>

@push('script-mobile-menu')
<script src="{{ asset('model/js/mobileMenu.js') }}"></script>
@endpush
