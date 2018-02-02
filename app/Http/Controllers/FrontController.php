<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cache;
use App\Book;
use App\Author;
use App\Genre;
use App\Score;

class FrontController extends Controller
{
    public function __construct()
    {
        //Methode pour injecter des donnée a une vue partiel
        view()->composer('partials.menu', function ($view) {
            $genres = Genre::pluck('name', 'id')->all(); //On récupere un tableau associatif
            $view->with('genres', $genres); //On passe les données a la vue
        });
    }

    public function index()
    {
        // $books =  Book::published()->with('picture', 'authors', 'score')->paginate(5);
    //Optimisation du cache, lorsqu'il y a une pagination donc s'il existe une page
    $prefix = request()->page?? 'home'; // $_GET['page']?? 'home'
    if ($prefix != 'home' and $prefix == 100) {
        $prefix = 'home';
    }

        //le prefix est le parametre passer dans une autre page, 1 ou 2 ... nombre de page
    $key = 'book' . $prefix; // Donc path, on ajoute book + le parametre de la page
    //$key, le nom du cache, 1, le nombre de minute, function à executer
    $books = Cache::remember($key, 1, function () {
        //Attention, le préfix « scope» n’est pas présent sur le modèle Book (convention)
        //Mise en place d'un pivot, pour limiter les requetes many to many
        // Avec globalscope
        // return Book::with('picture', 'authors', 'score')->paginate(5);
        //Sans globalscope
        return Book::published()->with('picture', 'authors', 'score')->paginate(5);
    });
        return view('front.index', ['books' => $books]);
    }

    public function show(int $id)
    {
        $book = Book::find($id);
        return view('front.show', ['book' => $book]); //Retourne un livre
    }

    public function showBookByAuthor(int $id)
    {
        $prefix = request()->page?? '1';
        $key = 'author' . $prefix;

        $books = Cache::remember($key, 100, function () use ($id) {
            return Author::find($id)->books()->paginate(5);
        });

        // $books = Author::find($id)->books()->with('authors', 'score')->paginate(5); // Tous les livres d'un auteur
        $author = Author::find($id);
        //On passe a la vue
        return view('front.author', ['books' => $books, 'author' => $author]);
    }

    public function showBookByGenre(int $id)
    {
        //S'il existe une page, sinon on l'appel genre
        $prefix = request()->page?? '1';
        $key = 'genre' . $prefix;


        $books = Cache::remember($key, 100, function () use ($id) {
            return Genre::find($id)->books()->paginate(5);
        });

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
