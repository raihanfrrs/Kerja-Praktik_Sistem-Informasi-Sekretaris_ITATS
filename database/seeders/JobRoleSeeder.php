<?php

namespace Database\Seeders;

use App\Models\JobRole;
use Illuminate\Database\Seeder;

class JobRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jobs = [
            [
                'role_id' => '1',
                'jenis_surat_id' => '1'
            ],
            [
                'role_id' => '1',
                'jenis_surat_id' => '2'
            ],
            [
                'role_id' => '2',
                'jenis_surat_id' => '1'
            ]
        ];

        foreach ($jobs as $key => $value) {
            JobRole::create($value);
        }
    }
}
