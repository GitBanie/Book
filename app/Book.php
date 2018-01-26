<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function genre()
    {
      return $this->belongsTo(Genre::class);
    }

    public function authors()
    {
      return $this->belongsToMany(Author::class);
    }

    public function picture()
    {
      return $this->hasOne(Picture::class);
    }

    public function score()
    {
      return $this->hasMany(Score::class);
    }

    // //On peut mettre des requetes complexes dans des methodes
    // public function avgVotes()
    // {
    //   return $this->score()->avg('vote')??0;

    // Pour l'utiliser on fait un $book->avgVotes()
    // }
}
