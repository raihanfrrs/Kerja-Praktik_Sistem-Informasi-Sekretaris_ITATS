<?php

namespace Database\Seeders;

use App\Models\JobDosen;
use Illuminate\Database\Seeder;

class JobDosenSeeder extends Seeder
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
                'dosen_id' => '1',
                'role_id' => '1'
            ],
            [
                'dosen_id' => '1',
                'role_id' => '1'
            ],
            [
                'dosen_id' => '2',
                'role_id' => '1'
            ]
        ];

        foreach ($jobs as $key => $value) {
            JobDosen::create($value);
        }
    }
}
