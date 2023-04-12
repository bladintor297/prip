<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $defaultpwd = '12345678';
        $createMultipleUsers = [
            ['name' => 'NURUL HANANIE BINTI MAZLAN', 'email' => 'hananie.mazlan@mohe.gov.my', 'password'=>bcrypt($defaultpwd), 'role' => '1', 'no_kp' => '830803065274', 'telefon' => '0129470387', 'gred' => 'DH44', 'bidang' => 'KEJURUTERAAN ELEKTRIK', 'program' => 'KEJURUTERAAN ELEKTRIK', 'polikk' => 'JABATAN PENDIDIKAN POLITEKNIK DAN KOLEJ KOMUNITI', 'negeri' => 'SELANGOR', 'emel_google' => '-', 'bulan_lantikan' => 'Disember', 'tahun_lantikan' => '2021', 'status' => '1', 'bil_aktiviti' => '0'],
            ['name' => 'MOHD IDHAM BIN ANUR', 'email' => 'idhamanur@gmail.com', 'password'=>bcrypt($defaultpwd), 'role' => '1', 'no_kp' => '810826065738', 'telefon' => '0187673729', 'gred' => 'DH52', 'bidang' => 'PERKOMPUTERAN', 'program' => 'KEJURUTERAAN PERISIAN', 'polikk' => 'POLITEKNIK TUN SYED NASIR SYED ISMAIL', 'negeri' => 'JOHOR', 'emel_google' => 'idhamanur@gmail.com', 'bulan_lantikan' => 'Disember', 'tahun_lantikan' => '2021', 'status' => '1', 'bil_aktiviti' => '0'],
        ];
        
        User::insert($createMultipleUsers);
    }
}
