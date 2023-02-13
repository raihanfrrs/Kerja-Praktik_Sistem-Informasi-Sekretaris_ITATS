<?php

namespace Database\Seeders;

use App\Models\Dosen;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dosen = [
            [
                'name' => 'Bethelsando Gemilang Wahyudi',
                'slug' => 'bethelsando-gemilang-wahyudi',
                'nip' => '09991',
                'email' => 'bethelsando123@gmail.com',
                'phone' => '087823312332',
                'gender' => 'male',
                'role' => 'create,read,update,delete',
                'user_id' => '3',
                'status' => 'active'
            ],
            [
                'name' => 'Sahnon Bamakerti',
                'slug' => 'sahnon-bamakerti',
                'nip' => '09992',
                'email' => 'sahnonbamakerti123@gmail.com',
                'phone' => '0812434342234',
                'gender' => 'male',
                'role' => 'create',
                'user_id' => '4',
                'status' => 'recycle'
            ],
            [
                'name' => 'Danu Septi Adi',
                'slug' => 'danu-septi-adi',
                'nip' => '09993',
                'email' => 'danuseptiadi123@gmail.com',
                'phone' => '0878213132321',
                'gender' => 'male',
                'user_id' => '5',
                'status' => 'active'
            ]
        ];

        foreach($dosen as $key => $value){
            Dosen::create($value);
        }
    }
}
