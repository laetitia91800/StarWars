@extends('layouts.admin')

@section('content')

      <h1 class="order">Liste des commandes :</h1>

      <table class="tabProd">

          <th>Id client</th>
          <th>Nom client</th>
          <th>Date de commande</th>
          <th>Produit</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>


          @forelse($orders as $order)

              <tr>
                  <td>{{$order->customer_id}}</td>
                  <td>{{$order->customer->user->name}}</td>
                  <td>{{$order->command_at}}</td>
                  <td>{{$order->product->name}}</td>
                  <td>{{$order->price}}</td>
                  <td>{{$order->quantity}}</td>
                  <td>{{$order->ligneTotal()}}</td>

              </tr>

          @empty
              {{trans('app.noOrder')}}

          @endforelse

      </table>

      {!! $orders->links() !!}
@stop