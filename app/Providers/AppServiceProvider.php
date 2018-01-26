<?php

namespace App\Providers;
use App\Score;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        // on va étendre les règles de la classe Validator
        //  $attribute, book_id
        //  $value, la valeur de book_id
        //  $parameters, valeur qui est envoyer
        Validator::extend('uniqueVoteIp', function ($attribute, $value, $parameters, $validator) {
            $query = Score::where('ip', $parameters[0])->where('book_id', $value)->count();
            if($query ==0){
              return true;
            }
            else {
              return false;
            }
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
