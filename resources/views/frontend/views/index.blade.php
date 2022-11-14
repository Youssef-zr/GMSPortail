@extends('frontend.layouts.master')
@section('content')
    {{-- start slider with swiper plugin --}}
    <section class="section-swiper-slider">
        <!-- Slider main container -->
        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <div class="swiper-slide">
                    <img src="{{ url('assets/dist/images/GMSPortail/1.jpg') }}" alt="slider image 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ url('assets/dist/images/GMSPortail/2.jpg') }}" alt="slider image 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ url('assets/dist/images/GMSPortail/3.jpg') }}" alt="slider image 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ url('assets/dist/images/GMSPortail/4.jpg') }}" alt="slider image 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ url('assets/dist/images/GMSPortail/5.jpg') }}" alt="slider image 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ url('assets/dist/images/GMSPortail/6.jpg') }}" alt="slider image 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ url('assets/dist/images/GMSPortail/7.jpg') }}" alt="slider image 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ url('assets/dist/images/GMSPortail/8.jpg') }}" alt="slider image 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ url('assets/dist/images/GMSPortail/9.jpg') }}" alt="slider image 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ url('assets/dist/images/GMSPortail/10.jpg') }}" alt="slider image 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ url('assets/dist/images/GMSPortail/11.jpg') }}" alt="slider image 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ url('assets/dist/images/GMSPortail/12.jpg') }}" alt="slider image 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ url('assets/dist/images/GMSPortail/13.jpg') }}" alt="slider image 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ url('assets/dist/images/GMSPortail/14.jpg') }}" alt="slider image 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ url('assets/dist/images/GMSPortail/15.jpg') }}" alt="slider image 1">
                </div>
                <div class="swiper-slide">
                    <img src="{{ url('assets/dist/images/GMSPortail/16.jpg') }}" alt="slider image 1">
                </div>
            </div>
            <!-- If we need pagination -->
            {{-- <div class="swiper-pagination"></div> --}}

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            <!-- If we need scrollbar -->
            {{-- <div class="swiper-scrollbar"></div> --}}
        </div>
    </section>

    {{-- start section about us --}}
    <section class="section-about">
        <div class="container">
            <div class="row align-items-md-center">
                {{-- information --}}
                <div class="col-md-7 col-lg-6 mb-4">
                    <div class="information">
                        <div class="title mb-3">
                            <span class="sub-title text-capitalize text-white text-underline"> à propos de nous</span>
                            <h3 class="main-title mt-2">Groupe Mondial Service</h3>
                        </div>
                        <div class="text">
                            <p>
                                Acteur omnipotent et en perpétuelle croissance de sa gamme de services dédiés aux
                                institutionnels et aux professionnels, <span class="text-primary">GROUPE MONDIAL
                                    SERVICE</span> se dresse un modèle de
                                développement pluridisciplinaire (managérial, technique, en qualité…) pour se conformer aux
                                contraintes d’un marché devenu de plus en plus exigent.
                            </p>
                            <p>
                                Depuis sa création, <span class="text-primary">GROUPE MONDIAL SERVICE</span> est conscient
                                de son choix stratégique:
                                l’omniprésence par le biais d’une gamme de prestation diversifiée en nettoyage, en
                                gardiennage et en intérim.
                            </p>
                            <p class="mb-2 text-underline text-white">
                                En effet, la priorité au sein du groupe s’articule autour de paliers:
                            </p>
                            <ul class="list-unstyled">

                                <li class="d-flex mb-2"><i class="fa fa-check mt-1 text-primary"></i> L’écoute et la
                                    réactivité via un système proactif et réactif.</li>
                                <li class="d-flex mb-2"><i class="fa fa-check mt-1 text-primary"></i> La qualité des
                                    prestations.</li>
                                <li class="d-flex mb-2">
                                    <i class="fa fa-check mt-1 text-primary"></i> La collaboration de l’équipe; symbole de
                                    coopération, de fidélité et de la bonne
                                    pratique
                                    de communication interne.
                                </li>
                            </ul>
                            <p>
                                Par ailleurs et pour toucher davantage plusieurs secteurs de l’économie nationale, GROUPE
                                MONDIAL SERVICE booste sa Force de Vente et l’oriente vers la conquête de nouveaux débouchés
                                en déployant les nouvelles techniques de chacun de ses métiers.
                            </p>
                        </div>
                    </div>
                </div>
                {{-- image --}}
                <div class="col-md-5 col-lg-6">
                    <div class="image">
                        <img src="{{ url('assets/dist/images/GMSPortail/about.jpg') }}" alt="about us"
                            class="img-responsive">
                        {{-- <img src="{{ url('assets/dist/images/about.jpg') }}" alt="about us" srcset=""> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- start section services --}}
    <section class="section-services section">
        <div class="container">
            <div class="title">
                <h3 class="text-center"><i class="fa fa-gears"></i> <label>Nos Services</label></h3>
            </div>

            {{-- services --}}
            <div class="services-list">
                <div class="row">
                    <div class="col-12">
                        <div id="accordion" class="mb-5">
                            <div class="card mb-2">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" href="#collapseOne">
                                        <i class="fa fa-chevron-right"></i> Intérim
                                    </a>
                                </div>
                                <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>
                                            Face à un marché en plein essor, l’exigence des compétences actuelles et le
                                            besoin des entreprises en recrutement qui ne cessent pas de croître, Mondial
                                            Intérim combine un ensemble de solutions efficaces à l’insertion
                                            professionnelle; la prise en charge du personnel intérimaire et l’épanouissement
                                            des carrières.
                                        </p>
                                        <p>
                                            Pour satisfaire ses clients, Mondial Intérim s’appuie sur ses valeurs
                                            professionnelles inhérentes cherchant une meilleure qualité de service et le
                                            maintien de la confiance de ses clients.
                                        </p>
                                        <p>
                                            La gamme de solutions de Mondial Intérim englobe l’intérim, le recrutement et le
                                            travail temporaire.
                                        </p>
                                        <q>
                                            Confiez ce métier à un professionnel Mondial Intérim est votre partenaire
                                            professionnel en gestion ressources humaines.
                                        </q>
                                        <p>
                                            Notre équipe de travail suit un modèle unique grâce à une CVthèque riche et
                                            variée qui combine en amont la recherche des profils avec la mise à dispositions
                                            des compétences.
                                            En aval, une présence émérite d’une procédure de suivi, ayant pour but d’évaluer
                                            en permanence votre satisfaction.
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-2">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                                        <i class="fa fa-chevron-right"></i> Gardiennage
                                    </a>
                                </div>
                                <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>
                                            Dans un marché où s’accroit notablement le nombre des entreprises , le besoin de
                                            la sécurité s’accroit également. Groupe Mondial Service se fait un prestataire
                                            visionnaire, qui sait combler les exigences et se conforme aux normes du marché.
                                            Un agent motivé fait un client satisfait, l’implication de nos agents de
                                            sécurité véhicule notre image de marque qu’on veille à entretenir et consolider
                                            à travers notre gamme de services:
                                        </p>
                                        <ul>
                                            <li>
                                                <i class="fa fa-check-square text-primary"></i>
                                                La surveillance des sites
                                                industriels et des zones d’activité.
                                            </li>
                                            <li>
                                                <i class="fa fa-check-square text-primary"></i>
                                                Le gardiennage des
                                                immeubles
                                                et des bureaux.
                                            </li>
                                            <li>
                                                <i class="fa fa-check-square text-primary"></i>
                                                L’accueil et le contrôle
                                                d’accès.
                                            </li>
                                            <li>
                                                <i class="fa fa-check-square text-primary"></i>
                                                Le conseil et la gestion
                                                des
                                                risques.
                                            </li>
                                        </ul>
                                        <p>
                                            Bien notamment, une communication interne et régulière avec nos superviseurs et
                                            contrôleurs qui interviennent sur vos sites, nous permet de rester vigilent à
                                            l’encontre de votre satisfaction.
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-2">
                                <div class="card-header">
                                    <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                                        <i class="fa fa-chevron-right"></i> Nettoyage
                                    </a>
                                </div>
                                <div id="collapseThree" class="collapse" data-parent="#accordion">
                                    <div class="card-body">
                                        <p>
                                            <span class="text-primary">GROUPE MONDIAL SERVICE</span> est votre partenaire
                                            professionnel au quotidien qui vous
                                            offre plusieurs avantages à l’aide d’une mise en valeur, un entretien régulier
                                            et ponctuel de vos lieux de travail.
                                        </p>
                                        <p class="mb-1 text-primary text-underline"><strong>Nos services:</strong></p>
                                        <ul>
                                            <li>
                                                <i class="fa fa-check-square text-primary"></i>
                                                Nettoyage et entretien des
                                                locaux industriels et commerciaux.
                                            </li>
                                            <li>
                                                <i class="fa fa-check-square text-primary"></i>
                                                Nettoyage de la vitrerie et
                                                façade.
                                            </li>
                                            <li>
                                                <i class="fa fa-check-square text-primary"></i>
                                                Traitement des sols et des
                                                revêtements de sols.
                                            </li>
                                            <li>
                                                <i class="fa fa-check-square text-primary"></i>
                                                Nettoyage de moquettes et
                                                des revêtements textiles.
                                            </li>
                                            <li>
                                                <i class="fa fa-check-square text-primary"></i>
                                                Remise en état des sols et
                                                des surfaces dégradés.
                                            </li>
                                            <li>
                                                <i class="fa fa-check-square text-primary"></i>
                                                Remise en état des locaux.
                                            </li>
                                            <li>
                                                <i class="fa fa-check-square text-primary"></i>
                                                Evacuation des déchets.
                                            </li>
                                            <li>
                                                <i class="fa fa-check-square text-primary"></i>
                                                Travaux de fin de chantiers
                                            </li>
                                            <li>
                                                <i class="fa fa-check-square text-primary"></i>
                                                Nettoyage des surfaces:
                                                <ul class="pt-2 pl-4">
                                                    <li><i class="fa fa-circle"></i> Plafonds acoustiques.</li>
                                                    <li><i class="fa fa-circle"></i> Vinyles.</li>
                                                    <li><i class="fa fa-circle"></i> Surfaces alucobonds.</li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- service-item --}}
                    <div class="col-sm-6 col-md-4">
                        <div class="service-item">
                            <div class="service-item-icon">
                                <i class="fa fa fa-bandcamp fa-4x"></i>
                            </div>
                            <h5 class="service-item-title">
                                Mondial interim
                            </h5>
                            <div class="service-content">
                                <p>
                                    Votre partenaire en gestion des Ressources Humaines
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- service-item --}}
                    <div class="col-sm-6 col-md-4">
                        <div class="service-item">
                            <div class="service-item-icon">
                                <i class="fa fa fa-bandcamp fa-4x"></i>
                            </div>
                            <h5 class="service-item-title">
                                Mondial gardiennage
                            </h5>
                            <div class="service-content">
                                <p>
                                    Une sécurité efficace et adaptée à vos sites
                                </p>
                            </div>
                        </div>
                    </div>

                    {{-- service-item --}}
                    <div class="col-sm-6 col-md-4">
                        <div class="service-item">
                            <div class="service-item-icon">
                                <i class="fa fa fa-bandcamp fa-4x"></i>
                            </div>
                            <h5 class="service-item-title">
                                Mondial service
                            </h5>
                            <div class="service-content">
                                <p>
                                    Des services de Nettoyage et d'hygiène sans frontières
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- start section history --}}
    <section class="section-history section">
        <div class="container bootstrap snippets bootdeys">
            <div class="title text-center mb-5">
                <h4 class="text-white"><i class="fa fa-map-signs"></i> <label>Historique</label></h4>
            </div>
            <div class="timeline-centered timeline-sm">
                <article class="timeline-entry">
                    <div class="timeline-entry-inner">
                        <time datetime="2014-01-10T03:45" class="timeline-time"><span>2013</span></time>
                        <div class="timeline-icon bg-blue"><i class="fa fa-gear"></i></div>
                        <div class="timeline-label bg-blue">
                            <h4 class="timeline-title">Autorisation</h4>
                            <p>
                                MONDIAL GARDIENNAGE Obtient l’autorisation d’utilisations des chiens pour les
                                métiers de Gardiennage.
                            </p>
                        </div>
                    </div>
                </article>
                <article class="timeline-entry left-aligned">
                    <div class="timeline-entry-inner">
                        <time datetime="2014-01-10T03:45" class="timeline-time"><span>2012</span></time>
                        <div class="timeline-icon bg-green"><i class="fa fa-trophy"></i></div>
                        <div class="timeline-label bg-green">
                            <h4 class="timeline-title">Succès</h4>
                            <ul>
                                <li class="d-flex text-white mb-2">
                                    <i class="fa fa-check-square mt-1"></i>
                                    MONDIAL
                                    INTERIM obtient l’autorisation d’exercer l’intermédiation en matière de
                                    recrutement.
                                </li>
                                <li class="d-flex text-white mb-2">
                                    <i class="fa fa-check-square mt-1"></i>
                                    MONDIAL GARDIENNAGE obtient l’autorisation d’exercer les métiers de Gardiennage.
                                </li>
                                <li class="d-flex text-white mb-2">
                                    <i class="fa fa-check-square mt-1"></i>
                                    MONDIAL SERVICE certifié ISO 9001 V2008.
                                </li>
                                <li class="d-flex text-white mb-2">
                                    <i class="fa fa-check-square mt-1"></i>
                                    MONDIAL GARDIENNAGE certifié ISO 9001 V2008.
                                </li>
                                <li class="d-flex text-white">
                                    <i class="fa fa-check-square mt-1"></i>
                                    MONDIAL INTERIM Certifié ISO 9001 V2008.
                                </li>
                            </ul>
                        </div>
                    </div>
                </article>
                <article class="timeline-entry">
                    <div class="timeline-entry-inner">
                        <time datetime="2014-01-10T03:45" class="timeline-time"><span>2011</span></time>
                        <div class="timeline-icon bg-orange"><i class="fa fa-home"></i></div>
                        <div class="timeline-label bg-orange">
                            <h4 class="timeline-title">Nouvelle agence</h4>
                            <p>
                                Ouverture d’une agence à Marrakech
                            </p>
                        </div>
                    </div>
                </article>
                <article class="timeline-entry left-aligned">
                    <div class="timeline-entry-inner">
                        <time datetime="2014-01-10T03:45" class="timeline-time"><span>2010</span></time>
                        <div class="timeline-icon bg-violet"><i class="fa fa-gift"></i></div>
                        <div class="timeline-label bg-violet">
                            <h4 class="timeline-title">Eagle Award</h4>
                            <p>

                                MONDIAL SERVICE reçoit le prix International : Golden Eagle Award Africa 2010 .
                            </p>
                        </div>
                    </div>
                </article>
                <article class="timeline-entry">
                    <div class="timeline-entry-inner">
                        <time datetime="2014-01-10T03:45" class="timeline-time"><span>2009</span></time>
                        <div class="timeline-icon bg-red"><i class="fa fa-plus-circle"></i></div>
                        <div class="timeline-label bg-red">
                            <h4 class="timeline-title">Nouvelle filiale</h4>
                            <p>
                                Création de la filiale d’intérim MONDIAL INTERIM.
                            </p>
                        </div>
                    </div>
                </article>
                <article class="timeline-entry left-aligned">
                    <div class="timeline-entry-inner">
                        <time datetime="2014-01-10T03:45" class="timeline-time"><span>2008</span></time>
                        <div class="timeline-icon bg-blue"><i class="fa fa-plus-circle"></i></div>
                        <div class="timeline-label bg-blue">
                            <h4 class="timeline-title">Nouveau service</h4>
                            <p>
                                MONDIAL SERVICE devient un groupe
                                Création de la filiale de sécurité MONDIAL GARDIENNAGE
                            </p>
                        </div>
                    </div>
                </article>
                <article class="timeline-entry">
                    <div class="timeline-entry-inner">
                        <time datetime="2014-01-10T03:45" class="timeline-time"><span>2005</span></time>
                        <div class="timeline-icon bg-violet"><i class="fa fa-plus-circle"></i></div>
                        <div class="timeline-label bg-violet">
                            <h4 class="timeline-title">Nouvelle agence</h4>
                            <p>
                                Ouverture d’une agence à Casablanca
                            </p>
                        </div>
                    </div>
                </article>
                <article class="timeline-entry left-aligned">
                    <div class="timeline-entry-inner">
                        <time datetime="2014-01-10T03:45" class="timeline-time"><span>2001</span></time>
                        <div class="timeline-icon bg-green"><i class="fa fa-plus-circle"></i></div>
                        <div class="timeline-label bg-green">
                            <h4 class="timeline-title">Nouveau service</h4>
                            <p>Début de l’activité de gardiennage</p>
                        </div>
                    </div>
                </article>
                <article class="timeline-entry">
                    <div class="timeline-entry-inner">
                        <time datetime="2014-01-09T13:22" class="timeline-time"><span>2000</span></time>
                        <div class="timeline-icon bg-orange"><i class="fa fa-paper-plane"></i></div>
                        <div class="timeline-label bg-orange">
                            <h4 class="timeline-title">Création</h4>
                            <p>
                                Création de la société Mondial Service
                                Démarrage de l’activité de nettoyage et d’hygiène
                            </p>
                        </div>
                    </div>
                    <div class="timeline-entry-inner first-entry-inner">
                        <div style="-webkit-transform: rotate(-90deg); -moz-transform: rotate(-90deg);"
                            class="timeline-icon">
                            <i class="fa fa-plus"></i>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
    {{-- start section contact --}}
    <section class="section-contact section">
        <div class="container">
            <h3 class="text-center mb-5">contacter nous</h3>
            <div class="row d-flex align-items-center">
                {{-- start col --}}
                <div class="col-md-6 order-2 order-md-2">
                    @if (session('msgSuccess') != '')
                        <p class="alert alert-success text-capitalize d-flex align-items-center mb-4">
                            <i class="fa fa-thumbs-o-up fa-2x mr-2"></i>{{ session('msgSuccess') }}
                        </p>
                    @endif

                    {!! Form::open(['route' => 'frontend.sendMail']) !!}
                    <div class="row">
                        {{-- name --}}
                        <div class="col-12">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <div class="option">
                                    {!! Form::label('name', 'Nom', ['class' => 'form-label']) !!}
                                    <span class="star text-danger">*</span>
                                </div>

                                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'votre nom']) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- phone --}}
                        <div class="col-12">
                            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                <div class="option">
                                    {!! Form::label('phone', 'Tél', ['class' => 'form-label']) !!}
                                    <span class="star text-danger">*</span>
                                </div>

                                {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'votre numéro de téléphone']) !!}
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- email --}}
                        <div class="col-12">
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <div class="option">
                                    {!! Form::label('email', 'E-mail', ['class' => 'form-label']) !!}
                                    <span class="star text-danger">*</span>
                                </div>

                                {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'votre adresse email']) !!}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- subject --}}
                        <div class="col-12">
                            <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
                                <div class="option">
                                    {!! Form::label('subject', 'Sujet', ['class' => 'form-label']) !!}
                                    <span class="star text-danger">*</span>
                                </div>

                                {!! Form::text('subject', old('subject'), ['class' => 'form-control', 'placeholder' => 'sujet']) !!}
                                @if ($errors->has('subject'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- msg --}}
                        <div class="col-12">
                            <div class="form-group {{ $errors->has('msg') ? 'has-error' : '' }}">
                                <div class="option">
                                    {!! Form::label('msg', 'Message', ['class' => 'form-label']) !!}
                                    <span class="star text-danger">*</span>
                                </div>

                                {!! Form::textarea('msg', old('msg'), ['class' => 'form-control', 'placeholder' => 'votre Message']) !!}
                                @if ($errors->has('msg'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('msg') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-flat btn-block"><i
                                        class="fa fa-send"></i>
                                    Envoyer
                                </button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                {{-- start col --}}
                <div class="col-md-6 order-1 order-md-1 mb-4 mb-md-0">
                    <div class="map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3325.79480073901!2d-7.585800584453455!3d33.53272035237477!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda632ee63dcf59f%3A0xf691ea2e73384311!2sMondial%20Gardiennage!5e0!3m2!1sen!2sma!4v1664388198191!5m2!1sen!2sma"
                            width="100%" height="600px" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- start section footer --}}
    <section class="section-footer bg-white py-4">
        <div class="container">
            <p class="text-black text-center mb-0">Tous les droits sont réservés {{ env('APP_NAME') }}
                {{ date('Y') }}
            </p>
        </div>
    </section>

    {{-- start slide up btn --}}
    <div class="slide-up">
        <div class="slide">
            <i class="fa fa-arrow-up"></i>
        </div>
    </div>
@endsection

@push('js')
    @if ($errors->any() or session('msgSuccess') != '')
        <script>
            $('html,body').animate({
                scrollTop: $('form').offset().top - ($("nav").outerHeight() + 30)
            })
        </script>
    @endif
@endpush
