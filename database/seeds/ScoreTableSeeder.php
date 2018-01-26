<?php

use Illuminate\Database\Seeder;

class ScoreTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        //Création de 100 notes avec factory
        factory(App\Score::class, 100)->create()->each(function ($score) {

          //Recupérer la moyenne des notes d'un livres

        });
    }
}
