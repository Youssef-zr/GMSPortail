<nav class="navbar fixed-top navbar-expand-lg navbar-default bg-white border-bottom">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="{{ url('assets/dist/images/GMSPortail/logo.png') }}"
                alt=""></a>
        <button class="navbar-toggler" type="button">
            <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" data-scroll=".section-about">A propos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-scroll=".section-services">services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-scroll=".section-history">historique</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-scroll=".section-contact">Contact</a>
                </li>
                <li class="nav-item">
                    @if (auth()->check()==false)
                        <a class="nav-link contact-link" href="{{ url('/login') }}"><i class="fa fa-user"></i>
                            Connexion
                        </a>
                    @else
                        <a class="nav-link contact-link" href="{{ adminUrl('') }}"><i class="fa fa-dashboard"></i>
                            Tableau de bord
                        </a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
</nav>
