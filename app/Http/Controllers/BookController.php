<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\BookRequest;
use Storage;
use App\Book;
use App\Author;
use App\Genre;

//Creation d'un controlleur de resource (CRUD), il a plusieurs méthodes qui permette d'afficher supprimer
//Modifier, crée ...

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //Liste de tout les $books

        //Enlever les global scope definis dans le model
        //Une requete Eloquent doit finir par get, paginate et all ... font un get() par défaut
        $books =  Book::paginate(10);
        // $books =  Book::paginate(10);


        return view('back.book.index', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Formulaire, envoie à store pour l'insertion des données dans la bdd
        $authors = Author::pluck('name', 'id')->all();
        $genres = Genre::pluck('name', 'id')->all();
        return view('back.book.create', ['authors' => $authors, 'genres' => $genres]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        //Recupération des données du formulaire
        // $this->validate($request, [
        //   'title' => ['required', 'string'],
        //   'description' => ['required', 'string'],
        //   'genre_id' => ['integer', 'in:0,1,2,3'],
        //   'authors' => 'required|array',
        //   'status' => 'in:published,unpublished',
        //   'picture' => 'image',
        // ]);
        //1 Hydratation de l'objet avec les données de la Request
        //2 Persiste en bdd => INSERT INTO ...
        //3 Retourne un nouvel objet hydrater avec les données de l'insert
        $book = Book::create($request->all());

        # Traitement d'image

        $im = $request->file('picture');

        // $title = $request->file('picture')->getClientOriginalName();
        if (!empty($im)) {

            //Methode store retourne un link hash sécurisé
            $link = $im->store('images');

            $book->picture()->create([
            'link' => $link,
            'title' => $request->title_image?? $request->title
          ]);
        }

        #liaison authors

        //On fait la liaison, car les auteurs sont en manyToMany, donc on récupére les auteurs sont un tableau
        //Et on utilise la méthode attach pour la relié à un livre
        //C'est de cette façon qu'on relie un manyToMany ou hasToMany
        $book->authors()->attach($request->authors);

        return redirect()->route('book.index')->with('message', 'Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::find($id);
        return view('back.book.show', ['book' => $book,]); //Retourne un livre
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Edit est la meme chose que create, elle est relié a une autre méthode de traitement de données
        //Qui est ici update
        $book = Book::find($id);
        $authors = Author::pluck('name', 'id')->all();
        $genres = Genre::pluck('name', 'id')->all();

        //Compact est un raccourci de
        //return view('back.book.edit', ['book' => $book ,'authors', $authors, 'genres' => $genres])
        return view('back.book.edit', compact('book', 'authors', 'genres', 'all_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Recuperation de l'id
        $book = Book::find($id);
        //Mise a jour des champs
        $book->update($request->all());
        //Détachement puis retachement des manyToMany
        $book->authors()->sync($request->authors);

        //Suppression de l'image si elle existe
        if(isset($book->picture)){
          if(!empty($request->file('picture'))){
            Storage::disk('local')->delete($book->picture->link); //Supprimer physiquement l'image
            $book->picture()->delete(); //Supprimer l'information en bdd
          }
        }

        # Traitement d'image

        $im = $request->file('picture');

        // $title = $request->file('picture')->getClientOriginalName();
        if (!empty($im)) {

            //Methode store retourne un link hash sécurisé
            $link = $im->store('images');

            $book->picture()->create([
            'link' => $link,
            'title' => $request->title_image?? $request->title
          ]);
        }

        return redirect()->route('book.index')->with('message', 'Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      //Recuperation de l'id
      $book = Book::find($id);
      //Suppression de l'image si elle existe
      if(isset($book->picture)){
        Storage::disk('local')->delete($book->picture->link); //Supprimer physiquement l'image
        $book->picture()->delete(); //Supprimer l'information en bdd
      }

      $book->delete();

      return redirect()->route('book.index')->with('message', 'Success');
    }
}
