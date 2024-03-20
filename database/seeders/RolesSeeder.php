<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'bawaslu-provinsi']);
        Role::create(['name' => 'bawaslu-kota']);
        Role::create(['name' => 'panwascam']);
    }
}
