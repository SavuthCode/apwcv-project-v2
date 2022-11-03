<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class CreateUsersSeeder extends Seeder
{
    public function run()
    {
        $user = [
            [
               'first_name'=>'Neak',
               'last_name'=>'Sophea',
               'phone'=>'0962570987',
               'email'=>'admin@gmail.com',
               'password'=> bcrypt('123456'),
               'image'=> '',
               'is_active'=> true,
               'role_id'=> 1,
            ],
            [
                'first_name'=>'Ven',
                'last_name'=>'Sokvuth',
                'phone'=>'086880690',
                'email'=>'user@gmail.com',
                'password'=> bcrypt('123456'),
                'image'=> '',
                'is_active'=> true,
                'role_id'=> 2,
            ],
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
