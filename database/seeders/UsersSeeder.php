<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $initUsers = config('settings.init_users');
        foreach ($initUsers as $user) {
            $query = User::where('email', $user['email'])->first();
            if (empty($query)) {
                User::create($user);
            }
        }
    }
}
