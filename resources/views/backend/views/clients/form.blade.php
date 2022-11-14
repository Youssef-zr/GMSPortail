<div class="row">
    {{-- city name field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{ $errors->has('raison_sociale') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('raison_sociale', 'raison sociale', ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('raison_sociale', old('raison_sociale'), [
                'class' => 'form-control',
                'placeholder' => 'raison sociale',
            ]) !!}
            @if ($errors->has('raison_sociale'))
                <span class="help-block">
                    <strong>{{ $errors->first('raison_sociale') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
{{-- end row --}}

<div class="row">
    {{-- phone field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('phone', 'Tél', ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'Numéro de téléphone']) !!}
            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {{-- email field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('email', 'E-mail', ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Adresse email']) !!}

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
{{-- end row --}}

<div class="row">
    {{-- photo field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{ $errors->has('code_client_omag') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('code_client_omag', 'code client', ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('code_client_omag', old('code_client_omag'), [
                'class' => 'form-control',
                'placeholder' => 'code client omage',
            ]) !!}

            @if ($errors->has('code_client_omag'))
                <span class="help-block">
                    <strong>{{ $errors->first('code_client_omag') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {{-- photo field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{ $errors->has('photo') ? 'has-error' : '' }}">
            {!! Form::label('photo', 'photo', ['class' => 'form-label']) !!}
            {!! Form::file('photo', ['class' => 'form-control']) !!}

            @if ($errors->has('photo'))
                <span class="help-block">
                    <strong>{{ $errors->first('photo') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
{{-- end row --}}

<div class="row">
    {{-- sync field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{ $errors->has('sync') ? 'has-error' : '' }}">
            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                <input type="checkbox" class="custom-control-input" id="sync" name="sync"
                    {{ (isset($client) and $client->sync == 1) ? "checked='checked'" : '' }}>
                <label class="custom-control-label" for="sync">synchroniser avec omag</label>
            </div>

            @if ($errors->has('sync'))
                <span class="help-block">
                    <strong>{{ $errors->first('sync') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
{{-- end row --}}

<div class="form-group">
    <button class="btn {{ isset($client) ? 'bg-warning' : 'bg-primary' }}">
        <i class="fa fa-floppy-o float"></i>
        enregistrer
    </button>
</div>
{{-- End row --}}

@push('js')
    <script>
        $(() => {

        })
    </script>
@endpush

@push('css')
    <style>

    </style>
@endpush
