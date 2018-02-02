@extends('layouts.master')

@section('content')
<form style="padding-top:30px" action="{{route('book.store')}}" method="post" enctype="multipart/form-data">
  {{csrf_field()}}
  <h1>Create Book:</h1>
  <div class="form-group">
    <label for="title">Titre : *</label>
    <input name="title" type="text" class="form-control" id="title" placeholder="Titre de la dépense" value="{{old('title')}}">
    @if($errors->has('title'))
      <span class="text-danger">{{$errors->first('title')}}</span>
    @endif
  </div>
  <div class="form-group">
    <label for="description">Description : *</label>
    <textarea name="description" class="form-control" id="description" rows="3" value="{{old('description')}}"></textarea>
    @if($errors->has('description'))
      <span class="text-danger">{{$errors->first('description')}}</span>
    @endif
  </div>
  <div class="form-group">
    <label for="genre">Genre :</label>
    <select name="genre_id" class="form-control" id="genre">
      <option selected='selected' value="0" >No genre</option>
      @forelse($genres as $key => $value)
      @if (Input::old('genre_id') == $key)
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
      <input name="authors[{{$id}}]" type="checkbox" id="author{{$id}}" value="{{$id}}" @if(array_key_exists($id, old('authors', []))) checked @endif> {{$name}}
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
      <input id="publier" name="status" type="radio" checked='checked' value="published" @if(old('status') == 'published') checked @endif>
      <span class="c-indicator"></span>
      Publier
    </label>
    <label class="c-input c-radio">
      <input id="depublier" name="status" type="radio" value="unpublished" @if(old('status') == 'unpublished') checked @endif>
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
  <button type="submit" class="btn btn-primary">Ajouter un livre</button>
</form>

@endsection
