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
                        <li class="breadcrumb-item"><a href="{{ adminurl('/') }}"><i class="fa fa-dashboard"></i> TABLEAU DE
                                BORD</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-globe"></i> {{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
    <div class="box text-capitalize px-3">

        <div class="box-header mb-3 text-right">
            @can('ajouter_ticket')
                <a href="{{ adminUrl('tickets/create') }}" class="btn btn-primary btn-sm add">
                    <i class="fa fa-plus"></i>
                    ajouter nouveau
                </a>
            @endcan
        </div>
        <div class="box-body">
            <!-- row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-primary mg-b-20">
                        <div class="card-body">
                            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table id="example" class="stripe row-border order-column" style="width:100%">
                                                <thead>
                                                    <tr role="row">
                                                        @if (in_array(auth()->user()->roles_name[0], ['admin', 'developpeur']))
                                                            <th>client</th>
                                                        @endif
                                                        <th> service </th>
                                                        <th> objet </th>
                                                        <th> etat </th>
                                                        <th> dernière réponse </th>
                                                        <th> dernière mise a jour </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($tickets as $ticket)
                                                        <tr>
                                                            @if (in_array(auth()->user()->roles_name[0], ['admin', 'developpeur']))
                                                                <td>{{ $ticket->client->raison_sociale }} </td>
                                                            @endif
                                                            <td>{{ $ticket->service->libelle }}</td>
                                                            <td>
                                                                <a href="{{ route('tickets.show', $ticket->id) }}">
                                                                    <span class="d-block text-dark">#
                                                                        {{ $ticket->id }}
                                                                    </span>
                                                                    {{ $ticket->objet_ticket }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <label
                                                                    class="badge badge-{{ ticket_status()[$ticket->statut] }}">{{ $ticket->statut }}
                                                                </label>
                                                            </td>
                                                            <td>
                                                                <label class="badge badge-primary">
                                                                    {{ $ticket->lastReply()['from'] }}
                                                                </label>
                                                            </td>
                                                            <td>{{ $ticket->lastReply()['lastUpdateDate'] }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- row closed -->
            </div>
            <!-- Container closed -->
        </div>
    </div>
    {{-- modal delete record --}}
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#example').DataTable({
                direction: "ltr",
                "order": [
                    [0, 'desc']
                ],
                "aLengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/fr-FR.json"
                },
                "columnDefs": [{
                        "width": "200px",
                        "targets": 0
                    },
                    {
                        "width": "200px",
                        "targets": $('#example').find('thead th').length - 1
                    }
                ],
            });

        });
    </script>
@endpush
