<?php


namespace Database\Seeders;


use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    public function run()
    {
        $positions = [
            [
                'id'         => 1,
                'name'       => 'Администратор',
                'salary' => '150000',
            ],
            [
                'id'         => 2,
                'name'       => 'Официант',
                'salary' => '130000',
            ],
            [
                'id'         => 3,
                'name'       => 'Кассир',
                'salary' => '120000',
            ],
            [
                'id'         => 4,
                'name'       => 'Повар',
                'salary' => '200000',
            ]
        ];
        Position::insert($positions);
    }
}
