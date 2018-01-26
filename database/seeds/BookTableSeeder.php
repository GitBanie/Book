<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class BookTableSeeder extends Seeder
{
    private $faker;

    // injection de dépendance
    public function __construct(Faker $faker)
    {
        $this->faker = $faker; // Laravel qui injectera le composant Faker directement
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      //On prend garde de bien supprimer les images avant de commencer le Seeder
        Storage::disk('local')->delete(Storage::allFiles());

        // factory(App\Book::class, 10)->create()->each(function($book){
        // });


        // Création de genre, vu que les genres sont limité on peut les crées nous meme

        App\Genre::create([
          'name' => 'science'
        ]);
        App\Genre::create([
          'name' => 'maths'
        ]);
        App\Genre::create([
          'name' => 'cookbook'
        ]);

        //Création de 30 livres avec factory
        factory(App\Book::class, 30)->create()->each(function ($book) {
            //Association d'un genre avec un livre aléatoirement
            $genre = App\Genre::find(rand(1, 3));

            //Pour chaque book on lui associe un genre particulier
            $book->genre()->associate($genre);
            $book->save(); //On sauvegarde l'association pour la faire persister dans la bdd

            //Ajout d'images
            $random = str_random(12);
            $link = $random . '.jpg'; // hash de lien pour la sécurité
            $file = file_get_contents('http://lorempicsum.com/futurama/627/300/' . rand(1, 9));
            Storage::disk("local")->put($link, $file);

            $book->picture()->create([
            'title' => 'Default', //Valeur par defaut
            'link' => $link
          ]);

            //pluck renvoie un tableau de tous les id de la table
            //Slice coupe le tableau avec comme parametre 1/indice du tableau de commencement,en commencant par 0
            // 2/ longueur

            //C'est la méthode qui permet de relier 2 tables lié avec une table d'association

            //Ici on fait la requete pour qu'un livre est 0 à 3 auteurs par livres
            $authors = App\Author::pluck('id')->shuffle()->slice(0, rand(1, 3))->all();
            //On fait la liaison
            $book->authors()->attach($authors);
        });
    }
}
