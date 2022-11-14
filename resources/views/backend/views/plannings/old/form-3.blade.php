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
    {{-- gToken field --}}
    <div class="col-12 col-md-4">
        <div class="form-group {{ $errors->has('gToken') ? 'has-error' : '' }}">
            <div class="option">
                <label class="form-label">Token</label>
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('gToken', old('gToken'), [
                'placeholder' => 'gToken',
                'class' => 'form-control',
                'placeholder' => 'google calendrier token',
            ]) !!}
            @if ($errors->has('gToken'))
                <span class="help-block">
                    <strong>{{ $errors->first('gToken') }}</strong>
                </span>
            @endif
        </div>
    </div>

    {{-- email field --}}
    <div class="col-12 col-md-4">
        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
            <div class="option">
                <label class="form-label">E-mail adress</label>
                <span class="star text-danger">*</span>
            </div>
            {!! Form::email('email', old('email'), [
                'placeholder' => 'email',
                'class' => 'form-control',
                'placeholder' => 'google calendrier email',
            ]) !!}
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
    <div class="col-12">
        <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Enregistrer</button>
        </div>
    </div>
</div>
{{-- end row --}}

