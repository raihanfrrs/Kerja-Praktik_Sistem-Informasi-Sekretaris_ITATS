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
                'jenis' => 'DHS'
            ],
            [
                'role_id' => '2',
                'jenis' => 'Aktif Kuliah'
            ]
        ];

        foreach ($jenisSurat as $key => $value) {
            JenisSurat::create($value);
        }
    }
}
