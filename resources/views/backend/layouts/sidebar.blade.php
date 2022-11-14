<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('') }}" target="_blank" class="brand-link">
        <img src="{{ url('assets/adminLte/dist/img/AdminLTELogo.png') }}" alt="GMSPortail Logo"
            class="brand-image img-circle" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ str_replace('_', ' ', config('app.name')) }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        {{-- <div class="user-panel py-2 mb-3 d-flex">
            @if (auth()->user()->roles[0]->name == 'client')
                <div class="info text-center" id="client">
                    <img src="{{ url(auth()->user()->client->chemin) }}"
                        alt="{{ auth()->user()->client->raison_sociale }}">
                    <a href="{{ route('user.edit_profile') }}" class="d-block text-capitalize">{{ auth()->user()->client->raison_sociale }}</a>
                </div>
            @else
                <div class="info text-center" id="user">
                    <img src="{{ url(auth()->user()->chemin) }}" alt="{{ auth()->user()->name }}">
                    <a href="{{ route('user.edit_profile') }}" class="d-block text-capitalize">{{ auth()->user()->name }}</a>
                </div>
            @endif
        </div> --}}

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{ url(auth()->user()->chemin) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="{{ route('user.edit_profile') }}" class="d-block">{{ auth()->user()->name }}</a>
            </div>
          </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2 text-capitalize">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                {{-- Dashboard stats links --}}
                @can('tableau_bord_index')
                    <li class="nav-header">Dashboard</li>
                    <li class="nav-item ">
                        <a href="{{ adminUrl('stats') }}" class="nav-link {{ active_menu('stats')[1] }} ">
                            <i class="nav-icon fa fa-dashboard"></i>
                            <p>tableau de bord</p>
                        </a>
                    </li>
                @endcan

                {{-- sites links --}}
                @can('sites_index')
                    <li class="nav-header">sites</li>
                    <li class="nav-item has-treeview {{ active_menu('sites')[0] }}">
                        <a href="#" class="nav-link {{ active_menu('sites')[1] }}">
                            <i class="nav-icon fa fa-globe"></i>
                            <p>
                                sites
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('ajouter_client')
                                <li class="nav-item">
                                    <a href="{{ adminUrl('sites/create') }}"
                                        class="nav-link {{ setActive('sites/create') }} ">
                                        <i class="fa fa-plus-circle nav-icon"></i>
                                        <p>nouveau</p>
                                    </a>
                                </li>
                            @endcan
                            @can('liste_sites')
                                <li class="nav-item">
                                    <a href="{{ adminUrl('sites') }}" class="nav-link {{ setActive('sites') }} ">
                                        <i class="fa fa-chevron-right nav-icon"></i>
                                        <p>list des sites</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                {{-- clients links --}}
                @can('clients_index')
                    <li class="nav-header">clients</li>
                    <li class="nav-item has-treeview {{ active_menu('clients')[0] }}">
                        <a href="#" class="nav-link {{ active_menu('clients')[1] }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                clients
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('ajouter_client')
                                <li class="nav-item">
                                    <a href="{{ adminUrl('clients/create') }}"
                                        class="nav-link {{ setActive('clients/create') }} ">
                                        <i class="fa fa-plus-circle nav-icon"></i>
                                        <p>nouveau</p>
                                    </a>
                                </li>
                            @endcan
                            @can('liste_clients')
                                <li class="nav-item">
                                    <a href="{{ adminUrl('clients') }}" class="nav-link {{ setActive('clients') }} ">
                                        <i class="fa fa-chevron-right nav-icon"></i>
                                        <p>list des clients</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                {{-- employes links --}}
                @can('employés_index')
                    <li class="nav-header">employés</li>
                    <li class="nav-item has-treeview {{ active_menu('employes')[0] }}">
                        <a href="#" class="nav-link {{ active_menu('employes')[1] }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                employés
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('ajouter_client')
                                <li class="nav-item">
                                    <a href="{{ adminUrl('employes/create') }}"
                                        class="nav-link {{ setActive('employes/create') }} ">
                                        <i class="fa fa-plus-circle nav-icon"></i>
                                        <p>nouveau</p>
                                    </a>
                                </li>
                            @endcan
                            @can('liste_employés')
                                <li class="nav-item">
                                    <a href="{{ adminUrl('employes') }}" class="nav-link {{ setActive('employes') }} ">
                                        <i class="fa fa-chevron-right nav-icon"></i>
                                        <p>list des employés</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                {{-- documents links --}}
                @can('documents_index')
                    <li class="nav-header">documents</li>
                    <li class="nav-item has-treeview {{ active_menu('documents')[0] }}">
                        <a href="#" class="nav-link {{ active_menu('documents')[1] }}">
                            <i class="nav-icon fa fa-files-o"></i>
                            <p>
                                documents
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('ajouter_document')
                                <li class="nav-item">
                                    <a href="{{ route('documents.create') }}"
                                        class="nav-link {{ setActive('documents/create') }} ">
                                        <i class="fa fa-plus-circle nav-icon"></i>
                                        <p>Nouveau</p>
                                    </a>
                                </li>
                            @endcan
                            @can('liste_documents')
                                <li class="nav-item">
                                    <a href="{{ adminUrl('documents') }}" class="nav-link {{ setActive('documents') }} ">
                                        <i class="fa fa-chevron-right nav-icon"></i>
                                        <p>list</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                {{-- invoices links --}}
                @can('factures_index')
                    <li class="nav-header">factures</li>
                    <li class="nav-item has-treeview {{ active_menu('invoices')[0] }}">
                        <a href="#" class="nav-link {{ active_menu('invoices')[1] }}">
                            <i class="nav-icon fa fa-files-o"></i>
                            <p>
                                factures
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('ajouter_facture')
                                <li class="nav-item">
                                    <a href="{{ route('invoices.create') }}"
                                        class="nav-link {{ setActive('invoices/create') }} ">
                                        <i class="fa fa-plus-circle nav-icon"></i>
                                        <p>Nouveau</p>
                                    </a>
                                </li>
                            @endcan
                            @can('liste_facture')
                                <li class="nav-item">
                                    <a href="{{ adminUrl('invoices') }}" class="nav-link {{ setActive('invoices') }} ">
                                        <i class="fa fa-chevron-right nav-icon"></i>
                                        <p>list</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                {{-- plannings links --}}
                @can('événements_index')
                    <li class="nav-header">plannings</li>
                    <li class="nav-item has-treeview {{ active_menu('plannings')[0] }}">
                        <a href="#" class="nav-link {{ active_menu('plannings')[1] }}">
                            <i class="nav-icon fa fa-clock-o"></i>
                            <p>
                                plannings
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('ajouter_événement')
                                <li class="nav-item">
                                    <a href="{{ route('plannings.create') }}"
                                        class="nav-link {{ setActive('plannings/create') }} ">
                                        <i class="fa fa-plus-circle nav-icon"></i>
                                        <p>Nouveau</p>
                                    </a>
                                </li>
                            @endcan
                            @can('liste_événements')
                                <li class="nav-item">
                                    <a href="{{ adminUrl('plannings') }}" class="nav-link {{ setActive('plannings') }} ">
                                        <i class="fa fa-chevron-right nav-icon"></i>
                                        <p>list</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                {{-- tickets links --}}
                @can('tickets_index')
                    <li class="nav-header">tickets</li>
                    <li class="nav-item has-treeview {{ active_menu('tickets')[0] }}">
                        <a href="#" class="nav-link {{ active_menu('tickets')[1] }}">
                            <i class="nav-icon fa fa-Example of ticket fa-ticket"></i>
                            <p>
                                tickets
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('ajouter_ticket')
                                <li class="nav-item">
                                    <a href="{{ route('tickets.create') }}"
                                        class="nav-link {{ setActive('tickets/create') }} ">
                                        <i class="fa fa-plus-circle nav-icon"></i>
                                        <p>Ajouter</p>
                                    </a>
                                </li>
                            @endcan
                            @can('liste_tickets')
                                <li class="nav-item">
                                    <a href="{{ adminUrl('tickets') }}" class="nav-link {{ setActive('tickets') }} ">
                                        <i class="fa fa-chevron-right nav-icon"></i>
                                        <p>liste tickets</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                {{-- settings links --}}
                @can('paramètres_index')
                    <li class="nav-header">paramètres</li>
                    <li class="nav-item has-treeview {{ active_menu('settings')[0] }}">
                        <a href="#" class="nav-link {{ active_menu('settings')[1] }}">
                            <i class="nav-icon fa fa-cogs"></i>
                            <p>
                                paramètres
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('editer_paramètres')
                                <li class="nav-item">
                                    <a href="{{ adminUrl('settings') }}" class="nav-link {{ setActive('settings') }} ">
                                        <i class="fa fa-pencil-square nav-icon"></i>
                                        <p>éditer</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                {{-- users links --}}
                @can('utilisateurs_index')
                    <li class="nav-header">Utilisateurs</li>
                    <li class="nav-item has-treeview {{ active_menu('users')[0] }}">
                        <a href="#" class="nav-link {{ active_menu('users')[1] }}">
                            <i class="nav-icon fa fa-users"></i>
                            <p>
                                Utilisateurs
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('nouveau_utilisateur')
                                <li class="nav-item">
                                    <a href="{{ adminUrl('users/create') }}"
                                        class="nav-link {{ setActive('users/create') }} ">
                                        <i class="fa fa-plus-circle nav-icon"></i>
                                        <p>ajouter nouveau</p>
                                    </a>
                                </li>
                            @endcan

                            @can('liste_utilisateurs')
                                <li class="nav-item">
                                    <a href="{{ adminUrl('users') }}" class="nav-link {{ setActive('users') }} ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>liste</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                {{-- roles and permissions links --}}
                @can('autorisations_index')
                    <li class="nav-header">Autorisations des utilisateurs</li>
                    <li
                        class="nav-item has-treeview {{ active_menu('roles')[0] || active_menu('permission')[0] ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link {{ active_menu('roles')[1] }}">
                            <i class="nav-icon fa fa-unlock"></i>
                            <p>
                                rôles
                                <i class="fa fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            @can('nouveau_rôle')
                                <li class="nav-item">
                                    <a href="{{ adminUrl('roles/create') }}"
                                        class="nav-link {{ setActive('roles/create') }} ">
                                        <i class="fa fa-plus-circle nav-icon"></i>
                                        <p>ajouter nouveau</p>
                                    </a>
                                </li>
                            @endcan

                            @can('liste_rôles')
                                <li class="nav-item">
                                    <a href="{{ adminUrl('roles') }}" class="nav-link {{ setActive('roles') }} ">
                                        <i class="fa fa-circle-o nav-icon"></i>
                                        <p>liste</p>
                                    </a>
                                </li>
                            @endcan

                            @can('nouvelle_autorisation')
                                <li class="nav-item">
                                    <a href="{{ adminUrl('permission/create') }}"
                                        class="nav-link {{ setActive('permission/create') }} ">
                                        <i class="fa fa-lock nav-icon"></i>
                                        <p>nouvelle autorisation</p>
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
