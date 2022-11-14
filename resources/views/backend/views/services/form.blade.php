<div class="row">
    {{-- libelle field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{$errors->has('libelle') ? 'has-error' : ''}}">
            <div class="option">
                {!! Form::label('libelle', 'libelle', ['class'=>'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text("libelle", old('libelle'), ['class'=>'form-control',"placeholder"=>"libelle"]) !!}

            @if ($errors->has('libelle'))
            <span class="help-block">
                <strong>{{$errors->first('libelle')}}</strong>
            </span>
            @endif
        </div>
    </div>
    {{-- email field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
            <div class="option">
                {!! Form::label('email', 'email', ['class'=>'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text("email", old('email'), ['class'=>'form-control',"placeholder"=>"email"]) !!}
            
            @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{$errors->first('email')}}</strong>
            </span>
            @endif
        </div>
    </div>
</div>
{{-- end row --}}

<div class="form-group">
    <button class="btn {{ isset($service) ? "bg-warning" : "bg-primary" }}"><i class="fa fa-floppy-o float"></i> enregistrer </button>
</div>
{{-- End row --}}

@push('js')
<script>
    $(()=>{
     
    })
</script>
@endpush