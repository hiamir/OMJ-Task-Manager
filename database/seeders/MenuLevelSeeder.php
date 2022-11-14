<?php

namespace Database\Seeders;

use App\Models\MenuLevel;
use Illuminate\Database\Seeder;

class MenuLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MenuLevel::create([ 'name' => 'Parent']);
        MenuLevel::create([ 'name' => 'Child 1']);
        MenuLevel::create([ 'name' => 'Child 2']);
    }
}
