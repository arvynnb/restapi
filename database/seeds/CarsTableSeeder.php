<?php

use App\Car;
use Illuminate\Database\Seeder;
use Illuminate\Database\factories\CarFactory;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Car::class, 5000)->create()->each(function ($u) {
            $u->save(factory(App\Car::class)->make());
        });
    }
}
