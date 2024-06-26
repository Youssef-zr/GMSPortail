<div class="row">
    {{-- User name field --}}
    <div class="col-md-6 col-lg-3">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('name', 'Nom', ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => "Nom d'utilisateur"]) !!}

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>
    {{-- phone field --}}
    <div class="col-md-6 col-lg-3">
        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('phone', 'tél', ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => '06xxxxxxxx']) !!}

            @if ($errors->has('phone'))
                <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
{{-- end row --}}

<div class="row">
    {{-- User email field --}}
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('email', 'email', ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Adresse E-mail']) !!}

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
    {{-- User password field --}}
    <div class="col-md-6 col-lg-3">
        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('password', 'Mot de passe :', ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            <div class="form-relative">
                {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Mot de passe']) !!}
                <div class="icon"><i class="fa fa-lock"></i></div>
                <div class="show-password" title="show password" data-toggle="tooltip"><i class="fa fa-eye"></i></div>
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

    {{-- User confirm-password field --}}
    <div class="col-md-6 col-lg-3">
        @if (!isset($user))
            <div class="form-group {{ $errors->has('confirm-password') ? 'has-error' : '' }}">
                <div class="option">
                    {!! Form::label('confirm-password', 'confirmation', ['class' => 'form-label']) !!}
                    <span class="star text-danger">*</span>
                </div>
                <div class="form-relative">
                    {!! Form::password('confirm-password', [
                        'class' => 'form-control',
                        'placeholder' => 'Confirmez le mot de passe',
                    ]) !!}
                    <div class="icon"><i class="fa fa-lock"></i></div>
                    <div class="show-password" title="show password" data-toggle="tooltip"><i class="fa fa-eye"></i>
                    </div>
                    @error('confirm-password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                @if ($errors->has('confirm-password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('confirm-password') }}</strong>
                    </span>
                @endif
            </div>
        @endif
    </div>
</div>
{{-- end row --}}

<div class="row">
    {{-- User status field --}}
    <div class="col-md-6 col-lg-3">
        <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }}">
            {!! Form::label('status', 'statut', ['class' => 'form-label']) !!}
            {!! Form::select('status', user_status(), null, ['class' => 'form-control']) !!}

            @if ($errors->has('status'))
                <span class="help-block">
                    <strong>{{ $errors->first('status') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {{-- User roles_name field --}}
    <div class="col-md-6 col-lg-3">
        <div class="form-group {{ $errors->has('roles_name') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('roles_name', 'le rôle d\'utilisateur', ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::select('roles_name[]', $roles, null, [
                'class' => 'form-control',
                'id' => 'roles_name',
                'placeholder' => 'le rôle d\'utilisateur',
            ]) !!}

            @if ($errors->has('roles_name'))
                <span class="help-block">
                    <strong>{{ $errors->first('roles_name') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
{{-- end row --}}

<div class="row" style="{{ isset($user) and ($user->IDCLient != null ? 'display:block' : 'display:none') }}"
    id="clients-list">
    {{-- clients field --}}
    <div class="col-md-6">
        <div class="form-group {{ $errors->has('IDClient') ? 'has-error' : '' }}">
            {!! Form::label('IDClient', 'client', ['class' => 'form-label']) !!}
            {!! Form::select('IDClient', $clients, null, [
                'class' => 'form-control',
                'placeholder' => 'client assigné',
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

<div class="form-group">
    <button class="btn btn-primary"><i class="fa fa-floppy-o"></i> Enregistrer</button>
</div>
</div>
</div>

@push('js')
    <script>
        $(() => {
            $('.show-password').click(function() {
                let inptPassword = $(this).siblings("input");

                if (inptPassword.prop('type') == "password") {
                    inptPassword.prop('type', "text");
                } else {
                    inptPassword.prop('type', "password");
                }

                let iconEye = $(this).find('i');
                iconEye.toggleClass('fa-eye fa-eye-slash');

                if (iconEye.hasClass('fa-eye')) {
                    iconEye.prop('title', "show password");
                } else {
                    iconEye.prop('title', "hide password");
                }
            });

            if ($("select#roles_name").val() == "client") {
                $('#clients-list').css("display", "block");
            } else {
                $('#clients-list').css("display", "none");
            }

            $("select#roles_name").on('change', function() {
                if ($(this).val() == "client") {
                    $('#clients-list').css("display", "block");
                } else {
                    $('#clients-list').css("display", "none");
                }
            });
        })
    </script>
@endpush

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" />
    <style>
        .btn {
            position: relative;
            font-size: 16px
        }

        .btn i.float {
            margin-right: 10px
        }

        .form-relative {
            position: relative;
        }

        .form-relative input {
            padding-left: 40px;
            padding-right: 35px;
        }

        .form-relative .icon {
            position: absolute;
            top: 4px;
            font-size: 21px;
            left: 13px;
            border-right: 1px solid #eee;
            padding-right: 5px
        }

        .form-relative .card-avatar {
            position: absolute;
            top: -74px;
            left: 50%;
            transform: translateX(-54px);
        }

        .form-relative .show-password {
            position: absolute;
            right: 11px;
            top: 6px;
            cursor: pointer;
        }

        .select2 {
            width: 100% !important;
        }
    </style>
@endpush
