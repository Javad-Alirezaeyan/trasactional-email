<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

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

$factory->define(App\Email::class, function (Faker $faker) {
    $to =[];
    for($i = 0; $i < 3; $i++){
        array_push($to, $faker->freeEmail);
    }
    $to = implode(',', $to);

    $text = $faker->text;
    $objParse  = new \App\Library\Parsemarkdown();
    $textparse =  $objParse->text($text);

    return [
        'email_subject' => $faker->sentence,
        'email_contentValue' => $text,
        'email_orginalContent' => $textparse,
        'email_state' => EmailQueued,
        'email_to' => $to,
        'email_from'=> $faker->freeEmail,
        'created_at'=> time()
    ];
});
