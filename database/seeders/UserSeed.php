<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name'           => 'admin',
                'email'          => 'adm.amiclc@gmail.com',
                'password'       => bcrypt('1324'),
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
