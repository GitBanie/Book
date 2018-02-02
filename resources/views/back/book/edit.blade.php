@extends('layouts.master')

@section('content')
<div class="row">
<form @if(!isset($book->picture)) class='col-12' @else class='col-6' @endif style="padding-top:30px" action="{{route('book.update', $book->id)}}" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
  {{ method_field('PUT') }}
  <h1>Update Book:</h1>
  <div class="form-group">
    <label for="title">Titre : *</label>
    <input name="title" type="text" class="form-control" id="title" placeholder="Titre de la dépense" value="{{$book->title}}">
    @if($errors->has('title'))
      <span class="text-danger">{{$errors->first('title')}}</span>
    @endif
  </div>
  <div class="form-group">
    <label for="description">Description : *</label>
    <textarea name="description" class="form-control" id="description" rows="3">{{$book->description}}</textarea>
    @if($errors->has('description'))
      <span class="text-danger">{{$errors->first('description')}}</span>
    @endif
  </div>
  <div class="form-group">
    <label for="genre">Genre :</label>
    <select name="genre_id" class="form-control" id="genre">
      <option selected='selected' value="0" >No genre</option>
      @forelse($genres as $key => $value)
      @if(isset($book->genre->id))
      @if ($book->genre->id == $key)
      @endif
      <option value="{{ $key }}" selected>{{ ucfirst($value) }}</option>
      @else
      <option value="{{$key}}" >{{ucfirst($value)}}</option>
      @endif
      @empty
      <p>Aucun genre</p>
      @endforelse
    </select>
  </div>
  <div class="form-group">
    <h2>Choisissez un/des auteurs *</h2>
    @forelse($authors as $id => $name)
    <label class="checkbox-inline" style="margin:0;">
      <input name="authors[{{$id}}]" type="checkbox" id="author{{$id}}" value="{{$id}}" @if( is_null($book->authors) == false and
        in_array($id, $book->authors()->pluck('id')->all()))
      checked @endif>{{$name}}
    </label>
    @empty
    @endforelse
    @if($errors->has('authors'))
      <span class="text-danger">{{$errors->first('authors')}}</span>
    @endif
  </div>
  <div class="form-group">
    <h2>Status</h2>
    <label class="c-input c-radio">
      <input id="publier" name="status" type="radio" checked='checked' value="published" @if($book->status == 'published') checked @endif>
      <span class="c-indicator"></span>
      Publier
    </label>
    <label class="c-input c-radio">
      <input id="depublier" name="status" type="radio" value="unpublished" @if($book->status == 'unpublished') checked @endif>
      <span class="c-indicator"></span>
      Dépublier
    </label>
    @if($errors->has('published'))
      <span class="text-danger">{{$errors->first('published')}}</span>
    @endif
  </div>
  <div class="form-group">
    <h2>File</h2>
    <label class="file">
      <input type="file" id="file" name="picture">
      <span class="file-custom"></span>
    </label>
  </div>
  <button type="submit" class="btn btn-primary">Modifier le livre</button>
</form>

@if(isset($book->picture))
<div class="img col-6" style="padding-top:30px">

<h2>Image</h2>
<img src="{{asset('images/'.$book->picture->link)}}" alt="Image"  style="max-width: 100%;">
</div>
@endif
</div>
@endsection
