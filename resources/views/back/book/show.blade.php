@extends('layouts.master')
@section('content')

@if($book->count())

<div class="row" style="margin-top:100px; border:1px solid rgba(0,0,0,.125); padding:20px;">
  <div class="col-6">
    <h2><b>Title :</b> {{$book->title}}</h2>
    <p style="padding-top:30px"><strong>Genre</strong>: {{$book->genre->name?? 'Aucun genre'}}</p>
    <p><strong>Date de création:</strong> {{$book->created_at}}</p>
    <p><strong>Date de mise à jour:</strong> {{$book->updated_at}}</p>
    <p><strong>Status:</strong> {{$book->status}}</p>
    <h2><b>Les auteurs:</b></h2>
    <ul>
      <li><strong>Nombre d'auteur(s):</strong> {{$book->authors->count()}}</li>
      @forelse($book->authors as $author)
      <li>{{$author->name}}</li>
      @empty
      <p>Aucun auteur</p>
      @endforelse
    </ul>

  </div>
  <div class="col-6">
    <div>
      <h2><b>Image</b></h2>
      @if(isset($book->picture))
      <img src="{{asset('images/'.$book->picture->link)}}" alt="Image du book" style="max-width: 100%; padding-top:50px">
      @else
      <p>Aucune image</p>
      @endif
    </div>
  </div>
</div>

@endif
@endsection
