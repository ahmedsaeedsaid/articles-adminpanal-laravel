<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Auth\User;
use App\Models\ArticleCategory;
use Faker\Generator as Faker;

$factory->define(ArticleCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'status' => $faker->boolean,
        'created_by' => function () {
            return factory(User::class)->state('active')->create()->id;
        },
    ];
});
