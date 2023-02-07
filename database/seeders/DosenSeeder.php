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
                'nip' => '09991',
                'email' => 'bethelsando123@gmail.com',
                'phone' => '087823312332',
                'gender' => 'male',
                'role' => 'create,read,update,delete',
                'user_id' => '2'
            ],
            [
                'name' => 'Danu Septi Adi',
                'nip' => '09992',
                'email' => 'danuseptiadi123@gmail.com',
                'phone' => '0878213132321',
                'gender' => 'male',
                'role' => 'create,read',
                'user_id' => '3'
            ]
        ];

        foreach($dosen as $key => $value){
            Dosen::create($value);
        }
    }
}
