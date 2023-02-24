<?php

namespace Database\Seeders;

use App\Models\Surat;
use Illuminate\Database\Seeder;

class SuratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $surats = [
            [
                'jenis_surat_id' => '3',
                'name' => 'Surat Rekomendasi',
                'description' => 'Surat yang bertujuan untuk meminta kepada pihak kampus rekomendasi terhadap pilihan bidang mbkm yang telah dipilih mahasiswa.'
            ],
            [
                'jenis_surat_id' => '3',
                'name' => 'SPTJM',
                'description' => 'test'
            ]
        ];

        foreach ($surats as $key => $value) {
            Surat::create($value);
        }
    }
}
