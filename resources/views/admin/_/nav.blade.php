

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
            {{ ($pIndex=='motif.all' || $pIndex=='motif.new' || $pIndex=='motif.infos') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('motif.all') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Motifs</span>
                </a>
            </li>
        <hr class="sidebar-divider">
            <li class="nav-item
            {{ ($pIndex=='fonction.all' || $pIndex=='fonction.new' || $pIndex=='fonction.infos') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('fonction.all') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Fonctions</span>
                </a>
            </li>
        <hr class="sidebar-divider">
            <li class="nav-item
            {{ ($pIndex=='demande.all' || $pIndex=='demande.new' || $pIndex=='demande.infos') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('demande.all') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Demandes</span>
                </a>
            </li>
        <hr class="sidebar-divider">
            <li class="nav-item
            {{ ($pIndex=='user.all' || $pIndex=='user.new' || $pIndex=='user.infos') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.all') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Utilisateurs</span>
                </a>
            </li>
        <hr class="sidebar-divider">
            <li class="nav-item
                {{ ($pIndex=='company.infos') ? 'active' : '' }}
                {{ ($pIndex=='client.all' || $pIndex=='client.new' || $pIndex=='client.infos') ? 'active' : '' }}
                {{ ($pIndex=='referencement.all' || $pIndex=='referencement.new' || $pIndex=='referencement.infos') ? 'active' : '' }}
                ">
                <a class="nav-link" href="" data-toggle="collapse" data-target="#cotisations" aria-expanded="true" aria-controls="cotisations">
                    <i class="fa fa-tags"></i>
                    <span>Cotisations</span>
                </a>
                <div id="cotisations" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{  ($pIndex=='cotisationMensuelle.all' || $pIndex=='cotisationMensuelle.new' || $pIndex=='cotisationMensuelle.infos') ? 'active' : '' }}"
                            href="{{ route('cotisationMensuelle.all') }}">
                            <i class="fa fa-handshake-o"></i>
                            Mensuelles
                        </a>
                        <a class="collapse-item {{  ($pIndex=='cotisationExceptionnelle.all' || $pIndex=='cotisationExceptionnelle.new' || $pIndex=='cotisationExceptionnelle.infos') ? 'active' : '' }}"
                            href="{{ route('cotisationExceptionnelle.all') }}">
                            <i class="fa fa-handshake-o"></i>
                            Exceptionnelles
                        </a>
                    </div>
                </div>
            </li>
    @if (Auth::user()->role  === 'admin')
        <hr class="sidebar-divider">
            <li class="nav-item
                {{ ($pIndex=='company.infos') ? 'active' : '' }}
                {{ ($pIndex=='client.all' || $pIndex=='client.new' || $pIndex=='client.infos') ? 'active' : '' }}
                {{ ($pIndex=='referencement.all' || $pIndex=='referencement.new' || $pIndex=='referencement.infos') ? 'active' : '' }}
                ">
                <a class="nav-link" href="" data-toggle="collapse" data-target="#collapseParamsite" aria-expanded="true" aria-controls="collapseParamsite">
                    <i class="fa fa-tags"></i>
                    <span>Paramètres</span>
                    {{-- <span>Site web {{ config('global.name') }}</span> --}}
                </a>
                <div id="collapseParamsite" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item {{ ($pIndex=='company.infos') ? 'active' : '' }}" href="{{ route('company.new') }}">
                            <span>Association</span>
                        </a>
                        <a class="collapse-item {{ ($pIndex=='about.infos') ? 'active' : '' }}" href="{{ route('about.new') }}">
                            <span>A propos</span>
                        </a>
                </div>
                </div>
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
