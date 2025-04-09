<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DefaultMessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ai_default_messages')->insert([
            'content' => '¿De qué puedo hablar con Cashimiro?',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('ai_default_messages')->insert([
            'content' => '¿Cuáles son los beneficios de usar Cashi?',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
        DB::table('ai_default_messages')->insert([
            'content' => '¿Qué necesito para tener una cuenta?',
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

    }
}
