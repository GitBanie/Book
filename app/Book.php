<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Book extends Model
{
    protected $fillable = [
      'title', 'description', 'genre_id', 'status'
  ];

    // public function setTitleAttribute($value)
    // {
    //   //Mettre la 1 lettre en maj
    //   $this->attribute['title'] = ucfirst($value);
    // }

    //Ici le setter va récupérer la valeur à insérer en base de données
    //Nous pourrons alors vérifier sa valeur avant que le modèle n'insère la données
    //En bdd
    public function setGenreIdAttribute($value)
    {
        if ($value == 0) {
            $this->attributes['genre_id'] = null; //Mettra la valeur null dans la bdd
        } else {
            $this->attributes['genre_id'] = $value;
        }
    }

    //Local scope
    public function scopePublished($query)
    {
      # un scope permettra de modifier la requête Eloquent standard
      return $query->where('status','published');
    }

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

    //Ajout d'un accessor, pour le fun
    public function shuffle($value)
    {
        return str_shuffle($value);
    }

    //Ajout d'un scope global

    // protected static function boot()
    // {
    //     parent::boot();
    //
    //     static::addGlobalScope('status', function (Builder $builder) {
    //         $builder->where('status', 'published');
    //     });
    // }
  }
