<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PizzaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pizzas')->insert([
            [
                'name' => 'Маргарита',
                'description' => 'Классическая пицца с томатами и моцареллой.',
                'price' => 650.50,
                'image' => 'margarita.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Пепперони',
                'description' => 'Пицца с колбасой пепперони.',
                'price' => 625.00,
                'image' => 'pepperoni.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Веганская',
                'description' => 'Пицца для геев.',
                'price' => 715.75,
                'image' => 'pepperoni.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Крэйзи пепперони',
                'description' => 'Пицца с колбасой пепперони крэйзи.',
                'price' => 721.00,
                'image' => 'pepperoni.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Хуеронни',
                'description' => 'Пицца с колбасой и членами.',
                'price' => 618.00,
                'image' => 'pepperoni.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Залупонни',
                'description' => 'Пицца с колбасой и залупами.',
                'price' => 733.00,
                'image' => 'pepperoni.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
