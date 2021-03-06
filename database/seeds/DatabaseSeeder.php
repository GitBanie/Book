<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $this->call(AuthorTableSeeder::class);
        $this->call(BookTableSeeder::class);
        $this->call(ScoreTableSeeder::class);
        $this->call(UserTableSeeder::class);

        //Autre seeders, ici c'est le fichier qui etablie l'ordres des seeders(creation de fausse donnée)
    }
}
