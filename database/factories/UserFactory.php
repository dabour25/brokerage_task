<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Customers;
use App\Actions;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
//For Test Mode Only !!!
$factory->define(Customers::class, function (Faker $faker) {
	$name=$faker->unique()->name;
    return [
        'customer_name' => $name,
        'type' => $faker->randomElement(['corporate', 'individual']),
        'slug' =>Str::slug($name),
		'user_id' =>1,
    ];
});

$factory->define(Actions::class, function (Faker $faker) {
	$details=Str::random(100);
    return [
		'type' => $faker->randomElement(['call', 'visit']),
        'phone_no' => rand(0, 1000000),
        'details' => $details,
		'slug' =>Str::slug($details),
		'customer_id'=>rand(1, 5000),
		'user_id'=> 1,
    ];
});
