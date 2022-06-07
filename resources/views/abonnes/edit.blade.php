@extends('layouts.app')
@section('title', 'Ajouter/Modifier un Abonne')
@section('content')

<div class="uk-grid uk-align-center uk-width-1-3 uk-card uk-card-default add-main ">
    @if (isset($abonne))
    <form action="{{ route('abonne.update', $abonne) }}" method="POST" enctype="multipart/form-data">
        @method("PUT")
        @else
        <form action="{{ route('abonne.store') }}" method="POST" enctype="multipart/form-data">
            @endif
            @csrf

            <img src=" {{ asset('storage/images/logo/logo-v3.jpg') }}" alt="" width="200px" height="200px" class="add-img  uk-align-center">
            <div class="uk-grid uk-algin-center ">
                <div class="uk-margin-small">
                    <div class="uk-inline">
                        <span class="uk-form-icon" uk-icon="icon: user"></span>
                        <input type="text" class="uk-input" id="nom" name="nom" placeholder="Nom" value="{{ isset($abonne) ? $abonne->nom : old('nom') }}">
                    </div>
                    @error('nom')
                    <p> {{ $message }}</p>
                    @enderror
                </div>
                <div class="uk-margin-small">
                    <div class="uk-inline">
                        <span class="uk-form-icon" uk-icon="icon: user"></span>
                        <input type="text" class="uk-input" id="prenom" name="prenom" placeholder="Prenom" value="{{ isset($abonne) ? $abonne->prenom : old('prenom') }}">
                    </div>
                    @error('nom')
                    <p> {{ $message }}</p>
                    @enderror
                </div>

                <div class="uk-margin-small">

                    <div class="uk-inline">
                        <span class="uk-form-icon" uk-icon="icon: mail"></span>
                        <input type="email" class="uk-input" id="email" name="email" placeholder="email" value="{{ isset($abonne) ? $abonne->email : old('email') }}">
                    </div>
                    @error('email')
                    <p> {{ $message }}</p>
                    @enderror


                </div>

                <div class="uk-margin-small">
                    <div class="uk-inline">
                        <span class="uk-form-icon" uk-icon="icon: receiver"></span>
                        <input type="tel" class="uk-input" id="telephone" name="telephone" placeholder="telephone" value="{{ isset($abonne) ? $abonne->telephone : old('telephone') }}">
                    </div>
                    @error('telephone')
                    <p> {{ $message }}</p>
                    @enderror
                </div>

                <div class="uk-margin-small">

                    <div class="uk-inline">
                        <span class="uk-form-icon" uk-icon="icon: calendar"></span>
                        <input type="text" onfocus="(this.type='date')" class="uk-input" id="abonnement_fin" name="abonnement_fin" placeholder="Fin abonnement" value="{{ isset($abonne) ? $abonne->abonnement_fin : old('abonnement_fin') }}">
                    </div>
                    @error('abonnement')
                    <p> {{ $message }} </p>
                    @enderror
                </div>

                <br />
                <div class="uk-margin">

                    <div uk-form-custom>

                        <input type="file" accept="image/*" class="form-control" id="photo" name="photo" title="photo" value="{{ isset($abonne) ? $abonne->photo : old('photo') }}">
                        @if (isset($abonne->photo))
                        <p>Image actuelle</p>
                        <img src="{{ asset('storage/' . $abonne->photo) }}" alt="" width="190" style="border:5px solid #aa0a30;">
                        @endif
                        </input>
                        @if (!isset($abonne->photo))
                        <button class="uk-button" type="button" tabindex="-1">Choisir une photo</button>
                        @endif

                    </div>
                    @error('photo')
                    <p> {{ $message }}</p>
                    @enderror
                </div>

            </div>
            <div class="uk-margin uk-remove-margin-top">
                <a href="{{ route('abonne.index' ) }}" class="uk-button uk-button-default uk-align-right">
                    Retour
                </a>
                <input type="submit" value="Valider" name="ajouter" class="uk-button uk-button-default uk-align-left">
            </div>
            <br>
            <br>
        </form>

</div>
@endsection