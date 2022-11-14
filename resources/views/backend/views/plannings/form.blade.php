<div class="row">
    <div class="col-12 col-md-6 col-lg-4 ">
        <div class="form-group {{ $errors->has('IDClient') ? 'has-error' : '' }}">
            <div class="option">
                <label for="IDClient" class="form-label">Client</label>
                <span class="star text-danger">*</span>
            </div>
            {!! Form::select('IDClient', $clients, old('IDCLient'), [
                'class' => 'form-control',
                'placeholder' => 'le nom du client',
            ]) !!}
            @if ($errors->has('IDClient'))
                <span class="help-block">
                    <strong>{{ $errors->first('IDClient') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
{{-- end row --}}

<div class="row">
    {{-- title field --}}
    <div class="col-12 col-md-4">
        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
            <div class="option">
                <label class="form-label">Titre</label>
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('title', old('title'), [
                'placeholder' => 'title',
                'class' => 'form-control',
                'placeholder' => 'Le titre de l\'événement',
            ]) !!}
            @if ($errors->has('title'))
                <span class="help-block">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {{-- status field --}}
    {{-- <div class="col-12 col-md-4">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            <label class="form-label">Statut</label>
            {!! Form::select('status', event_status(), old('status'), ['class' => 'form-control']) !!}
            @if ($errors->has('status'))
                <span class="help-block">
                    <strong>{{ $errors->first('status') }}</strong>
                </span>
            @endif
        </div>
    </div> --}}

    {{-- color field --}}
    <div class="col-12 col-md-2 col-lg-2 d-flex align-items-center">
        <div class="form-group {{ $errors->has('color') ? 'has-error' : '' }}">
            <label for="color" class="form-label">Couleur</label>
            <input type="color" name="color" id="color" class="form-control">
            @if ($errors->has('color'))
                <span class="help-block">
                    <strong>{{ $errors->first('color') }}</strong>
                </span>
            @endif
        </div>
        @if (isset($planning))
            <span class="color-box" style="background:{{ $planning->color }}"></span>
        @endif
    </div>
</div>
{{-- end row --}}

<div class="row">
    <div class="col-md-6 col-lg-4">
        <div class="form-group">
            <label for="periodicity" class="form-label">Périodicité</label>
            {!! Form::select('periodicity', periodicites(), old('periodicity'), ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="col-md-6 col-lg-4">
        <div class="row">
            {{-- start date field --}}
            <div class="col-6">
                <div class="form-group {{ $errors->has('start_date') ? 'has-error' : '' }}">
                    <div class="option">
                        <label for="start_date" class="form-label">Depart</label>
                        <span class="star text-danger">*</span>
                    </div>
                    {!! Form::date('start_date', old('start_date'), ['placeholder' => 'depart', 'class' => 'form-control']) !!}
                    @if ($errors->has('start_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('start_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            {{-- end date field --}}
            <div class="col-6 d-none" id="inpDateEnd">
                <div class="form-group {{ $errors->has('end_date') ? 'has-error' : '' }}">
                    <label for="end_date" class="form-label">Fin</label>
                    {!! Form::date('end_date', old('end_date'), ['placeholder' => 'Fin', 'class' => 'form-control']) !!}
                    @if ($errors->has('end_date'))
                        <span class="help-block">
                            <strong>{{ $errors->first('end_date') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end row --}}

<div class="row">
    <div class="col-md-6 col-lg-4 d-none" id="repetition">
        {{-- repeate field --}}
        <div class="form-group {{ $errors->has('repeats') ? 'has-error' : '' }}">
            <label class="form-label">Répète?</label>
            {!! Form::select('repeats', yes_no(), old('repeats'), ['class' => 'reapeat form-control']) !!}
            @if ($errors->has('repeats'))
                <span class="help-block">
                    <strong>{{ $errors->first('repeats') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
{{-- end row --}}

<div class="row">
    <div class="col-md-6 col-lg-4">
        <div class="form-group">
            <div id="freq" style="display: none;">
                {{-- repeat by spesific form --}}
                <label>Répéter tou(te)s les</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <i class="input-group-text">Chaque:&nbsp; </i>
                    </div>
                    {!! Form::input('number', 'freq', old('number'), [
                        'class' => 'freq-a form-control',
                        'style' => 'width:65px',
                    ]) !!}

                    {!! Form::select('freq_term', repeat_every(), old('freq_term'), [
                        'class' => 'freq-b form-control',
                        'style' => 'width:150px !important',
                    ]) !!}
                </div>
                {{-- repeat by selected days --}}
                <div class="days mt-3">
                    <label>Répéter le</label>
                    <ul class="list-unstyled d-flex justify-content-start align-items-center">
                        <li class="d-flex justify-content-start align-items-center ml-3">
                            {!! Form::checkbox('days[0]', 0, false, ['class' => 'form-controll', 'id' => 'L']) !!}
                            <label class="ml-1 c-pointer mt-2" data-toggle="tooltip" title="lundi"
                                for="L">L</label>
                        </li>
                        <li class="d-flex justify-content-start align-items-center ml-3">
                            {!! Form::checkbox('days[1]', 1, false, ['class' => 'form-controll', 'id' => 'Ma']) !!}
                            <label class="ml-1 c-pointer mt-2" data-toggle="tooltip" title="mardi"
                                for="Ma">M</label>
                        </li>
                        <li class="d-flex justify-content-start align-items-center ml-3">
                            {!! Form::checkbox('days[2]', 2, false, ['class' => 'form-controll', 'id' => 'Me']) !!}
                            <label class="ml-1 c-pointer mt-2" data-toggle="tooltip" title="mercred"
                                for="Me">M</label>
                        </li>
                        <li class="d-flex justify-content-start align-items-center ml-3">
                            {!! Form::checkbox('days[3]', 3, false, ['class' => 'form-controll', 'id' => 'J']) !!}
                            <label class="ml-1 c-pointer mt-2" data-toggle="tooltip" title="jeudi"
                                for="J">J</label>
                        </li>
                        <li class="d-flex justify-content-start align-items-center ml-3">
                            {!! Form::checkbox('days[4]', 4, false, ['class' => 'form-controll', 'id' => 'V']) !!}
                            <label class="ml-1 c-pointer mt-2" data-toggle="tooltip" title="vendredi"for="V">
                                V
                            </label>
                        </li>
                        <li class="d-flex justify-content-start align-items-center ml-3">
                            {!! Form::checkbox('days[5]', 5, false, ['class' => 'form-controll', 'id' => 'S']) !!}
                            <label class="ml-1 c-pointer mt-2" data-toggle="tooltip" title="samedi"
                                for="S">S</label>
                        </li>
                        <li class="d-flex justify-content-start align-items-center ml-3">
                            {!! Form::checkbox('days[6]', 6, false, ['class' => 'form-controll', 'id' => 'D']) !!}
                            <label class="ml-1 c-pointer mt-2" data-toggle="tooltip" title="dimanche" for="D">
                                D
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- end row --}}

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <label for="notes" class="form-label">Remarques</label>
            {!! Form::textarea('notes', old('notes'), [
                'class' => 'form-control',
                'placeholder' => 'créez votre note ici',
            ]) !!}
        </div>
    </div>
</div>
{{-- end row --}}

<div class="row">
    <div class="col-12">
        <div class="form-group">
            <button class="btn {{ isset($planning) ? 'bg-warning' : 'bg-primary' }}">
                <i class="fa fa-floppy-o float"></i>
                Enregistrer
            </button>
        </div>
        {{-- End row --}}
    </div>
</div>
{{-- end row --}}


@push('js')
    <script>
        $(() => {

            $('select[name="repeats"]').change(function() {
                if ($(this).val() == 1) {

                    $('#freq').fadeIn(500);
                    $('input[name="freq"]').val(1);
                } else {

                    $('#freq').fadeOut(500);
                    $('input[name="freq"]').val("");
                }
            });

            $('select[name="periodicity"]').on('change', function() {

                if ($(this).val() == "once") {

                    $('#inpDateEnd').addClass("d-none");
                } else if ($(this).val() == "personalized") {

                    $('#repetition').removeClass('d-none');
                    $('#inpDateEnd').removeClass('d-none');
                } else {

                    $('#repetition').addClass('d-none');
                    $('#inpDateEnd').removeClass('d-none');
                }
            });

            console.log($('select[name="freq_term"]'));

        })
    </script>
@endpush

@push('css')
    <style>
        .c-pointer {
            cursor: pointer;
        }

        .color-box {
            margin-top: 10px;
            display: inline-block;
            width: 30px;
            height: 30px;
            margin-left: 10px;
        }

        .reapeat + .select2 {
            width: 100% !important
        }

        .freq-a {
            width: calc(100% - 150px)
        }
    </style>
@endpush
