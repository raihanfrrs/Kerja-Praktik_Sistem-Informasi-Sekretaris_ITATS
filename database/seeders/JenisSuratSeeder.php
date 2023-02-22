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
                'role_id' => '1',
                'jenis' => 'DHS',
                'status' => 'active'
            ],
            [
                'role_id' => '2',
                'jenis' => 'Aktif Kuliah',
                'status' => 'active'
            ]
        ];

        foreach ($jenisSurat as $key => $value) {
            JenisSurat::create($value);
        }
    }
}
