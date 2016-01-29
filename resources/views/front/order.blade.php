@extends('layouts.master')


@section('content')

    @if(Session::has('messageOrderValid'))
        @include('partials.flash') {{-- sert a inserer message erreur --}}
    @endif

    <h1>Espace Privé</h1>
    <h2>Liste de vos commandes :</h2>

    <table class="tabProd">

        <th>Date de commande</th>
        <th>Produit</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Total</th>


        @forelse($orders as $order)


            <tr>
                <td>{{$order->command_at}}</td>
                <td><a href="{{url('prod',[$order->product->id, $order->product->slug])}}" class="nameProduct">{{$order->product->name}}</a></td>
                <td>{{$order->price}}</td>
                <td>{{$order->quantity}}</td>
                <td>{{$order->ligneTotal()}}</td>

            </tr>

        @empty
            {{trans('app.noOrder')}}

        @endforelse

    </table>


 @stop