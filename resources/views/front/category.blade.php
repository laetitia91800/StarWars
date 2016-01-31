@extends('layouts.master')


@section('content')

    @forelse($products as $product)

             <div class="product mw960p center">

             <div  class="image fl clear">
                @if($pict=$product->picture)
                    <img src="{{url('uploads',$pict->uri)}}" class="w250">
                @endif
            </div>

            <div>
                <h2 class="ma0"><a href="{{url('prod',[$product->id, $product->slug])}}">{{$product->name}}</a></h2>
                {{$product->abstract}}
                <p><b>{{trans('app.price')}} :</b> {{$product->price}} €</p>
                <p><b>{{trans('app.tag')}}</b>
                @forelse($product->tags as $tag)
                    {{$tag->name}}
                    @empty
                    {{trans('app.noTag')}}
                    @endforelse
                </p>
                <b>{{trans('app.pub')}}</b> {{$product->published_at}}
            </div>

            <div class="clear"></div>
        </div>

    @empty
            <p>No product</p>
    @endforelse


    {!! $products->links() !!}

@stop