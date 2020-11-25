<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
// use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

// class AuthServiceProvider extends ServiceProvider
// {
//     /** 
//      * 
//      * * The policy mappings for the application. 
//     * 
//     * @var array */
//      protected $policies=[ 
//          'App\Model'=> 'App\Policies\ModelPolicy',
//         ]; 
//     /** * Register any authentication / authorization services. 
//      * * * @return void */
//         public function boot() 
//         {
//             $this->registerPolicies(); 
//             Passport::routes();
//         }
// }

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
