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
                    <h1><i class="fa fa-globe"></i> sites</h1>
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
            @can('ajouter_site')
                <a href="{{ adminUrl('sites/create') }}" class="btn btn-primary btn-sm add">
                    <i class="fa fa-plus"></i>
                    nouveau
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
                                                        <th> # </th>
                                                        <th> site </th>
                                                        <th> client </th>
                                                        @if (in_array(strtolower(auth()->user()->roles_name['0']), ['admin', 'developpeur']))
                                                            <th> actions </th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($sites as $site)
                                                        <tr>
                                                            <td>{{ $site->id }}</td>
                                                            <td>{{ $site->libelle }}</td>
                                                            <td><label class="badge badge-primary">{{ $site->client->raison_sociale }}</label></td>
                                                            @if (in_array(strtolower(auth()->user()->roles_name['0']), ['admin', 'developpeur']))
                                                                <td>
                                                                    <div class="btn-group">
                                                                        <button type="button"
                                                                            class="btn btn-default btn-flat">Actions</button>
                                                                        <button type="button"
                                                                            class="btn btn-default btn-flat dropdown-toggle dropdown-icon"
                                                                            data-toggle="dropdown" aria-expanded="false">
                                                                            <span class="sr-only">Menu</span>
                                                                        </button>
                                                                        <div class="dropdown-menu" role="menu"
                                                                            style="">
                                                                            @can('editer_site')
                                                                                <label class="dropdown-item">
                                                                                    <a href="{{ adminUrl('sites/' . $site->id) . '/edit' }}"
                                                                                        class="btn bg-warning btn-block btn-flat text-left"
                                                                                        title='Éditer' data-toggle="tooltip">
                                                                                        <i class="fa fa-edit"></i>
                                                                                        Éditer
                                                                                    </a>
                                                                                </label>
                                                                            @endcan
                                                                            @can('supprimer_site')
                                                                                <label class="dropdown-item">
                                                                                    <a href="#"
                                                                                        class="btn btn-danger bg-maroon btn-block btn-flat text-left delete"
                                                                                        data-id="{{ $site->id }}"
                                                                                        title='Supprimer' data-toggle="tooltip">
                                                                                        <i class="fa fa-trash"></i>
                                                                                        Supprimer
                                                                                    </a>
                                                                                </label>
                                                                            @endcan
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            @endif
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

    <!-- The Modal Remove site -->
    @can('supprimer_site')
        <div class="modal text-right" id="myModal" style="overflow: hidden">
            <div class="d-flex align-items-center justify-content-center h-100">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Supprimer la ville ?</h4>
                            <button type="button" class="close hide-modal"><i class="fa fa-times-circle"></i></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <h3 class="mb2 text-center" style="color:#f39c12"><i class="fa fa-exclamation-triangle fa-3x"></i>
                            </h3>
                            <p class="text-center">
                                Voulez-vous supprimer cette ville des enregistrements ?
                            </p>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer" style="text-align: center !important">
                            <form action="" data-url="{{ adminUrl('sites') }}" method="post" style="display: none"
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
    @endcan
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    {{-- sorting numbers in datatables --}}
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
                        "width": "60px",
                        "targets": 0
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
        });
    </script>
@endpush
