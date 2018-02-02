<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Generer sois meme une valeur, Si valeur aléatoire, utiliser factory
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.fr',
            'password' =>  bcrypt('admin'), //Cryptage du mdp
        ]);
    }
}
