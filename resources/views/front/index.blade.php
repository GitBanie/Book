@extends('layouts.master')

@section('content')


<h1 class="my-4">Tous les livres</h1>
@if(isset($books))
  <!-- Pagination utilisant le template de bootstrap4 -->
  {!!$books->links('vendor.pagination.bootstrap-4');!!}
    <!-- Boucle comme le foreach sauf qu'on peut gerer le cas ou il n'y a pas de valeur -->
    @forelse($books as $book)
    <!-- Blog Post -->
    <article>
      <div class="card mb-4" style="">
        <!-- On test s'il existe un enregistrement -->
        @if(isset($book->picture))
        <img class="card-img-top" src="{{asset('images/'.$book->picture->link)}}" alt="{{$book->picture->title}}">
        @endif
        <div class="card-body">
          <!-- On met un accessors (ici pour le fun) -->
          <h2 class="card-title">{{$book->title}}</h2>
          {{-- <h2 class="card-title">{{$book->shuffle($book->title)}}</h2>  --}}
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
          <span><b>({{$book->score->count()}})</b></span>
          @endif
        </div>
      </div>
    </article>

@empty
<p>Désolé aucun livre</p>
@endforelse
{!!$books->links('vendor.pagination.bootstrap-4');!!}
@endif
@endsection
