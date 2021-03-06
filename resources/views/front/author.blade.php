@extends('layouts.master')

@section('content')
<h1 class="my-4">Livres de {{$author->name}}</h1>
<!-- S'il existe des livres -->
@if($books->count())
  {!!$books->links('vendor.pagination.bootstrap-4');!!}
  @forelse($books as $book)
  <article>
    <div class="card mb-4">
      <!-- On test s'il existe un enregistrement -->
      @if($book->picture->count())
      <img class="card-img-top" src="{{asset('images/'.$book->picture->link)}}" alt="{{$book->picture->title}}">
      @endif
      <div class="card-body">
        <h2 class="card-title">{{$book->title}}</h2>
        <p class="card-text">{{$book->description}}</p>
        <a href="{{url('book', $book->id)}}" class="btn btn-primary">En savoir plus &rarr;</a>
      </div>
      <div class="card-footer text-muted">
        Posted on {{$book->created_at}} by
        @forelse($book->authors as $author)
        <a href="{{url('author', $author->id)}}" style="margin:5px">{{$author->name}}</a>
        @empty
        <small>Aucun auteur</small>
        @endforelse
        @if($book->score->count())
        <span>Score de {{$book->score->pluck('vote')->slice(0, 2)->avg()}} sur 5</span>
        @endif
      </div>
    </div>
  </article>
  @empty
  <p>Pas d'articles</p>
  @endforelse
@endif
@endsection
