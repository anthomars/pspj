<?php

namespace Database\Seeders;

use App\Models\AppSetting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AppSetting::create([
            'nama_apps' => 'PSPJ',
            'logo_apps' => 'logo/pspj.png',
            'alamat' => 'PERUM GRIYA SERPONG ASRI - TANGERANG',
            'date_created' => now(),
        ]);
    }
}
