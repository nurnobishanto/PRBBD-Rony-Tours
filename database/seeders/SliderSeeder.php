<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 1; $i <= 7; $i++)
        {
            Slider::create([
                'title' => 'Demo title '.$i,
                'image' => 'seed_slider/big-img'.$i.'.png',
            ]);
        }
    }
}
