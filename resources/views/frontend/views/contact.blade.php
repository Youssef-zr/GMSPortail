@extends('frontend.layouts.master')
@section('content')
    <section class="section-contact section">
        <div class="container">
            <div class="row d-flex align-items-center">
                {{-- start col --}}
                <div class="col-md-6">
                    @if (session('msgSuccess') != '')
                        <p class="alert alert-success text-capitalize d-flex align-items-center">
                            <i class="fa fa-thumbs-o-up fa-2x mr-2"></i>{{ session('msgSuccess') }}
                        </p>
                    @endif

                    {!! Form::open(['route' => 'frontend.sendMail']) !!}
                    <div class="row">
                        {{-- name --}}
                        <div class="col-12">
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <div class="option">
                                    {!! Form::label('name', 'Nom', ['class' => 'form-label']) !!}
                                    <span class="star text-danger">*</span>
                                </div>

                                {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'votre nom']) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- phone --}}
                        <div class="col-12">
                            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                <div class="option">
                                    {!! Form::label('phone', 'Tél', ['class' => 'form-label']) !!}
                                    <span class="star text-danger">*</span>
                                </div>

                                {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => 'votre numéro de téléphone']) !!}
                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- email --}}
                        <div class="col-12">
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <div class="option">
                                    {!! Form::label('email', 'E-mail', ['class' => 'form-label']) !!}
                                    <span class="star text-danger">*</span>
                                </div>

                                {!! Form::text('email', old('email'), ['class' => 'form-control', 'placeholder' => 'votre adresse email']) !!}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- subject --}}
                        <div class="col-12">
                            <div class="form-group {{ $errors->has('subject') ? 'has-error' : '' }}">
                                <div class="option">
                                    {!! Form::label('subject', 'Sujet', ['class' => 'form-label']) !!}
                                    <span class="star text-danger">*</span>
                                </div>

                                {!! Form::text('subject', old('subject'), ['class' => 'form-control', 'placeholder' => 'sujet']) !!}
                                @if ($errors->has('subject'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('subject') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        {{-- msg --}}
                        <div class="col-12">
                            <div class="form-group {{ $errors->has('msg') ? 'has-error' : '' }}">
                                <div class="option">
                                    {!! Form::label('msg', 'Message', ['class' => 'form-label']) !!}
                                    <span class="star text-danger">*</span>
                                </div>

                                {!! Form::textarea('msg', old('msg'), ['class' => 'form-control', 'placeholder' => 'votre Message']) !!}
                                @if ($errors->has('msg'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('msg') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-flat btn-block"><i class="fa fa-send"></i>
                                    Envoyer
                                </button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
                {{-- start col --}}
                <div class="col-md-6">
                    <div class="map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26381.171416569046!2d-6.6056160069928165!3d34.257564677417555!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xda7575f8a6d8643%3A0xc7050653c05e128b!2sKenitra!5e0!3m2!1sen!2sma!4v1664295903864!5m2!1sen!2sma"
                            width="100%" height="600" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>

        </div>
        </div>
    </section>
@endsection
