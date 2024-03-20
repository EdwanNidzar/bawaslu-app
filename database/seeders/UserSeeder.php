<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $provinsi = User::create([
            'name' => 'Bawaslu Provinsi',
            'username' => 'bawaslu-provinsi',
            'email' => 'provinsi@gmail.com',
            'password' => bcrypt('provinsi1234'),
        ]);
        $provinsi->assignRole('bawaslu-provinsi');

        $kota = User::create([
            'name' => 'Bawaslu Kota',
            'username' => 'bawaslu-kota',
            'email' => 'kota@gmail.com',
            'password' => bcrypt('kota1234'),
        ]);
        $kota->assignRole('bawaslu-kota');


        $panwascam = User::create([
            'name' => 'Panwascam',
            'username' => 'panwascam',
            'email' => 'panwascam@gmail.com',
            'password' => bcrypt('panwascam1234'),
        ]);
        $panwascam->assignRole('panwascam');

        $akun1 = User::create([
            'name' => 'Akun 1',
            'username' => 'akun1',
            'email' => 'akun1@gmail.com',
            'password' => bcrypt('akun1234'),
        ]);
        $akun1->assignRole('panwascam');

        $akun2 = User::create([
            'name' => 'Akun 2',
            'username' => 'akun2',
            'email' => 'akun2@gmail.com',
            'password' => bcrypt('akun1234'),
        ]);
        $akun2->assignRole('panwascam');

        $akun3 = User::create([
            'name' => 'Akun 3',
            'username' => 'akun3',
            'email' => 'akun3@gmail.com',
            'password' => bcrypt('akun1234'),
        ]);
        $akun3->assignRole('panwascam');

        $akun4 = User::create([
            'name' => 'Akun 4',
            'username' => 'akun4',
            'email' => 'akun4@gmail.com',
            'password' => bcrypt('akun1234'),
        ]);
        $akun4->assignRole('panwascam');
    }
}
