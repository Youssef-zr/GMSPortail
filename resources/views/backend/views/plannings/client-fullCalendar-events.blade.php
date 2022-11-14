@extends('backend.layouts.master')

@push('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.css" /> --}}

    <style>
        .fc-scrollgrid-sync-inner a {
            color: #222
        }

        table.fc-col-header thead tr {
            background: #33475a !important;
            color: #fff !important;
        }

        table thead tr .fc-scrollgrid-sync-inner a {
            color: inherit
        }

        table thead tr {
            background: #fff !important;
            color: #111 !important;
        }

        .fc-day-header {
            color: #111 !important
        }
    </style>
@endpush

@section('braidcrump')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fa fa-calendar"></i> {{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ adminurl('/') }}"><i class="fa fa-dashboard"></i> TABLEAU DE
                                BORD</a></li>
                        <li class="breadcrumb-item active"><i class="fa fa-calendar"></i> {{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection

@section('content')
    <div class="box text-capitalize px-3">
        <div class="box-body">
            <!-- row -->
            <div class="row">
                <div class="col-xl-12">
                    <div class="card card-primary mg-b-20">
                        <div class="card-body">
                            <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div id="calendar"></div>
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
    <script src="https://momentjs.com/downloads/moment.min.js" type="text/javascript"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.4.0/dist/locale/fr.js"></script> --}}
    {{-- <script>
        $(document).ready(function() {
            var date = new Date();
            var d = date.getDate();
            var m = date.getMonth();
            var y = date.getFullYear();

            var cal = $('#calendar');

            var calendar = cal.fullCalendar({
                editable: false,
                selectable: false,
                selectHelper: true,
                droppable: false,
                weekends: true,
                lang: "fr",
                header: {
                    left: 'prev,today,next',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                // events: '/dashboard/planningsJson',
                events: [{
                    title: "My repeating event",
                    date: '2022-09-12', // a start time (10am in this example)
                    hasEnd: 
                    // end: '', // a start time (10am in this example) 
                    // end: '14:00', // an end time (2pm in this example) 
                    // dow: [1, 4] // Repeat monday and thursday }]
                    allDayDefault: true,
                    allDay: true,
                }],
                // customButtons: {
                //     prev: {
                //         text: 'Prev',
                //         click: function() {
                //             alert('prev');
                //             console.log($event);
                //         }
                //     },
                //     next: {
                //         text: 'Next',
                //         click: function($event) {
                //             console.log($event);
                //         }
                //     },
                // },

            });
        });
    </script> --}}

    <script src="https://cdn.jsdelivr.net/npm/rrule@2.7.1/dist/es5/rrule.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.2/locales-all.js"></script>
    <script>
        $(() => {

            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                themeSystem: 'bootstrap',
                headerToolbar: {
                    lang: "fr",
                    center: "title",
                    left: "",
                },
                firstDay: 1,
                locale: "fr",
                events: '/dashboard/planningsJsonByClient/{{ $id_client }}',
            });
            calendar.render();
        });
    </script>
@endpush
