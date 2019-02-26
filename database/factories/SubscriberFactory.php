<?php

use App\Components\Subscribers\Models\Subscriber;
use App\Components\Subscribers\SubscribersManager;
use Faker\Generator as Faker;

$factory->define(Subscriber::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->email,
        'name'  => $faker->firstName,
        'state' => $faker->randomElement(SubscribersManager::STATES),
    ];
});
