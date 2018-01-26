<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    //Le fillable est utiliser lors de l'insertion de donnée de formulaire
    // Avec le $score = Score::create(request()->all());
    protected $fillable = ['ip', 'book_id', 'vote'];

    public function books()
    {
      return $this->belongsTo(Book::class);
    }
}
