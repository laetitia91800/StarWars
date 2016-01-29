@extends('layouts.admin')

@section('content')
    
<form method="POST" action="{{url('product')}}" enctype="multipart/form-data">
{!! csrf_field() !!}

  <div class ="grid-3">
    <div class="form_name big mas">
        <b><label class="label" for="name">{{trans('app.name')}}</label></b>
        <input class="input-text" id="name" name="name" type="text" value="{{old('name')}}">
        @if($errors->has('name'))<span class="error">{{$errors->first('name')}}</span>@endif
    </div>

    <div class="form_slug big mas">
        <b><label class="slug" for="slug">{{trans('app.slug')}}</label></b>
        <input class="input-text" id="slug" name="slug" type="text" value="{{old('slug')}}">
        @if($errors->has('slug'))<span class="error">{{$errors->first('slug')}}</span>@endif
    </div>

    <div class="form_price big mas">
      <b><label class="price" for="price">{{trans('app.price')}}</label></b>
      <input class="input-text" id="price" name="price" type="text" value="{{old('price')}}">
      @if($errors->has('price'))<span class="error">{{$errors->first('price')}}</span>@endif
     </div>
  </div>

  <div class="grid-2">
    <div class="content big mas">
        <b><label class="content" for="content">{{trans('app.descript')}}</label></b>
        <textarea rows="5" cols="50" name="content" value="content">{{old('content')}}</textarea>
        @if($errors->has('content'))<span class="error">{{$errors->first('content')}}</span>@endif
    </div>

    <div class="abstract big mas">
        <b><label class="abstract" for="abstract">{{trans('app.abstract')}}</label></b>
        <textarea rows="5" cols="50" name="abstract" value="abstract">{{old('abstract')}}</textarea>
        @if($errors->has('abstract'))<span class="error">{{$errors->first('abstract')}}</span>@endif
    </div>
  </div>

  <div class="grid-5">
      <div class="form-text big mas">
          <b><label class="date" for="date">{{trans('app.pub')}}</label></b>
          <input class="input-text" id="published_at" name="published_at" type="text"  placeholder="jj-mm-aaaa" value="{{old('published_at')}}">
          @if($errors->has('published_at'))<span class="error">{{$errors->first('published_at')}}</span>@endif
      </div>

      <div class="categorie big mal pa10"><b>{{trans('app.cat')}}</b>
          <select name="category_id">
              <option value="" selected disabled></option>
              @foreach($categories as $id => $title)
                  <option value="{{$id}}">{{$title}}</option>
              @endforeach
          </select>
      </div>

      <div class="status big mal pa10 fl">
          <p><b>{{trans('app.status')}}</b></p>
          <INPUT type= "radio" name="radio" value="opened"> Opened
          <INPUT type= "radio" name="radio" value="closed"> Closed
      </div>

      <div class="tag big mal pa10"><b>{{trans('app.tag')}}</b>
          <select name="tags[]" multiple>
              <option value="" selected disabled></option>
              @foreach($tags as $id => $name)
                  <option value="{{$id}}">{{$name}}</option>
              @endforeach
          </select>
      </div>
  </div>

      <div class="addImage big">
        <p><b>{{trans('app.addImage')}}</b>
        <input class="image mam" type="file" name="thumbnail"></p>
        @if($errors->has('thumbnail'))<span class="error">{{$errors->first('thumbnail')}}</span>@endif
      </div>


      <div class="biggest fr">
              <input class="btnCreate" type="submit" value="Create">
      </div>


</form>

@stop