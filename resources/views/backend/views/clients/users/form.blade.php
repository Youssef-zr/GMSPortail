<div class="row">
    {{-- clients list --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{ $errors->has('IDClient') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('IDClient', 'client', ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>

            {!! Form::select("IDClient", $clients, old('IDClient'), ["class"=>"form-control","placeholder"=>"nom du client"]) !!}
            @if ($errors->has('IDClient'))
                <span class="help-block">
                    <strong>{{ $errors->first('IDClient') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>

<div class="row">
    {{-- user name field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('name', 'nom', ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Nom d\'utilisateur']) !!}
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    {{-- user email field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('email', 'email', ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'E-mail adresse',"autocomplete" => "off"]) !!}
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="row form-card">
    {{-- user password field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('password', 'mot de passe', ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            <div class="form-relative ">
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mot de passe',"autocomplete" => "off"]) !!}
                <div class="icon text-teal"><i class="fa fa-lock text-dark"></i></div>
                <div class="show-password" title="Afficher"><i class="fa fa-eye"></i></div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>
    {{-- user phone field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('phone', 'Tel', ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            
            {!! Form::text('phone',old('phone'), ['class' => 'form-control', 'placeholder' => 'Numéro de téléphone',"autocomplete" => "off"]) !!}
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror

            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
<div class="form-group">
    <button class="btn {{ isset($user) ? 'bg-warning' : 'bg-primary' }}"><i class="fa fa-floppy-o float"></i>
        enregistrer </button>
</div>
{{-- End row --}}

@push('js')
    <script src="{{ url('assets/dist/js/dashboard.js') }}"></script>
@endpush
