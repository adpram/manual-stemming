<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TfidfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tfidfs')->insert([
            'artikel1' => "tes",
            'artikel2' => "tes",
            'artikel3' => "tes",
            'artikel4' => "tes",
        ]);
    }
}
