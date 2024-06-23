<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama_lengkap' => 'PSPJ Pusat',
            'username' => 'pspj_pusat',
            'email' => 'pspj_pusat@gmail.com',
            'password' => '$2y$10$F7/qxOrwmxq6xT650aU8pOiTQ89CKwtpjX2OdVsk/3wmE7jGOuCGG', //password
            'is_active' => '1',
            'date_created' => now(),
            'no_hp' => '0810001000',
            'role_id' => 1,
            'rt_id' => 1,
            'rw_id' => 1,
            'author_create' => 'pspj_pusat',
            'author_update' => 'pspj_pusat',
            'nik' => '1234567890123456',
        ]);
        User::create([
            'nama_lengkap' => 'PSPJ Wilayah',
            'username' => 'pspj_wilayah',
            'email' => 'pspj_wilayah@gmail.com',
            'password' => '$2y$10$F7/qxOrwmxq6xT650aU8pOiTQ89CKwtpjX2OdVsk/3wmE7jGOuCGG', //password
            'is_active' => '1',
            'date_created' => now(),
            'no_hp' => '0810001010',
            'role_id' => 2,
            'rt_id' => 1,
            'rw_id' => 1,
            'author_create' => 'pspj_pusat',
            'author_update' => 'pspj_pusat',
            'nik' => '1234567890123456',
        ]);
        User::create([
            'nama_lengkap' => 'RW TEST',
            'username' => 'rw_test',
            'email' => 'rw_test@gmail.com',
            'password' => '$2y$10$F7/qxOrwmxq6xT650aU8pOiTQ89CKwtpjX2OdVsk/3wmE7jGOuCGG', //password
            'is_active' => '1',
            'date_created' => now(),
            'no_hp' => '0810002000',
            'role_id' => 3,
            'rt_id' => 1,
            'rw_id' => 1,
            'author_create' => 'pspj_pusat',
            'author_update' => 'pspj_pusat',
            'nik' => '1234567890123456',
        ]);
        User::create([
            'nama_lengkap' => 'RT TEST',
            'username' => 'rt_test',
            'email' => 'rt_test@gmail.com',
            'password' => '$2y$10$F7/qxOrwmxq6xT650aU8pOiTQ89CKwtpjX2OdVsk/3wmE7jGOuCGG', //password
            'is_active' => '1',
            'date_created' => now(),
            'no_hp' => '0810003000',
            'role_id' => 4,
            'rt_id' => 1,
            'rw_id' => 1,
            'author_create' => 'pspj_pusat',
            'author_update' => 'pspj_pusat',
            'nik' => '1234567890123456',
        ]);
        User::create([
            'nama_lengkap' => 'Warga TEST',
            'username' => 'warga_test',
            'email' => 'warga_test@gmail.com',
            'password' => '$2y$10$F7/qxOrwmxq6xT650aU8pOiTQ89CKwtpjX2OdVsk/3wmE7jGOuCGG', //password
            'is_active' => '1',
            'date_created' => now(),
            'no_hp' => '0810004000',
            'role_id' => 5,
            'rt_id' => 1,
            'rw_id' => 1,
            'author_create' => 'pspj_pusat',
            'author_update' => 'pspj_pusat',
            'nik' => '1234567890123456',
        ]);
    }
}
