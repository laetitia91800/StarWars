@extends('layouts.master')

@section('content')

    @if(Session::has('message'))
        @include('partials.flash') {{-- sert a inserer message erreur --}}
    @else

        <form method="POST" action="{{url('storeContact')}}">

         {!! csrf_field() !!}

        <div class="form-text big">
            <b><label class="label" for="email">{{trans('app.emailAdress')}} :</label></b><br>
            <input class="mas" id="email" name="email" type="text" value="{{old('email')}}">
            @if($errors->has('email'))<span class="error">{{$errors->first('email')}}</span>@endif
        </div><br>

        <div class="content big">
            <p><b>Votre message : </b></p>
             <textarea class="mas" row="50" cols="50" name="content">{{old('content')}}</textarea>
              @if($errors->has('content'))<span class="error">{{$errors->first('content')}}</span>@endif

        </div><br>

        <div class="mas bigger txtright">
             <input class="btnContact" type="submit" value="Envoyer">
        </div>

         </form>

    @endif

@stop