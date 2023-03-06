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
                'user_id' => '4',
                'status' => 'active'
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
            ],
            [
                'name' => 'Anindya Cahyani Putri',
                'slug' => 'anindya-cahyani-putri',
                'nip' => '09994',
                'email' => 'anindyacahyaniputri123@gmail.com',
                'phone' => '0834454542223',
                'gender' => 'female',
                'user_id' => '6',
                'status' => 'active'
            ]
        ];

        foreach($dosen as $key => $value){
            Dosen::create($value);
        }
    }
}
