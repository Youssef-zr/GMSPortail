<div class="row">
    {{-- client field --}}
    <div class="col-12 col-md-6 col-lg-4">
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
    <div class="col-12 col-md-6 col-lg-4">
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
</div>
{{-- end row --}}

<div class="row">
    {{-- details field --}}
    <div class="col-12 col-md-6 col-lg-4">
        <div class="form-group {{$errors->has('detail') ? 'has-error' : ''}}">
            <div class="option">
                {!! Form::label('detail', 'detail', ['class'=>'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::textarea("detail", old('detail'), ['class'=>'form-control',"placeholder"=>"detail"]) !!}
            @if ($errors->has('detail'))
            <span class="help-block">
                <strong>{{$errors->first('detail')}}</strong>
            </span>
            @endif
        </div>
    </div>
</div>
{{-- end row --}}

<div class="row">
    {{-- Périodicité field --}}
    <div class="col-12 col-md-6 col-lg-4">
        <div class="form-group {{$errors->has('Périodicité') ? 'has-error' : ''}}">
            <div class="option">
                {!! Form::label('Périodicité', 'Périodicité', ['class'=>'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>
            {!! Form::select("Périodicité", periodicites(), old('Périodicité'), ['class'=>'form-control',"placeholder"=>"Périodicité"]) !!}

            @if ($errors->has('Périodicité'))
            <span class="help-block">
                <strong>{{$errors->first('Périodicité')}}</strong>
            </span>
            @endif
        </div>
    </div>
</div>
{{-- end row --}}

<div id="perso-repetition" style="display: none">
    <div class="row">
        <div class="col-12 col-md-6 col-lg-4">
            <hr>
            <h3 class="mt-2 mb-4">Récurrence personnalisée</h3>
            {{-- reapeater tou field --}}
            <div class="form-group">
                <label class="form-label"><b class="text-underline">Répéter tou(te)s les</b></label>
                <div class="d-flex justify-content-center">
                    {!! Form::text("Périodicité_jour", old('Périodicité_jour'), ["class"=>'form-control mr-2',"placeholder"=>"nombre"]) !!}
                    {!! Form::select("Périodicité_delai", repeate_at(), old('Périodicité_delai'), ["class"=>'form-control',"placeholder"=>"Périodicités"]) !!}
                </div>
            </div>
    
            {{-- Répéter le field --}}
            <div class="form-group">
                <label class="form-label"><b class="text-underline">Répéter le</b></label>
                <ul class="d-flex align-items-center list-unstyled">
                    <li class="mr-3">
                        <div class="custom-control custom-checkbox" title="lundi" data-toggle="tooltip">
                            <input type="checkbox" name="jours[0]" class="custom-control-input" id="lundi" aria-describedby="terms-error" aria-invalid="false" value="lundi">
                            <label class="custom-control-label" for="lundi">L</label>
                        </div>
                    </li>
                    <li class="mr-3">
                        <div class="custom-control custom-checkbox" title="mardi" data-toggle="tooltip">
                            <input type="checkbox" name="jours[1]" class="custom-control-input" id="mardi" aria-describedby="terms-error" aria-invalid="false" value="mardi">
                            <label class="custom-control-label" for="mardi">M</label>
                        </div>
                    </li>
                    <li class="mr-3">
                        <div class="custom-control custom-checkbox" title="mercredi" data-toggle="tooltip">
                            <input type="checkbox" name="jours[2]" class="custom-control-input" id="mercredi" aria-describedby="terms-error" aria-invalid="false" value="mercredi">
                            <label class="custom-control-label" for="mercredi">M</label>
                        </div>
                    </li>
                    <li class="mr-3">
                        <div class="custom-control custom-checkbox" title="jeudi" data-toggle="tooltip">
                            <input type="checkbox" name="jours[3]" class="custom-control-input" id="jeudi" aria-describedby="terms-error" aria-invalid="false" value="jeudi">
                            <label class="custom-control-label" for="jeudi">J</label>
                        </div>
                    </li>
                    <li class="mr-3">
                        <div class="custom-control custom-checkbox" title="vendredi" data-toggle="tooltip">
                            <input type="checkbox" name="jours[4]" class="custom-control-input" id="vendredi" aria-describedby="terms-error" aria-invalid="false" value="vendredi">
                            <label class="custom-control-label" for="vendredi">V</label>
                        </div>
                    </li>
                    <li class="mr-3">
                        <div class="custom-control custom-checkbox" title="samedi" data-toggle="tooltip">
                            <input type="checkbox" name="jours[5]" class="custom-control-input" id="samedi" aria-describedby="terms-error" aria-invalid="false" value="samedi">
                            <label class="custom-control-label" for="samedi">S</label>
                        </div>
                    </li>
                    <li class="mr-3">
                        <div class="custom-control custom-checkbox" title="dimanche" data-toggle="tooltip">
                            <input type="checkbox" name="jours[6]" class="custom-control-input" id="dimanche" aria-describedby="terms-error" aria-invalid="false" value="dimanche">
                            <label class="custom-control-label" for="dimanche">D</label>
                        </div>
                    </li>
                </ul>
            </div>
    
            {{-- se termine le --}}
            <div class="form-group">
                <label class="form-label"><b class="text-underline">Se termine</b></label>
                <ul class="list-unstyled">
                    <li class="mr-3 mb-3">
                        <div class="custom-control custom-radio">
                            <input type="radio" name="se_termine" class="custom-control-input" id="Jamais" aria-describedby="terms-error" aria-invalid="false" value="jamais">
                            <label class="custom-control-label" for="Jamais"> Jamais</label>
                        </div>
                    </li>
                    <li class="mr-3 mb-4">
                        <div class="d-flex align-items-center">
                            <div class="custom-control custom-radio mb-1 mr-3">
                                <input type="radio" name="se_termine" class="custom-control-input" id="Le" aria-describedby="terms-error" aria-invalid="false" value="le">
                                <label class="custom-control-label" for="Le"> Le</label>
                            </div>
                            {!! Form::date("se_termine_le", old('le'), ["class"=>'form-control','disabled'=>'disabled']) !!}
                        </div>
                    </li>
                    <li class="mr-3 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="custom-control custom-radio mb-1 mr-3">
                                <input type="radio" name="se_termine" class="custom-control-input" id="Après" aria-describedby="terms-error" aria-invalid="false" value="après">
                                <label class="custom-control-label" for="Après"> Après</label>
                            </div>
                            {!! Form::number("se_termine_après", old('se_termine_après'), ["class"=>'form-control',"placeholder"=>'nombre d\'occurrences','disabled'=>'disabled']) !!}
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    {{-- end row --}}
</div>

<div class="form-group">
    <button class="btn {{ isset($planning) ? "bg-warning" : "bg-primary" }}"><i class="fa fa-floppy-o float"></i> enregistrer </button>
</div>
{{-- End row --}}

@push('js')
<script>
    $(()=>{
     
    })
</script>
@endpush