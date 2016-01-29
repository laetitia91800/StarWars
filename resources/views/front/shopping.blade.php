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


            </div><br>

        @endforeach

        <div id="popup_name" class="popup_block center">
            <img src={{url("assets/imgTheme/vador.png")}} class="fr mam"> <p class="big mam center">Attention !!<br> Jeune padawan, cette action validera ton panier définivement.<br><b>Click sur "ok" pour continuer</b></p>
            <a href="{{url('storeOrder')}}">
            <input id ="btnPopUp" class="btnValidOrder big w20 fl" type="submit" name="order" value="ok">
            </a>
        </div>

        <p class="txtcenter bigger mtl"><b>Total général : {{$total}} €</b></p>

        <div class="mam bigger clear fr ">
            <input id ="btnPop" class="btnValidOrder" type="submit" name="order" value="Commander">
        </div>







@stop