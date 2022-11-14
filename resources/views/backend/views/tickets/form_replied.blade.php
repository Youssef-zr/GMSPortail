@if ($ticket->statut == 'ferme')
    <div class="row">
        <div class="col-12">
            <p class="alert alert-warning mb-4">cette demande est fermée vous pouvez y répondre pour l'ouvrir de nouveau
            </p>
        </div>
    </div>
    {{-- end row --}}
@endif

<div class="row">
    {!! Form::hidden('IDTicket', $ticket->id) !!}
    {{-- msg field --}}
    <div class="col-12">
        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
            <div class="option">
                {!! Form::label('description', 'Détail', ['class' => 'form-label']) !!}
                <span class="star text-danger">*</span>
            </div>

            {!! Form::textarea('description', old('description'), [
                'class' => 'form-control',
                'placeholder' => 'votre description ici',
            ]) !!}
            @if ($errors->has('description'))
                <span class="help-block">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>
    </div>
</div>
{{-- end row --}}

<div class="row">
    <div class="col-12 col-md-6">
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
    <button class="btn bg-primary"><i class="fa fa-send float"></i>
        Envoyer
    </button>
    @if (auth()->user()->roles_name[0] != 'client')
        <button class="btn bg-secondary" id="closeTicket">
            <i class="fa fa-close"></i> Fermer le ticket
        </button>
    @endif
</div>
{{-- End row --}}

@push('js')
    {{-- import ckeditor scripts --}}
    <script src="https://cdn.ckeditor.com/4.19.1/standard/ckeditor.js"></script>

    <script>
        $(() => {
            CKEDITOR.replace('description');

            $('button[type="reset"]').on('click', function(e) {
                e.preventDefault();
                $('input[name="objet_ticket"],input[type="file"]').val('');
                $('select').val('').trigger('change');
                $('.note-editable').html('');
            });

            $('#closeTicket').on('click', function(e) {
                e.preventDefault();
                $('#closeTicketForm').submit();
            })
        })
    </script>
@endpush

@push('css')
    {{-- import ckeditor stylesheet --}}
    
@endpush
