<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            [
                'name'=>'image',
                'value'=>'image.jpg',
            ],
            [
                'name'=>'title',
                'value'=>'Title',
            ],
            [
                'name'=>'welcome',
                'value'=>'wellcome here',
            ],
            [
                'name'=>'footer',
                'value'=>'Copyright',
            ],
        ]);
    }
}
