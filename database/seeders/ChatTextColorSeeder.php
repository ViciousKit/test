<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatTextColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chat_text_colors')->insert([
            'chat_text_color' => 'black'
        ]);
        DB::table('chat_text_colors')->insert([
            'chat_text_color' => 'red'
        ]);
        DB::table('chat_text_colors')->insert([
            'chat_text_color' => 'blue'
        ]);
        DB::table('chat_text_colors')->insert([
            'chat_text_color' => 'yellow'
        ]);
    }
}
