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
                'job' => 'DHS, Aktif Kuliah'
            ],
            [
                'role_id' => '2',
                'job' => 'DHS'
            ]
        ];

        foreach ($jobs as $key => $value) {
            JobRole::create($value);
        }
    }
}
