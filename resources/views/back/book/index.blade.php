@extends('layouts.master')

@section('content')

<!-- S'il existe des livres -->
@if($books->count())
<div class="add" style="padding-top:20px">
  <a  style="padding: 10px" href="{{route('book.create')}}" class="btn btn-primary">Ajouter un livre &rarr;</a>
</div>
<!-- Pagination -->
{{$books->links()}}

@include('back.book.partials.flash')

<table class="table table-striped">
    <thead>
        <tr>
            <th>Title</th>
            <th>Authors</th>
	    <th>Genre</th>
            <th>Date de publication</th>
            <th>Status</th>
            <th>Edition</th>
            <th>Show</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
    @forelse($books as $book)
        <tr>
            <td><a href="{{route('book.edit', $book->id)}}" title="Modifier le livre">{{$book->title}}</a></td>
            <td>
            @forelse($book->authors as $author)
                {{$author->name}} /
            @empty
            Aucun auteur
            @endforelse
            </td>
	          <td>{{$book->genre->name?? 'Aucun genre' }}</td>
            <td>{{$book->created_at}}</td>
            @if($book->status == 'published')
            <td class="text-success" style="margin-top:1rem;">{{$book->status}}</td>
            @else
            <td class="text-secondary" style="margin-top:1rem;">{{$book->status}}</td>
            @endif
            <td>
                <a href="{{route('book.edit', $book->id)}}"><span class="glyphicon glyphicon-check" aria-hidden="true" style="padding-left: 1.5rem; color:black"></span></a>
            </td>
            <td>
                <a href="{{route('book.show', $book->id)}}"><span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="padding-left: 0.7rem;"></span></a>
            </td>
            <td>
              <form class="delete" action="{{route('book.destroy', $book->id)}}" method="post">
              {{ csrf_field() }}
              {{ method_field('DELETE') }}
              <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
        </tr>
    @empty
        aucun titre ...
    @endforelse
    </tbody>
</table>

{{$books->links()}}

@endif
@endsection

@section('scripts')
    @parent
    <script src="{{asset('js/confirm.js')}}"></script>
@endsection
