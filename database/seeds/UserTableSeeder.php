<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'     => 'Administrator',
            'username' => 'admin',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('admin'),
        ]);
        DB::table('users')->insert([
            'name'     => 'Data dan Informasi',
            'username' => 'datainformasi',
            'email'    => 'datainformasi@gmail.com',
            'password' => Hash::make('datainformasi'),
        ]);
        DB::table('users')->insert([
            'name'     => 'Bidang Mutasi',
            'username' => 'bidangmutasi',
            'email'    => 'bidangmutasi@gmail.com',
            'password' => Hash::make('bidangmutasi'),
        ]);
        DB::table('users')->insert([
            'name'     => 'Pegawai',
            'username' => 'pegawai',
            'email'    => 'pegawai@gmail.com',
            'password' => Hash::make('pegawai'),
        ]);
    }
}
