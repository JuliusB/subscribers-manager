<?php

use App\Components\Subscribers\FieldsManager;
use App\Components\Subscribers\Models\Field;
use Faker\Generator as Faker;

$factory->define(Field::class, function (Faker $faker) {

    $title = $faker->unique()->words(2, true);

    return [
        'title' => $title,
        'tag'  => str_slug($title),
        'type' => $faker->randomElement(FieldsManager::TYPES),
    ];
});
