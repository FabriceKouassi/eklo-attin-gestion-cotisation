<nav class="menu-secondaire" id="menu_secondaire">
    <a class="body1 mobile-menu-close-icon" onclick="closeSecondMenu()">
        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32"><path fill="currentColor" d="M16 2C8.2 2 2 8.2 2 16s6.2 14 14 14s14-6.2 14-14S23.8 2 16 2m0 26C9.4 28 4 22.6 4 16S9.4 4 16 4s12 5.4 12 12s-5.4 12-12 12"/><path fill="currentColor" d="M21.4 23L16 17.6L10.6 23L9 21.4l5.4-5.4L9 10.6L10.6 9l5.4 5.4L21.4 9l1.6 1.6l-5.4 5.4l5.4 5.4z"/></svg>
    </a>
    <ul>
        <li><a href="{{ route('front.index') }}" class="body1 {{ $pIndex == 'accueil' ? 'active' : ''}}">Accueil</a></li>
        <li>
            <a href="#" class="body1
                {{ $pIndex == 'presentation' ? 'active' : ''}}
                {{ ($pIndex=='directeur' || $pIndex=='historique' || $pIndex=='mission' || $pIndex=='organisation' || $pIndex=='plan' || $pIndex=='politique') ? 'active' : '' }}
                "
                data-page="presentation" onclick="showSubMenu(this)">
                Présentation 
                <svg class="mobile-submenu-icon" xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="m7 10l5 5l5-5z"/></svg>
            </a>
            <ul class="mobile-submenu 
            {{ ($pIndex=='directeur' || $pIndex=='historique' || $pIndex=='mission' || $pIndex=='organisation' || $pIndex=='plan' || $pIndex=='politique') ? 'mobile-submenu-active' : '' }}
            ">
                <li><a href="{{ route('front.directeur.index') }}" class="body1 {{ $pIndex == 'directeur' ? 'active' : ''}}" data-page="directeur">Mot du directeur</a></li>
                <li><a href="{{ route('front.historique.index') }}" class="body1 {{ $pIndex == 'historique' ? 'active' : ''}}" data-page="historique">Historique</a></li>
                <li>
                    <a href="#" class="body1 {{ ($pIndex == 'mission' || $pIndex=='organisation') ? 'active' : ''}}" data-page="missions"  onclick="showSubSubMenu(this)">Mission et organisation
                        <svg class="mobile-submenu-icon" xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="m7 10l5 5l5-5z"/></svg>
                    </a>
                    <ul class="mobile-subsubmenu
                    {{ ($pIndex=='mission' || $pIndex=='organisation') ? 'mobile-submenu-active' : '' }}
                    ">
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
            " data-page="prestation" href="#" onclick="showSubMenu(this)">Prestation
                <svg class="mobile-submenu-icon" xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="m7 10l5 5l5-5z"/></svg>
            </a>
            <ul class="mobile-submenu {{ ($pIndex == 'prestationAll') ? 'mobile-submenu-active' : ''}}">
                <li>
                    <a href="{{ route('front.prestation.index') }}" class="mission.html {{ $pIndex == 'prestationAll' ? 'active' : ''}}" data-page="mission">
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
            " data-page="infos_utiles" onclick="showSubMenu(this)">Infos utiles
                <svg class="mobile-submenu-icon" xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="m7 10l5 5l5-5z"/></svg>

            </a>
            <ul class="mobile-submenu
            {{ ($pIndex=='calendrier' || $pIndex=='vaccin' || $pIndex=='faq' || $pIndex=='galerie') ? 'mobile-submenu-active' : '' }}
            ">
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
        <li><a href="#" class="body1 {{ ($pIndex == 'contact' || $pIndex == 'antenne' || $pIndex == 'reclamation') ? 'active' : ''}}" data-page="contacts" onclick="showSubMenu(this)">Nous Joindres
            <svg class="mobile-submenu-icon" xmlns="http://www.w3.org/2000/svg" width="1.2em" height="1.2em" viewBox="0 0 24 24"><path fill="currentColor" d="m7 10l5 5l5-5z"/></svg>
        </a>
            <ul class="mobile-submenu {{ ($pIndex == 'contact' || $pIndex == 'antenne' || $pIndex == 'reclamation') ? 'mobile-submenu-active' : ''}}">
                <li><a href="{{ route('front.contact.index') }}" class="contacts.html {{ ($pIndex == 'contact') ? 'active' : ''}}" data-page="contacts">Contactez-nous</a></li>
                <li><a href="{{ route('front.antenne.index') }}" class="mission.html {{ ($pIndex == 'antenne') ? 'active' : ''}}" data-page="antenne">Antennes & Postes</a></li>
                <li><a href="{{ route('front.reclamation.index') }}" class="mission.html {{ ($pIndex == 'reclamation') ? 'active' : ''}}" data-page="reclamation">Reclamations & Suggestions</a></li>
            </ul>
        </li>
    </ul>
</nav>