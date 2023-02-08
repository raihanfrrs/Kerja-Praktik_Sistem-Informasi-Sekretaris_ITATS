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
                'user_id' => '1'
            ]
        ];

        foreach($mahasiswa as $key => $value){
            Mahasiswa::create($value);
        }
    }
}
