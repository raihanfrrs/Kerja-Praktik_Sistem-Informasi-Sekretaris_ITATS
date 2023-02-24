<?php

namespace Database\Seeders;

use App\Models\JenisSurat;
use Illuminate\Database\Seeder;

class JenisSuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jenisSurat = [
            [
                'jenis' => 'DHS',
                'slug' => 'dhs',
                'status' => 'active'
            ],
            [
                'jenis' => 'Aktif Kuliah',
                'slug' => 'aktif-kuliah',
                'status' => 'active'
            ],
            [
                'jenis' => 'MBKM',
                'slug' => 'mbkm',
                'status' => 'active'
            ]
        ];

        foreach ($jenisSurat as $key => $value) {
            JenisSurat::create($value);
        }
    }
}
