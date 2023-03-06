<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'role' => 'Sekretaris Jurusan',
                'slug' => 'sekretaris-jurusan',
                'status' => 'active'
            ],
            [
                'role' => 'CSR',
                'slug' => 'csr',
                'status' => 'active'
            ],
            [
                'role' => 'Tim MBKM',
                'slug' => 'tim-mbkm',
                'status' => 'active'
            ]
        ];

        foreach ($roles as $key => $value) {
            Role::create($value);
        }
    }
}
