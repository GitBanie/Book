@extends('layouts.master')
@section('content')

@if($book->count())
<!-- Blog Post -->
<div class="card mb-4" style="margin-top:20px">
  @if($book->picture->count() > 0)
  <img class="card-img-top" src="{{asset('images/'.$book->picture->link)}}" alt="{{$book->picture->title}}">
  @endif
  <div class="card-body">
    <h2 class="card-title">{{$book->title}}</h2>
    <p class="card-text">{{$book->description}}</p>
    <p class="card-text">
        <!-- Afficher les erreurs -->
      @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
      @endif

      <!-- Message de confirmation de vote -->
      @if(Session::has('message'))
          <div class="alert alert-success">
              <p>{{Session::get('message')}}</p>
          </div>
      @endif

      <form method="post" action="{{route('vote')}}">
        {{ csrf_field() }}
        <input type="hidden" name="book_id" value="{{$book->id}}">
        <input type="hidden" name="ip" value="{{request()->ip()}}">
        <fieldset class="form-group">
          <label for="exampleSelect1"><h2>Voter pour ce livre</h2></label>
          <select class="form-control" id="exampleSelect1" name="vote">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
          </select>
        </fieldset>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </p>
  </div>
  <div class="card-footer text-muted">
    Posted on {{$book->created_at}} by
    @forelse($book->authors as $author)
    <a href="{{url('author', $author->id)}}">{{$author->name}}</a>
    @empty
    <small>Aucun auteur</small>
    @endforelse
    @if($book->score->count() > 0)
    <span>Score de {{$book->score->pluck('vote')->slice(0, 2)->avg()}} sur 5</span>
    <span><b>({{$book->score->count()}})</b></span>
    @endif
  </div>
</div>
@endif
@endsection
