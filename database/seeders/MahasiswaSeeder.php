<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mahasiswa = [
            [
                'name' => 'Mohamad Raihan Farras',
                'slug' => 'mohamad-raihan-farras',
                'npm' => '062020107330',
                'email' => 'rehanfarras76@gmail.com',
                'phone' => '081333903187',
                'gender' => 'male',
                'user_id' => '1',
                'status' => 'disapprove'
            ],
            [
                'name' => 'Agung Widodo',
                'slug' => 'agung-widodo',
                'npm' => '062020107312',
                'email' => 'agungwidodo76@gmail.com',
                'phone' => '08187438923',
                'gender' => 'male',
                'user_id' => '2',
                'status' => 'disapprove'
            ]
        ];

        foreach($mahasiswa as $key => $value){
            Mahasiswa::create($value);
        }
    }
}
