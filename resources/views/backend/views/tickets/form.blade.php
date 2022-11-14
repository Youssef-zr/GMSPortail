<div class="row">
    {{-- user name field --}}
    <div class="col-12 col-md-4">
        <div class="form-group {{ $errors->has('IDClient') ? 'has-error' : '' }}">
            {!! Form::label('IDClient', 'nom', ['class' => 'form-label']) !!}
            {!! Form::text('IDCLient', $authUser->name, ['class' => 'form-control', 'disabled' => 'disabled']) !!}

            @if ($errors->has('IDClient'))
                <span class="help-block">
                    <strong>{{ $errors->first('IDClient') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {{-- user email field --}}
    <div class="col-12 col-md-4">
        <div class="form-group {{ $errors->has('libelle') ? 'has-error' : '' }}">
            {!! Form::label('libelle', 'Email', ['class' => 'form-label']) !!}
            {!! Form::text('libelle', $authUser->email, ['class' => 'form-control', 'disabled' => 'disabled']) !!}

            @if ($errors->has('libelle'))
                <span class="help-block">
                    <strong>{{ $errors->first('libelle') }}</strong>
                </span>
            @endif
        </div>
    </div>

</div>
{{-- end row --}}

<div class="row">
    {{-- subject field --}}
    <div class="col-12 col-md-8">
        <div class="form-group {{ $errors->has('objet_ticket') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('objet_ticket', 'Titre du ticket', ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('objet_ticket', old('objet_ticket'), [
                'class' => 'form-control',
                'placeholder' => 'Titre du ticket',
            ]) !!}

            @if ($errors->has('objet_ticket'))
                <span class="help-block">
                    <strong>{{ $errors->first('objet_ticket') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
{{-- end row --}}

<div class="row">
    {{-- service field --}}
    <div class="col-12 col-md-6 col-lg-3">
        <div class="form-group {{ $errors->has('IDService') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('IDService', 'Assigner à', ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::select('IDService', $services, old('IDService'), [
                'class' => 'form-control',
                'placeholder' => 'sélectionnez service',
            ]) !!}

            @if ($errors->has('IDService'))
                <span class="help-block">
                    <strong>{{ $errors->first('IDService') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {{-- Priorité field --}}
    <div class="col-12 col-md-6 col-lg-3">
        <div class="form-group {{ $errors->has('IDPriorite') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('IDPriorite', 'Priorité', ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::select('IDPriorite', $priorities, old('IDPriorite'), [
                'class' => 'form-control',
                'placeholder' => 'sélectionnez priorité',
            ]) !!}

            @if ($errors->has('IDPriorite'))
                <span class="help-block">
                    <strong>{{ $errors->first('IDPriorite') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
{{-- end row --}}

<div class="row">
    {{-- msg field --}}
    <div class="col-12 col-md-6 col-lg-8">
        <div class="form-group {{ $errors->has('message') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('message', 'Détail', ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>

            {!! Form::textarea('message', old('message'), [
                'class' => 'form-control',
                'placeholder' => 'votre message ici',
            ]) !!}
            @if ($errors->has('message'))
                <span class="help-block">
                    <strong>{{ $errors->first('message') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
{{-- end row --}}

<div class="row">
    <div class="col-12 col-md-4 col-lg-2">
        <div class="form-group {{ $errors->has('files') ? 'has-error' : '' }}">
            {!! Form::label('files', 'fichiers ', ['class' => 'form-label']) !!}
            {!! Form::file('files[]', ['class' => 'form-control', 'multiple' => 'multiple']) !!}
            <small id="status_block" class="form-text text-dark">
                Sélectionnez un ou plusieurs fichiers
            </small>

            @if ($errors->has('files'))
                <span class="help-block">
                    <strong>{{ $errors->first('files') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
{{-- end row --}}

<div class="form-group">
    <button type="reset" class="btn btn-warning"><i class="fa fa-history"></i> Annuler</button>
    <button class="btn {{ isset($ticket) ? 'bg-warning' : 'bg-primary' }}"><i class="fa fa-send float"></i>
        envoyer
    </button>
</div>
{{-- End row --}}

@push('js')
    {{-- import ckeditor scripts --}}
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>

    <script>
        $(() => {
            CKEDITOR.replace('message');

            $('button[type="reset"]').on('click', function(e) {
                e.preventDefault();
                $('input[name="objet_ticket"],input[type="file"]').val('');
                $('select').val('').trigger('change');
                $('.note-editable').html('');
            })
        })
    </script>
@endpush
