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
</div>
{{-- end row --}}

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

    {{-- file field --}}
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group {{$errors->has('nom_fichier') ? 'has-error' : ''}}">
            <div class="option">
                {!! Form::label('nom_fichier', 'nom de fichier', ['class'=>'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::file("nom_fichier",["class"=>"form-control"]) !!}
            <small id="status_block" class="form-text text-muted">Le fichier doit être de type : pdf, xls, xlsx, xlm, xla, xlc, xlt, xlw, doc, docx.</small>
            @if ($errors->has('nom_fichier'))
            <span class="help-block">
                <strong>{{$errors->first('nom_fichier')}}</strong>
            </span>
            @endif
        </div>
    </div>

    {{-- download old file field --}}
    @if (isset($invoice))
    <div class="col-12 col-md-4 col-lg-3">
        <div class="form-group">
            <label class="form-label">Fichier </label>
            <a href="{{ url($invoice->chemin) }}" class="d-block">{{ $invoice->nom_fichier }}</a>
        </div>
    </div>
    @endif

</div>
{{-- end row --}}

<div class="form-group">
    <button class="btn {{ isset($invoice) ? "bg-warning" : "bg-primary" }}"><i class="fa fa-floppy-o float"></i> enregistrer </button>
</div>
{{-- End row --}}

@push('js')
<script>
    $(()=>{
     
    })
</script>
@endpush