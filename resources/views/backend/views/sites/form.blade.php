<div class="row">
    {{-- libelle field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{$errors->has('libelle') ? 'has-error' : ''}}">
            <div class="option">
                {!! Form::label('libelle', 'libelle', ['class'=>'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::text('libelle',old('libelle'), ['class'=>'form-control',"placeholder"=>"libelle"]) !!}
            @if ($errors->has('libelle'))
            <span class="help-block">
                <strong>{{$errors->first('libelle')}}</strong>
            </span>
            @endif
        </div>
    </div>

    {{-- clients field --}}
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
</div>
<div class="form-group">
    <button class="btn {{ isset($site) ? "bg-warning" : "bg-primary" }}"><i class="fa fa-floppy-o float"></i> enregistrer </button>
</div>
{{-- End row --}}

@push('js')
<script>
    $(()=>{
        // $('#zone').on('change',function(){
        //     $('input[name="zone_id"]').val($(this).val());
        // })
    })
</script>
@endpush