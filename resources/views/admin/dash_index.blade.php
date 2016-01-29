@extends('layouts.admin')

@section('content')


<div class="bigger pa10">
    <button class="btnAjout"><a href="{{url('product/create')}}">Ajouter un produit</a></button>
</div><br>


<table class="tabProd">
        <th>Status</th>
        <th>Name</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Date</th>
        <th>Category</th>
        <th>Tags</th>
        <th>Action</th>

        @forelse($products as $product)
        <tr>
         <td><a href="{{url('product',['status',$product->id])}}" class="dashStatus btn-{{$product->status}}}"> {{$product->status}}</a></td>
         <td><a href="{{url('product',[$product->id,'edit'])}}" class="dashName">{{$product->name}}</a></td>
         <td>{{$product->price}}</td>
         <td>{{$product->quantity}}</td>
         <td>{{$product->published_at}}</td>
         <td>{{$product->category->title}}</td>
         <td> @forelse($product->tags as $tag)
                 {{$tag->name}}
             @empty
                 {{trans('app.noTag')}}
             @endforelse</td>
         <td>
             <form method="POST" action="{{url('product',$product->id)}}">
             {!! csrf_field() !!}

                 <input type="hidden" name="_method" value="delete">
                 <input type="submit" value="Delete">
             </form>

          </td>
        @empty


        </tr>



        @endforelse





</table>
{!! $products->links() !!}
@stop