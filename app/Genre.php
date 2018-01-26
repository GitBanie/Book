<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    //Recuperer tous les livres d'un genre
    public function books()
    {
      return $this->hasMany(Book::class);
    }
}
