@extends('layouts.master')


@section('content')

<form method="POST" action="{{url('login')}}">

    {!! csrf_field() !!}  {{-- nous envoi un token --}}

    <div class="form-text mam bigger">
        <label class="label" for="email">Identifiant :</label><br>
        <input class="input-text" id="email" name="email" type="email" value="{{old('email')}}">
        @if($errors->has('email'))<span class="error">{{$errors->first('email')}}</span>@endif
    </div>

    <div class="form-text mam bigger">
        <label class="label" for="password">Mot de passe :</label><br>
        <input class="input-text" id="password" name="password" type="password">
        @if($errors->has('password'))<span class="error">{{$errors->first('password')}}</span>@endif
    </div><br>

    <div class="form-text big fl">
        <input id="remember" name="remember" type="checkbox" value="true">
        <label class="label mas" for="">Se souvenir de moi </label>
    </div>
    <div class="mas fr bigger">
        <input class="btnConnex" type="submit" value="Connexion">
    </div><br>
    <p class="clear">Mot de passe oublié ? ->
    <a href="{{url('contact')}}">Demandez un nouveau mot de passe via notre formulaire contact</a></p>
</form>






@stop