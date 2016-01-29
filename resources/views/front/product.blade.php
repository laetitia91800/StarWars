@extends('layouts.master')


@section('content')

    <h1>{{$product->name}}</h1>

    <div  class="image mas mtn fl clear">
        @if($pict=$product->picture)
             <img src="{{url('uploads',$pict->uri)}}">
        @endif
    </div>

    <div class="description">
    <p><b>{{trans('app.price')}}</b> {{$product->price}} €</p>

    <p><b>{{trans('app.descript')}}</b></p>
    <p>{{$product->content}}</p>

    <p><b>{{trans('app.tag')}}</b>
        @forelse($product->tags as $tag)
            {{$tag->name}}
        @empty
            {{trans('app.noTag')}}
        @endforelse
    </p>

     <p><b>{{trans('app.pub')}}</b> {{$product->published_at}}</p>

    </div>


    <form method="POST" action="{{url('storeShopping')}}" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <input type="hidden" name="id" value="{{$product->id}}">

        <p class="quantite clear fl big mal pa10"><b>{{trans('app.qte')}}</b>
        <select name="quantity">
            <option value="" selected disabled></option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
        </select></p>


        <div class="mas fr bigger">
            <input class="btnOrder" type="submit" value="Ajouter au panier">
        </div>

    </form>



@stop