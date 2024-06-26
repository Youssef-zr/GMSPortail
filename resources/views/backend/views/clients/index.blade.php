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
                    <h1><i class="fa fa-users"></i> Clients</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ adminurl('/') }}">
                                <i class="fa fa-dashboard"></i> TABLEAU DE BORD
                            </a>
                        </li>
                        <li class="breadcrumb-item active"><i class="fa fa-users"></i> {{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
    <div class="box text-capitalize px-3">

        <div class="box-header mb-3 text-right">
            @can('ajouter_client')
                <a href="{{ adminUrl('clients/create') }}" class="btn btn-primary btn-sm add" data-toggle="tooltip"
                    title=" Nouveau client">
                    <i class="fa fa-plus"></i>
                    client
                </a>
            @endcan
            @can('noveau_utilisateur_client')
                <a href="{{ adminUrl('clients/users/create') }}" class="btn btn-primary btn-sm add" data-toggle="tooltip"
                    title=" Nouveau utilisateur"> <i class="fa fa-plus"></i> Utilisateur</a>
            @endcan
        </div>
        <div class="box-body">
            <!-- row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-primary mg-b-20">
                        <div class="card-body">
                            {{-- button sync with omag --}}
                            <div class="sync-section float-right d-flex align-items-center">
                                <div class="mr-4">
                                    <div class="icheck-success d-inline">
                                        <input type="checkbox" id="check-all">
                                        <label for="check-all">sélectionner tout</label>
                                    </div>
                                </div>

                                <button class="btn btn-success" id="sync_omag"
                                    data-toggle="tooltip"title="synchroniser avec omag">
                                    <i class="fa fa-refresh"></i>
                                    synchroniser
                                </button>
                                <button class="btn btn-primary ml-2" id="get_clients_sync" data-toggle="tooltip">
                                    <i class="fa fa-refresh"></i>
                                    tester api
                                </button>
                                <button class="btn btn-danger ml-2" id="set_clients_sync" data-toggle="tooltip">
                                    <i class="fa fa-refresh"></i>
                                    set clients sites api
                                </button>
                            </div>

                            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            {{-- {!! Form::open(['route' => 'client.sync_client_queue', 'method' => 'post', 'id' => 'sync_form']) !!} --}}
                                            <table id="example" class="stripe row-border order-column" style="width:100%">
                                                <thead>
                                                    <tr role="row">
                                                        <th> # </th>
                                                        <th> raison sociale </th>
                                                        <th> utilisateurs </th>
                                                        <th> employes </th>
                                                        <th> code client omag </th>
                                                        <th> synchroniser </th>
                                                        @can(['ajouter_client', 'supprimer_client'])
                                                            <th> actions </th>
                                                        @endcan
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($clients as $client)
                                                        <tr>
                                                            <td>{{ $client->id }}</td>
                                                            <td class="client-image">
                                                                <label class="badge bg-primary">
                                                                    <a
                                                                        href="{{ adminUrl('clients/' . $client->id . '/edit') }}">
                                                                        {{ $client->raison_sociale }}
                                                                    </a>
                                                                </label>
                                                                <div class="image">
                                                                    <img src="{{ url($client->chemin) }}"
                                                                        alt="{{ $client->raison_sociale }}">
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <a href="{{ adminUrl('clients/' . $client->id . '/users') }}"
                                                                    class="badge {{ $client->users_count > 0 ? 'badge-success' : 'badge-danger' }}"
                                                                    data-toggle="tooltip"
                                                                    title="afficher list des utilisateurs">
                                                                    {{ $client->users_count }}
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('clients.employes.list', $client->id) }}"
                                                                    class="badge {{ $client->employes_count > 0 ? 'badge-success' : 'badge-danger' }}"
                                                                    data-toggle="tooltip"
                                                                    title="afficher list des employes">
                                                                    {{ $client->employes_count }}
                                                                </a>
                                                            </td>
                                                            <td>{{ $client->code_client_omag ?? '---' }}</td>
                                                            <td>
                                                                @if ($client->sync == 1)
                                                                    <label class="badge badge-success">oui</label>
                                                                @else
                                                                    <label class="badge badge-danger">non</label>
                                                                @endif
                                                            </td>
                                                            @can(['ajouter_client', 'supprimer_client'])
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <button type="button"
                                                                            class="btn btn-default btn-flat">Actions</button>
                                                                        <button type="button"
                                                                            class="btn btn-default btn-flat dropdown-toggle dropdown-icon"
                                                                            data-toggle="dropdown" aria-expanded="false">
                                                                            <span class="sr-only">Menu</span>
                                                                        </button>
                                                                        <div class="dropdown-menu" role="menu">
                                                                            @can('afficher_client_utilisateurs')
                                                                                <label class="dropdown-item">
                                                                                    <a href="{{ route('clients.users.list', $client->id) }}"
                                                                                        class="btn bg-primary btn-block btn-flat text-left"
                                                                                        title='afficher list utilisateurs'
                                                                                        data-toggle="tooltip">
                                                                                        <i class="fa fa-eye"></i>
                                                                                        Afficher utilisateurs
                                                                                    </a>
                                                                                </label>
                                                                            @endcan
                                                                            @can('afficher_client_employes')
                                                                                <label class="dropdown-item">
                                                                                    <a href="{{ route('clients.employes.list', $client->id) }}"
                                                                                        class="btn bg-teal btn-block btn-flat text-left"
                                                                                        title='afficher list employes'
                                                                                        data-toggle="tooltip">
                                                                                        <i class="fa fa-eye"></i>
                                                                                        Afficher employes
                                                                                    </a>
                                                                                </label>
                                                                            @endcan
                                                                            @can('editer_client')
                                                                                <label class="dropdown-item">
                                                                                    <a href="{{ adminUrl('clients/' . $client->id) . '/edit' }}"
                                                                                        class="btn bg-warning btn-block btn-flat text-left"
                                                                                        title='Éditer' data-toggle="tooltip">
                                                                                        <i class="fa fa-edit"></i>
                                                                                        Éditer
                                                                                    </a>
                                                                                </label>
                                                                            @endcan
                                                                            @can('supprimer_client')
                                                                                <label class="dropdown-item">
                                                                                    <a href="#"
                                                                                        class="btn btn-danger bg-maroon btn-block btn-flat text-left delete"
                                                                                        data-id="{{ $client->id }}"
                                                                                        title='supprimer' data-toggle="tooltip">
                                                                                        <i class="fa fa-trash"></i>
                                                                                        Supprimer
                                                                                    </a>
                                                                                </label>
                                                                            @endcan
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            @endcan
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            {{-- {!! Form::close() !!} --}}
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

    <!-- The Modal Remove Castumer -->
    {{-- @can('supprimer_client') --}}
    <div class="modal text-right" id="myModal" style="overflow: hidden">
        <div class="d-flex align-items-center justify-content-center h-100">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">supprimer un client ?</h4>
                        <button type="button" class="close hide-modal"><i class="fa fa-times-circle"></i></button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <h3 class="mb2 text-center" style="color:#f39c12"><i
                                class="fa fa-exclamation-triangle fa-3x"></i>
                        </h3>
                        <p class="text-center">
                            Voulez-vous supprimer cette ville des enregistrements ?
                        </p>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer" style="text-align: center !important">
                        <form action="" data-url="{{ adminUrl('clients') }}" method="post" style="display: none"
                            id="form-delete">
                            @csrf
                            @method('delete')
                        </form>
                        <button type="button" class="btn btn-success btn-confirm btn-sm"><i class="fa fa-send"></i>
                            Confirmer</button>
                        <button type="button" class="btn btn-danger bg-maroon hide-modal btn-sm"><i
                                class="fa fa-times"></i> Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @endcan --}}
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.10.15/sorting/numeric-comma.js"></script>
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
                        "width": "90px",
                        "targets": 0,
                        "type": "numeric-comma",
                    },
                    {
                        "width": "160px",
                        "targets": $('#example').find('thead th').length - 1
                    },
                ],
            });
            // hide modal
            $('.hide-modal').click(function() {
                $('#myModal').slideUp(500);
            })
            // delete record
            $('.delete').click(function(e) {
                e.preventDefault();
                $('#myModal').slideDown(500);
                let id = parseInt($(this).data('id')),
                    form = $('#form-delete');
                form.attr('action', form.data('url') + '/' + id);

            });
            // close modal cliking in overlay only
            $('#myModal').on('click', function(e) {
                e.target.id == "myModal" ? $('#myModal').slideUp(500) : 'break';
            });
            // confirm btn submit form 
            $('.btn-confirm').click(function() {
                $('#form-delete').submit();
            })

            // sync with omag 
            // $('#sync_omag').on('click', function() {
            //     $('#sync_form').submit();
            // });

            // get data returned from api
            $("#get_clients_sync").on('click', function() {
                $that = $(this);
                $that.find('i').addClass('fa-spin');
                $.ajax({
                    url: "/api/get_sync_clients_list?token=$2y$10$YnwwmgxjLHh.bcHrNg7QXuNAzOiQQjU3eUFZpDdtkLk4cKvW5xYKC",
                    type: "get",
                    dataType: "json",
                    // data: {
                    //     "action": "loadall",
                    //     "id": id
                    // },
                    success: function(res) {
                        $that.find('i').removeClass('fa-spin');
                        alert('ouvrir la console pour afficher les données retournées');

                        const $returned_data = {
                            "_clients": res
                        };
                        console.log($returned_data)
                    },
                    error: function(err) {
                        console.log("Error:");
                        console.log(err);
                    }
                });
            })
            // set omag data to local db
            $("#set_clients_sync").on('click', function() {

                // $clientsSync = [{
                //             "code_client_omag": "5522",
                //             "sites_list": [{
                //                     "libelle": "new site 1 for client 9"
                //                 },
                //                 {
                //                     "libelle": "new site 2 for client 9"
                //                 }
                //             ]
                //         },
                //         {
                //             "code_client_omag": "933",
                //             "sites_list": [{
                //                     "libelle": "new site 1 for client 5"
                //                 },
                //                 {
                //                     "libelle": "new site 2 for client 5"
                //                 }
                //             ]
                //         },
                //         {
                //             "code_client_omag": "8433",
                //             "sites_list": [{
                //                     "libelle": "new site 1 for client 1"
                //                 },
                //                 {
                //                     "libelle": "new site 2 for client 1"
                //                 }
                //             ]
                //         },
                //         {
                //             "code_client_omag": "4645",
                //             "sites_list": [{
                //                 "libelle": "new site 1 for client 8"
                //             }]
                //         },
                //         {
                //             "code_client_omag": "4903",
                //             "sites_list": [{
                //                 "libelle": "new site 1 for client 4"
                //             }]
                //         },
                //     ],

                $clientsSync = [{
                        "code_client_omag": "1203",
                        "sites_list": [{
                                "libelle": "ATLAS PHARM"
                            },
                            {
                                "libelle": "TECNIMEDE GROUP MAROC"
                            },
                            {
                                "libelle": "EXTRA ATLAS PHARM"
                            },
                            {
                                "libelle": "EXTRA ATLAS PHARM HS "
                            }
                        ]
                    },
                    {
                        "code_client_omag": "1205",
                        "sites_list": [{
                                "libelle": "AIR ARABIA CASA"
                            },
                            {
                                "libelle": "AIR ARABIA RABAT"
                            },
                            {
                                "libelle": "AIR ARABIA NADOR"
                            },
                            {
                                "libelle": "AIR ARABIA NOUACEUR"
                            },
                            {
                                "libelle": "AIR ARABIA TETOUAN"
                            },
                            {
                                "libelle": "AIR ARABIA TANGER"
                            },
                            {
                                "libelle": "AIR ARABIA MARRAKECH"
                            },
                            {
                                "libelle": "AIR ARABIA FES"
                            }
                        ]
                    }
                ];
                $that = $(this);

                $that.find('i').addClass('fa-spin');
                $.ajax({
                    url: "/api/set_sites_clients_omag/" + JSON.stringify($clientsSync) +
                        "?token=$2y$10$YnwwmgxjLHh.bcHrNg7QXuNAzOiQQjU3eUFZpDdtkLk4cKvW5xYKC",
                    type: "get",
                    dataType: "json",
                    // data: {
                    //     "clients": $clientsSync
                    // },
                    success: function(res) {
                        $that.find('i').removeClass('fa-spin');
                        alert('ouvrir la console pour afficher les données retournées');

                        const $returned_data = {
                            "omagClientsSites": res,
                        };
                        console.log($returned_data);
                        // if ($returned_data.status != "") {
                        //     window.location.reload();
                        // }
                    },
                    error: function(err) {
                        console.log("Error:");
                        console.log(err);
                    }
                });
            })

            $('table').on('change', "input[type='checkbox']", function() {
                if ($(this).is(':checked') == false) {
                    $('input#check-all').prop('checked', false)
                }
            });

            $('#check-all').on('change', function() {
                if ($(this).is(':checked')) {
                    $('input[type="checkbox"]').attr('checked', "checked");
                } else {
                    $('input[type="checkbox"]').removeAttr('checked')
                }
            })

        });
    </script>
@endpush

@push('css')
    <style>
        .client-image img {
            width: 80px;
            height: 80px;
            padding: 3px;
            border-radius: 50%;
            background: #fff;
            border: 1px solid #555;
        }

        .client-image {
            position: relative;
        }

        .client-image .image {
            position: absolute;
            top: -5px;
            left: 10px;
            z-index: 5;
            display: none
        }

        tr:hover .client-image .image {
            display: block
        }
    </style>
@endpush
