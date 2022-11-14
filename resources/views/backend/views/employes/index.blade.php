@extends('backend.layouts.master')

@push('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" />

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

        #example_filter {
            margin-bottom: 20px
        }
    </style>
@endpush

@section('braidcrump')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fa fa-users"></i> {{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ adminurl('employes') }}"><i class="fa fa-users"></i>
                                employés</a></li>
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
            @can('ajouter_employé')
                <a href="{{ adminUrl('employes/create') }}" class="btn btn-primary btn-sm add"> <i class="fa fa-plus"></i>
                    Ajouter Nouveau</a>
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
                                    {{-- serach employe for spisific client --}}
                                    <div class="col-sm-6 col-md-4 mx-auto mb-2" id="clientSearch">
                                        {!! Form::open(['route' => 'employes.client.search', 'method' => 'get']) !!}
                                        <div class="input-group d-flex">
                                            {!! Form::select('client', $clients, request()->get('client'), [
                                                'class' => 'form-control',
                                                'placeholder' => 'nom du client',
                                                'required' => 'required',
                                            ]) !!}
                                            <div class="input-group-prepend">
                                                <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="table-responsive">
                                            <table id="example" class="stripe row-border order-column" style="width:100%">
                                                <thead>
                                                    <tr role="row">
                                                        <th> client </th>
                                                        <th> site </th>
                                                        <th> matricule </th>
                                                        <th> nom </th>
                                                        <th> prenom </th>
                                                        <th> cin </th>
                                                        <th> cnss </th>
                                                        <th> date d\'affectation </th>
                                                        <th> actions </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($employes as $employe)
                                                        <tr>
                                                            <td>
                                                                @if ($employe->client != null)
                                                                    <a href="{{ adminUrl('clients/' . $employe->client->id . '/edit') }}"
                                                                        class="badge bg-primary">{{ $employe->client->raison_sociale }}</a>
                                                                @else
                                                                    --
                                                                @endif
                                                            </td>
                                                            <td><a href="{{ adminUrl('sites/' . $employe->site->id . '/edit') }}"
                                                                    class="badge bg-primary">{{ $employe->site->libelle }}</a>
                                                            </td>
                                                            <td>{{ $employe->matricule }}</td>
                                                            <td>{{ $employe->nom }}</td>
                                                            <td>{{ $employe->prenom }}</td>
                                                            <td>{{ $employe->cin }}</td>
                                                            <td>{{ $employe->cnss }}</td>
                                                            <td>{{ date_format_type1($employe->created_at) }}</td>
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
                                                                        @can('editer_employé')
                                                                            <label class="dropdown-item">
                                                                                <a href="{{ adminUrl('employes/' . $employe->id) . '/edit' }}"
                                                                                    class="btn bg-warning btn-block btn-flat text-left"
                                                                                    title='Éditer' data-toggle="tooltip"><i
                                                                                        class="fa fa-edit"></i> Éditer</a>
                                                                            </label>
                                                                        @endcan
                                                                        @can('supprimer_employé')
                                                                            <label class="dropdown-item">
                                                                                <a href="#"
                                                                                    class="btn btn-danger bg-maroon btn-block btn-flat text-left delete"
                                                                                    data-id="{{ $employe->id }}"
                                                                                    title='Supprimer' data-toggle="tooltip"><i
                                                                                        class="fa fa-trash"></i> Supprimer</a>
                                                                            </label>
                                                                        @endcan
                                                                    </div>
                                                                </div>
                                                            </td>
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

    <!-- The Modal Remove Castumer -->
    @can('supprimer_employé')
        <div class="modal text-right" id="myModal" style="overflow: hidden">
            <div class="d-flex align-items-center justify-content-center h-100">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Supprimer l'employé ?</h4>
                            <button type="button" class="close hide-modal"><i class="fa fa-times-circle"></i></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <h3 class="mb2 text-center" style="color:#f39c12"><i class="fa fa-exclamation-triangle fa-3x"></i>
                            </h3>
                            <p class="text-center">
                                Voulez-vous supprimer cet employé des enregistrements ?
                            </p>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer" style="text-align: center !important">
                            <form action="" data-url="{{ adminUrl('employes') }}" method="post" style="display: none"
                                id="form-delete">
                                @csrf
                                @method('delete')
                            </form>
                            <button type="button" class="btn btn-success btn-confirm btn-sm">
                                <i class="fa fa-send"></i>
                                Confirmer
                            </button>
                            <button type="button" class="btn btn-danger bg-maroon hide-modal btn-sm">
                                <i class="fa fa-times"></i>
                                Annuler
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/b-2.1.1/b-html5-2.1.1/datatables.min.js"></script>

    <script>
        $(document).ready(function() {

            let $table = $('#example').DataTable({
                direction: "rtl",
                "order": [
                    [7, 'desc']
                ],
                "aLengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "columnDefs": [{
                    "width": "160px",
                    "targets": 7,
                }, ],
                // dom: 'Bfrtip',
                buttons: [{
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    'colvis'
                ],
                "language": {
                    "url": "https://cdn.datatables.net/plug-ins/1.12.1/i18n/fr-FR.json"
                },
            });

            // change style of buttons excel and pdf
            setTimeout(() => {
                $table.buttons().container().insertBefore('#example_filter');

                $('.buttons-excel').toggleClass('btn-secondary btn-success').html(
                    '<i class="fa fa-file-excel-o"></i> Excel');
                $('.buttons-pdf').toggleClass('btn-secondary btn-warning').html(
                    '<i class="fa fa-file-pdf-o"></i> Pdf');
                $('.buttons-copy').toggleClass('btn-secondary btn-primary').html(
                    '<i class="fa fa-scissors"></i> copier');
                $('#example_length').css({
                    'display': 'block',
                    'margin-right': "20px"
                })
            }, 700);

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
