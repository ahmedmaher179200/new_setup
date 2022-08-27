<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'username'  => 'ahmed1',
            'name'  => 'ahmed maher',
            'password'  => bcrypt('ahmed1'),
        ]);

        $user->attachRole('الادارة');
    }
}
