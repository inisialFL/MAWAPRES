<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;
use Carbon\Carbon;

class userSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('id_ID');

        $admin = User::create([
            'name'=>'Fitri Lestari',
            'email'=>'549.fitrilestari@gmail.com',
            'password'=>bcrypt('12345ok'),
        ]);
        $admin->role()->attach(['1','2']);

    }
}
