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
                'slug' => 'sekretaris-jurusan'
            ],
            [
                'role' => 'CSR',
                'slug' => 'csr'
            ]
        ];

        foreach ($roles as $key => $value) {
            Role::create($value);
        }
    }
}
