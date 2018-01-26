<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{

  //Ici books avec un s car on a une table de liaison entre books et authors, ainsi le Model
  // Book doit aussi avoir une méthode Authors

    public function books()
    {
      return $this->belongsToMany(Book::class);
    }
}
