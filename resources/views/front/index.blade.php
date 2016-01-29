@extends('layouts.master')


@section('content')


    @if(Session::has('messageOrder'))
        @include('partials.flash') {{-- sert a inserer message erreur --}}
    @endif

    @if(Session::has('messagePanier'))
        @include('partials.flash') {{-- sert a inserer message erreur --}}
    @endif

    @if(Session::has('messageLogout'))
        @include('partials.flash') {{-- sert a inserer message erreur --}}
    @endif



    @forelse($products as $product)
      <div class="product mw960p center">

        <div  class="image fl clear">
        @if($pict=$product->picture)
            <img src="{{url('uploads',$pict->uri)}}" class = "w250p">
        @endif
        </div>

        <div class=".fr ">
        <h2 class="ma0"><a href="{{url('prod',[$product->id, $product->slug])}}">{{$product->name}}</a></h2>
        {{$product->abstract}}

        <p><b>{{trans('app.price')}} </b> {{$product->price}} €</p>

        <p><b>{{trans('app.tag')}}</b>
        @forelse($product->tags as $tag)
            <a href="{{url ('tag',[$tag->id])}}">{{$tag->name}}</a>
        @empty
            {{trans('app.noTag')}}
        @endforelse
        </p>
            <b>{{trans('app.cat')}}</b> {{$product->category->title}}<br>
            <b>{{trans('app.pub')}}</b> {{$product->published_at}}

        </div>

        <div class="clear"></div>
      </div>

    @empty
         <p>No product</p>
    @endforelse

{!! $products->links() !!}

@stop


