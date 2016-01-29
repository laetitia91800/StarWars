@extends('layouts.master')


@section('content')



        @foreach($carts as $cart)


            <div class="product mw960p center clear">

                <div  class="image fl clear">
                    @if($pict=$cart['picture'])
                      <img src="{{url('uploads',$pict['uri'])}}" class="w250p">
                    @endif
                </div>

                <div>
                    <h2 class="ma0"><a href="{{url('prod',[$cart['id']])}}">{{$cart['name']}}</a></h2>

                    <a href="{{url('suppProduct',[$cart['id']])}}">
                        <input class="btn mal" type="submit" name="supp_product" value="Supprimer le produit">
                    </a>
                </div>

                <p class=" mam big fl"><b>{{trans('app.price')}}</b> {{$cart['price']}} €</p><br>
                <p class ="big ma50"><b> Quantité commandé : </b>{{$cart['quantity']}}</p>


            </div>

        @endforeach

        <div id="popup_name" class="popup_block center">
            <p>Cette action validera votre panier définivement</p>
        </div>

        <p class="txtcenter bigger mtl"><b>Total général : {{$total}} €</b></p>

        <div class="mam bigger clear fr">
            <a href="{{url('storeOrder')}}">
            <input id ="btnPopUp" class="btnValidOrder" type="submit" name="order" value="Commander">
            </a>
        </div>







@stop