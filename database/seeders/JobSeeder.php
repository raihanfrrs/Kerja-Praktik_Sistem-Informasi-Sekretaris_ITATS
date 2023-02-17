<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
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
                'job' => 'Sekretaris Jurusan, CSR'
            ],
            [
                'dosen_id' => '2',
                'job' => 'Sekretaris Jurusan'
            ]
        ];

        foreach ($jobs as $key => $value) {
            Job::create($value);
        }
    }
}
