<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ########### OTHERS
        $others = new Category();
        $others->name = 'Others';
        $others->slug = 'others';
        $others->save();
    }
}
