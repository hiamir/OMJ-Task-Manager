<?php

namespace Database\Seeders;

use App\Models\Guard;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Guard::create([ 'name' => 'Administrator','code'=>'admin']);
        Guard::create([ 'name' => 'User','code'=>'web']);
    }
}
