<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=[
            [
                'name' => 'Super Administrator',
                'username' => 'superadmin',
                'password' => bcrypt('123456'),
                'nip' => '19872164861',
                'nidn' => '363717314',
                'id_level' => 1,
                'email' => 'superadmin@gmail.com',
                'email_verified_at' => now(),
                'is_approved' => true,
            ],
            [
                'name' => 'Administrator',
                'username' => 'admin',
                'password' => bcrypt('123456'),
                'nip' => '19872164861',
                'nidn' => '363717314',
                'id_level' => 2,
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'is_approved' => true,
            ],
            [
                'name' => 'Ketua',
                'username' => 'ketua',
                'password' => bcrypt('123456'),
                'nip' => '19872164861',
                'nidn' => '363717314',
                'id_level' => 3,
                'email' => 'ketua@gmail.com',
                'email_verified_at' => now(),
                'is_approved' => true,
            ],
        ];

        foreach($user as $key => $value){
            User::create($value);
        }
    }
}
