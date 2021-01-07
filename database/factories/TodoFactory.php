<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$fakerVN = \Faker\Factory::create('vi_VN');
$factory->define(\App\Todo::class, function (Faker $faker) use ($fakerVN) {
    return [
        'name'        => $fakerVN->sentence(3),
        'description' => $fakerVN->paragraph(4),
        'completed'   => false 
    ];
});