<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DrinkSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('drinks')->insert([
            [
                'name' => 'Кола',
                'description' => 'Кола зеро.',
                'price' => 103.00,
                'image' => 'cola.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Пепси',
                'description' => 'Диетическая пепси.',
                'price' => 103.50,
                'image' => 'pepsi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Моча ',
                'description' => 'Моча привокзального карлика.',
                'price' => 123.50,
                'image' => 'pepsi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Луджин',
                'description' => 'Напиток из лужы.',
                'price' => 123.50,
                'image' => 'pepsi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Фэйри',
                'description' => 'Тупа фейри.',
                'price' => 113.50,
                'image' => 'pepsi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Компот',
                'description' => 'Бабкин компот из погреба.',
                'price' => 777.77,
                'image' => 'pepsi.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
