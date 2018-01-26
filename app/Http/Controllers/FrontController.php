<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Author;
use App\Genre;
use App\Score;

class FrontController extends Controller
{

  public function __construct()
  {
    //Methode pour injecter des donnée a une vue partiel
    view()->composer('partials.menu', function($view){
      $genres = Genre::pluck('name', 'id')->all(); //On récupere un tableau associatif
      $view->with('genres', $genres); //On passe les données a la vue

    });
  }

  public function index()
  {
    $books =  Book::paginate(5);

    return view('front.index', ['books' => $books]);
  }

    public function show(int $id)
    {
      $book = Book::find($id);
      return view('front.show', ['book' => $book]); //Retourne un livre
    }

    public function showBookByAuthor(int $id)
    {
      $books = Author::find($id)->books()->paginate(5); // Tous les livres d'un auteur
      $author = Author::find($id);
      //On passe a la vue
      return view('front.author', ['books' => $books, 'author' => $author]);
    }

    public function showBookByGenre(int $id)
    {
      $books = Genre::find($id)->books()->paginate(5);
      $genre = Genre::find($id);
      return view('front.genre', ['books' => $books, 'genre' => $genre]);
    }

    public function create(Request $request)
    {
      //Validation des champs
      // si une condition renvoie false => redirection vers le formulaire back()
       $this->validate($request, [
         //uniqueVoteIp à définir dans AppServiceProvider
         'book_id' => ['required', 'integer', "uniqueVoteIp:{$request->ip}"],
         'ip' => ['required', 'ip'],
         'vote' => ['required', 'integer', 'in:1,2,3,4,5'],
       ]);

       $score = Score::create(request()->all());
       // return back()->with('message', 'Merci pour votre vote');
       return back()->with('message', 'Merci pour votre vote');

    }
}
