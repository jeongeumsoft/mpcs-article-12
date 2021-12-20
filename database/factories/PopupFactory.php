<?php

/** 
 * @var \Illuminate\Database\Eloquent\Factory $factory 
 **/

use Exit11\Article\Models\Popup;
use Mpcs\Core\Models\User;

use Faker\Generator as Faker;

use MpcsUi\Bootstrap5\Bootstrap5;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Carbon\Carbon;

$factory->define(Popup::class, function (Faker $faker) {
    $title = $faker->sentence();
    $dateBetween = $faker->dateTimeBetween('-30 days', '+30 days', 'ASIA/SEOUL');
    $period_from = Carbon::createFromTimestamp($dateBetween->getTimeStamp());
    $period_to = Carbon::createFromFormat('Y-m-d H:i:s', $period_from)->addDays($faker->numberBetween(1, 15));
    $date = $faker->dateTimeThisMonth;

    // 이미지 랜덤 생성 FAKER
    $ratio = ['400', '500', '600', '700', '800', '900'];
    $aspectRatio = Arr::random($ratio) . "x" . Arr::random($ratio);
    $image = 'https://via.placeholder.com/' . $aspectRatio . '.jpg';
    $imageName = round(microtime(true) * 1000) . '_' . Str::random(10) . '.jpg';
    $manager = new ImageManager(array('driver' => 'gd'));
    $manager->make($image)->save(storage_path('app/public/uploads/popups/' . $imageName));

    return [
        'order' => function () {
            $max = Popup::max('order');
            return $max + 1;
        },
        'type' => $faker->boolean,
        'title' => $title,
        'content' => $faker->paragraph(),
        'image' => Bootstrap5::generateThumb('popups', $imageName),
        'background_color' => $faker->hexColor,
        'url' => $faker->url,
        'target' => $faker->boolean,
        'period_from' => $period_from,
        'period_to' => $period_to,
        'is_visible' => $faker->boolean,
        'user_id' => User::inRandomOrder()->first(),
        'created_at' => $date,
        'updated_at' => $date,
    ];
});
