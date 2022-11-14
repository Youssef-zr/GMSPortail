@if (!isset($employe))
<div class="row">
    {{-- matricule field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{$errors->has('matricule') ? 'has-error' : ''}}">
            <div class="option">
                {!! Form::label('matricule', 'matricule', ['class'=>'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('matricule',old('matricule'), ['class'=>'form-control',"placeholder"=>"matricule"]) !!}
            @if ($errors->has('matricule'))
            <span class="help-block">
                <strong>{{$errors->first('matricule')}}</strong>
            </span>
            @endif
        </div>
    </div>
</div>
@endif
{{-- end row --}}

<div class="row">
    {{-- nom field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{$errors->has('nom') ? 'has-error' : ''}}">
            <div class="option">
                {!! Form::label('nom', 'nom', ['class'=>'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('nom',old('nom'), ['class'=>'form-control',"placeholder"=>"Nom de l'employé"]) !!}
            @if ($errors->has('nom'))
            <span class="help-block">
                <strong>{{$errors->first('nom')}}</strong>
            </span>
            @endif
        </div>
    </div>
    {{-- prenom field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{$errors->has('prenom') ? 'has-error' : ''}}">
            <div class="option">
                {!! Form::label('prenom', 'prenom', ['class'=>'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('prenom',old('prenom'), ['class'=>'form-control',"placeholder"=>"Prenom de l'employé"]) !!}
            @if ($errors->has('prenom'))
            <span class="help-block">
                <strong>{{$errors->first('prenom')}}</strong>
            </span>
            @endif
        </div>
    </div>
</div>
{{-- end row --}}

<div class="row">
    {{-- cin field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{$errors->has('cin') ? 'has-error' : ''}}">
            <div class="option">
                {!! Form::label('cin', 'cin', ['class'=>'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('cin',old('cin'), ['class'=>'form-control',"placeholder"=>"cin"]) !!}
            @if ($errors->has('cin'))
            <span class="help-block">
                <strong>{{$errors->first('cin')}}</strong>
            </span>
            @endif
        </div>
    </div>
    {{-- cnss field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{$errors->has('cnss') ? 'has-error' : ''}}">
            {!! Form::label('cnss', 'cnss', ['class'=>'form-label']) !!}

            {!! Form::text('cnss',old('cnss'), ['class'=>'form-control',"placeholder"=>"cnss"]) !!}
            @if ($errors->has('cnss'))
            <span class="help-block">
                <strong>{{$errors->first('cnss')}}</strong>
            </span>
            @endif
        </div>
    </div>
</div>
{{-- end row --}}

<div class="row">
    {{-- client field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{$errors->has('IDClient') ? 'has-error' : ''}}">
            <div class="option">
                {!! Form::label('IDClient', 'clients', ['class'=>'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::select("IDClient", $clients, old('IDClient'), ['class'=>'form-control',"placeholder"=>"clients"]) !!}
            @if ($errors->has('IDClient'))
            <span class="help-block">
                <strong>{{$errors->first('IDClient')}}</strong>
            </span>
            @endif
        </div>
    </div>
    {{-- site field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{$errors->has('IDSite') ? 'has-error' : ''}}">
            <div class="option">
                {!! Form::label('IDSite', 'sites', ['class'=>'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::select("IDSite", $sites, old('IDSite'), ['class'=>'form-control',"placeholder"=>"sites"]) !!}
            @if ($errors->has('IDSite'))
            <span class="help-block">
                <strong>{{$errors->first('IDSite')}}</strong>
            </span>
            @endif
        </div>
    </div>
</div>
{{-- end row --}}

<div class="form-group">
    <button class="btn {{ isset($employe) ? "bg-warning" : "bg-primary" }}"><i class="fa fa-floppy-o float"></i> enregistrer </button>
</div>
{{-- End row --}}

@push('js')
<script>
    $(()=>{
     
    })
</script>
@endpush