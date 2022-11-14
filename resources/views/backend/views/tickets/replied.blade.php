@extends('backend.layouts.master')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">

    <style>
        div.dataTables_wrapper {
            direction: ltr;
        }

        /* Ensure that the demo table scrolls */
        th,
        td {
            white-space: nowrap;
        }

        div.dataTables_wrapper {
            margin: 15px auto 0;
        }

        .hidden {
            display: none
        }
    </style>
@endpush

@section('braidcrump')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fa fa-ticket"></i> tickets</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ adminurl('sites') }}"><i class="fa fa-ticket"></i>
                                tickets</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-history"></i> {{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
    <div class="row px-3">
        <div class="col-12 col-md-9">
            <div class="box text-capitalize">
                <div class="box-body">
                    <!-- row -->
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card card-primary mg-b-20">
                                <div class="card-header">
                                    <h4 class="mb-0"><i class="fa fa-plus-circle"></i> {{ $title }} </h4>
                                </div>
                                <div class="card-body">
                                    {!! Form::open(['route' => 'tickets.replied.store', 'method' => 'POST', 'files' => true]) !!}
                                    @include('backend.views.tickets.form_replied')
                                    {!! Form::close() !!}

                                    @if (auth()->user()->roles_name[0] == 'admin')
                                        <form action="{{ route('tickets.closeTicket') }}" method="post"
                                            id="closeTicketForm">
                                            @csrf
                                            @method('post')
                                            {!! Form::hidden('ticket', $ticket->id) !!}
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- row closed -->
                    </div>
                    <!-- Container closed -->
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-dark card-information">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fa fa-chevron-right"></i> Information de la demande
                    </h5>
                </div>
                <div class="card-body">
                    {{-- list items --}}
                    <ul class="list-unstyled list-items">
                        {{-- list item --}}
                        <li class="list-item">
                            <h6 class="item-title"><b> <i class="fa fa-user-o"></i> Demandeur</b></h6>
                            <p class="item-content">
                                {{ $ticket->client->user->name }}
                                <label class="badge badge-success">client</label>
                            </p>
                        </li>
                        {{-- list item --}}
                        <li class="list-item">
                            <h6 class="item-title"><b> <i class="fa fa-cog"></i> Service</b></h6>
                            <p class="item-content">
                                {{ $ticket->service->libelle }}
                            </p>
                        </li>
                        {{-- list item --}}
                        <li class="list-item">
                            <h6 class="item-title"><b><i class="fa fa-calendar"></i> créé à</b></h6>
                            <p class="item-content">
                                {{ $ticket->created_at->format('Y-m-d H:i') }}
                            </p>
                        </li>
                        {{-- list item --}}
                        <li class="list-item">
                            <h6 class="item-title"><b><i class="fa fa-calendar"></i> Dernière mise a jour </b></h6>
                            <p class="item-content">
                                {{ $ticket->lastReply()['lastUpdateDate'] }}
                            </p>
                        </li>
                        {{-- list item --}}
                        <li class="list-item">
                            <h6 class="item-title"><b><i class="fa fa-star-o"></i> Etat Priorité</b></h6>
                            <label class="badge bg-{{ ticket_status()[$ticket->statut] }}">
                                {{ $ticket->statut }}
                            </label>
                        </li>
                        {{-- list item --}}
                        <li class="list-item">
                            <h6 class="item-title">
                                <b><i class="fa fa-comments-o"></i> Nombre de commentaires</b>
                            </h6>
                            @php
                                $counter = count($replies);
                            @endphp
                            @if ($counter > 0)
                                <label class="badge bg-success">
                                    {{ $counter }}
                                </label>
                            @else
                                <label class="badge bg-danger">
                                    0
                                </label>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- start replies --}}
    <div class="ticket-replies px-2 mt-5">
        <div class="row">
            <div class="col-12 col-md-9">
                @foreach ($replies as $reply)
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                @if ($reply->client != null)
                                    <h5 class="mb-0 bg-secondary">
                                        <div class="reply">
                                            <span class="reply-icon">
                                                <i class="fa fa-user-o mr-1"></i>
                                            </span>
                                            <span class="reply-name text-capitalize">
                                                {{ $reply->client->user->name }}
                                            </span>
                                            <label class="badge badge-primary ml-2 mt-2 mb-0">
                                                {{ $reply->client->user->roles_name[0] }}
                                            </label>
                                        </div>
                                        <label class="reply-perso">
                                            <span class="raison_sociale">
                                                {{ $reply->client->raison_sociale }}
                                            </span>
                                            <a href="mailTo:{{ $reply->client->user->email }}" class="email text-white">
                                                {{ $reply->client->user->email }}
                                            </a>
                                        </label>
                                    </h5>
                                @else
                                    <h5 class="bg-warning">
                                        <div class="reply">
                                            <span class="reply-icon">
                                                <i class="fa fa-user-o mr-1"></i>
                                            </span>
                                            <span class="reply-name text-capitalize text-dark">
                                                {{ $reply->admin->name }}
                                            </span>
                                            <label class="badge badge-success ml-1 mt-2 mb-0">
                                                {{ $reply->admin->roles_name[0] }}
                                            </label>
                                        </div>
                                        <label class="reply-perso">
                                            <a href="mailTo:{{ $reply->admin->email }}" class="email">
                                                {{ $reply->admin->email }}
                                            </a>
                                        </label>
                                    </h5>
                                @endif
                                <div class="created_at">
                                    <p>
                                        <i class="fa fa-clock-o"></i> {{ $reply->created_at->format('Y-m-d H:i') }}
                                    </p>
                                </div>
                            </div>
                            <div class="card-body">
                                {!! $reply->description !!}
                            </div>

                            @if ($reply->files->count() > 0)
                                <div class="card-footer">
                                    <ul class="list-unstyled mb-0 reply-files d-flex justify-content-start">
                                        @foreach ($reply->files as $file)
                                            <li class="reply-file mr-2">
                                                <a href="{{ url($file->file_path) }}" data-toggle="tooltip"
                                                    data-targe="tooltip" title="{{ $file->original_name }}">
                                                    <i class="fa fa-download"></i>
                                                    {{ \Str::limit($file->original_name, 10, ' (...)') }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@push('css')
    <style>
        .card-information.card .card-body {
            padding-left: 0 !important;
            margin-left: 0;
            padding-right: 0;
        }
        .card-information .card-body {
            padding-top: 5px;
            padding-bottom: 0;
        }
        .card-information .list-items {
            margin-left: 0
        }
        .card-information .list-items .list-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0 10px;
            padding-left: 20px
        }
        .card-information .list-items .list-item .item-title i.fa {
            margin-right: 5px
        }
        .card-information .list-items .list-item:not(:last-of-type) label {
            margin-left: 10px
        }
        .card-information .list-items .list-item:not(:nth-child(1)) label {
            margin-left: 25px
        }
        .card-information .list-items .list-item .item-content {
            margin-left: 23px
        }
        .card-information .list-items .list-item:last-of-type {
            border-bottom: none;
            padding-bottom: 0
        }
        .card-information .list-items .list-item p {
            margin-bottom: 0
        }
        /* replies */
        .ticket-replies .card-header {
            padding: 0;
            overflow: hidden;
            position: relative;
        }
        .ticket-replies .card-header h5 {
            padding: 7px 15px;
            margin-bottom: 0;
        }
        .ticket-replies .card-header .created_at {
            position: absolute;
            right: 15px;
            top: 10px;
        }
        .ticket-replies .bg-secondary+.created_at {
            color: #fff
        }
        .reply .reply-icon {
            font-size: 22px;
        }
        .reply .reply-name {
            font-size: 16px;
            text-transform: capitalize
        }
        .reply-perso {
            margin-left: 24px;
        }
        .reply-perso .raison_sociale {
            margin: 5px 0;
            font-size: 15px;
            display: block;
            font-weight: 600;
        }
        .reply-perso .email {
            font-size: 17px;
            display: block;
            text-transform: capitalize;
            color: #222
        }
    </style>
@endpush
