<?php

namespace Exit11\Article\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use Exit11\Article\Models\Popup;

class PopupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Popup::truncate();
        factory(Popup::class, 80)->create();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
