<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    private const DATA = [
        ['name' => 'Еда',],
        ['name' => 'Здоровье',],
        ['name' => 'Развлечения',],
        ['name' => 'Транспорт',],
        ['name' => 'Услуги',],
        ['name' => 'Квартира',],
        ['name' => 'Фонд',],
        ['name' => 'Питомцы',],
        ['name' => 'Свободные',],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::DATA as $value) {
            DB::table('categories')->insert([
                'name' => $value['name'],
            ]);
        }
    }
}
