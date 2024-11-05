

  <!-- Sidebar -->
  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex mb-3" href="">
      <div class="sidebar-brand-icon">
            <img src="{{ $company ? $company->getLogo1() : '' }}" alt="{{ config('global.name') }}" class="slidebar-logo">
      </div>
      <div class="sidebar-brand-text mx-3">{{-- config('global.name') --}}</div>
    </a>
    <!-- Divider -->
    <hr class="">

        <li class="nav-item <?= $pIndex=='dashboard' ? 'active' : '' ?>">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Tableau de bord</span></a>
        </li>
    <hr class="sidebar-divider">
        <li class="nav-item
            {{ ($pIndex=='contact.all' || $pIndex=='contact.infos') ? 'active' : '' }}
            {{ ($pIndex=='newsletter.all' || $pIndex=='newsletter.infos') ? 'active' : '' }}
            {{ ($pIndex=='reclamation.all' || $pIndex=='reclamation.infos') ? 'active' : '' }}
            ">
            <a class="nav-link" href="" data-toggle="collapse" data-target="#visiteurs" aria-expanded="true" aria-controls="visiteurs">
                <i class="fa fa-tags"> Visiteurs</i>
                <span></span>
            </a>
            <div id="visiteurs" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ ($pIndex=='contact.all' || $pIndex=='contact.infos') ? 'active' : '' }}" href="{{ route('contact.all') }}">
                        <span>Contacts</span>
                    </a>
                    <a class="collapse-item {{ ($pIndex=='newsletter.all' || $pIndex=='newsletter.infos') ? 'active' : '' }}" href="{{ route('newsletter.all') }}">
                        <span>NewsLetters</span>
                    </a>
                    <a class="collapse-item {{ ($pIndex=='reclamation.all' || $pIndex=='reclamation.new' || $pIndex=='reclamation.infos') ? 'active' : '' }}" href="{{ route('reclamation.all') }}">
                        <span>Réclamations & Suggestions</span>
                    </a>
                </div>
            </div>
        </li>
    <hr class="sidebar-divider">
        <li class="nav-item
            {{ ($pIndex=='prestationType.all' || $pIndex=='prestationType.new' || $pIndex=='prestationType.infos') ? 'active' : '' }}
            {{ ($pIndex=='vaccinFamille.all' || $pIndex=='vaccinFamille.new' || $pIndex=='vaccinFamille.infos') ? 'active' : '' }}
            {{ ($pIndex=='laboratoireType.all' || $pIndex=='laboratoireType.new' || $pIndex=='laboratoireType.infos') ? 'active' : '' }}
            {{ ($pIndex=='documentType.all' || $pIndex=='documentType.new' || $pIndex=='documentType.infos') ? 'active' : '' }}
            ">
            <a class="nav-link" href="" data-toggle="collapse" data-target="#collapseType" aria-expanded="true" aria-controls="collapseType">
                <i class="fa fa-tags"> Types</i>
                <span></span>
                {{-- <span>Site web {{ config('global.name') }}</span> --}}
            </a>
            <div id="collapseType" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ ($pIndex=='prestationType.all' || $pIndex=='prestationType.new' || $pIndex=='prestationType.infos') ? 'active' : '' }}" href="{{ route('prestationType.all') }}">
                        <span>Type de Prestations</span>
                    </a>
                    <a class="collapse-item {{ ($pIndex=='vaccinFamille.all' || $pIndex=='vaccinFamille.new' || $pIndex=='vaccinFamille.infos') ? 'active' : '' }}" href="{{ route('vaccinFamille.all') }}">
                        <span>Type de Vaccins</span>
                    </a>
                    <a class="collapse-item {{ ($pIndex=='laboratoireType.all' || $pIndex=='laboratoireType.new' || $pIndex=='laboratoireType.infos') ? 'active' : '' }}" href="{{ route('laboratoireType.all') }}">
                        <span>Type de Laboratoires</span>
                    </a>
                    <a class="collapse-item {{ ($pIndex=='documentType.all' || $pIndex=='documentType.new' || $pIndex=='documentType.infos') ? 'active' : '' }}" href="{{ route('documentType.all') }}">
                        <span>Type de Documents</span>
                    </a>
                </div>
            </div>
        </li>
    <hr class="sidebar-divider">
        <li class="nav-item
            {{ ($pIndex=='directeur.infos') ? 'active' : '' }}
            {{ ($pIndex=='historique.infos') ? 'active' : '' }}
            {{ ($pIndex=='organisation.infos') ? 'active' : '' }}
            {{ ($pIndex=='mission.infos') ? 'active' : '' }}
            {{ ($pIndex=='politique.infos') ? 'active' : '' }}
            ">
            <a class="nav-link" href="" data-toggle="collapse" data-target="#collapsePresentation" aria-expanded="true" aria-controls="collapsePresentation">
                <i class="fa fa-tags"> Présentation</i>
                <span></span>
                {{-- <span>Site web {{ config('global.name') }}</span> --}}
            </a>
            <div id="collapsePresentation" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ ($pIndex=='directeur.infos') ? 'active' : '' }}" href="{{ route('directeur.info') }}">
                        <span>Mot du directeur</span>
                    </a>
                    <a class="collapse-item {{ ($pIndex=='historique.infos') ? 'active' : '' }}" href="{{ route('historique.info') }}">
                        <span>Historique</span>
                    </a>
                    <a class="collapse-item {{ ($pIndex=='organisation.infos') ? 'active' : '' }}" href="{{ route('organisation.info') }}">
                        <span>Organisation</span>
                    </a>
                    <a class="collapse-item {{ ($pIndex=='mission.infos') ? 'active' : '' }}" href="{{ route('mission.info') }}">
                        <span>Mission</span>
                    </a>
                    <a class="collapse-item {{ ($pIndex=='politique.infos') ? 'active' : '' }}" href="{{ route('politique.info') }}">
                        <span>Politique Qualité</span>
                    </a>
                </div>
            </div>
        </li>
        
    <hr class="sidebar-divider">
        <li class="nav-item
            {{ ($pIndex=='company.infos') ? 'active' : '' }}
            {{ ($pIndex=='client.all' || $pIndex=='client.new' || $pIndex=='client.infos') ? 'active' : '' }}
            {{ ($pIndex=='referencement.all' || $pIndex=='referencement.new' || $pIndex=='referencement.infos') ? 'active' : '' }}
            ">
            <a class="nav-link" href="" data-toggle="collapse" data-target="#collapseParamsite" aria-expanded="true" aria-controls="collapseParamsite">
                <i class="fa fa-tags"></i>
                <span>Entreprise</span>
                {{-- <span>Site web {{ config('global.name') }}</span> --}}
            </a>
            <div id="collapseParamsite" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item {{ ($pIndex=='company.infos') ? 'active' : '' }}" href="{{ route('company.new') }}">
                        <span>Paramètres</span>
                    </a>
                    <a class="collapse-item {{ ($pIndex=='about.infos') ? 'active' : '' }}" href="{{ route('about.new') }}">
                        <span>A propos</span>
                    </a>
              </div>
            </div>
        </li>
        @if (Auth::user()->role  == 'admin')
            <hr class="sidebar-divider">
            <li class="nav-item
            {{ ($pIndex=='user.all' || $pIndex=='user.new' || $pIndex=='user.infos') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.all') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Utilisateur</span>
                </a>
            </li>
        @endif
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
      <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

  </ul>
  <!-- End of Sidebar -->
