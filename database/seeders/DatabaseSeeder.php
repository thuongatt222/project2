<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $user = new User();
        $user->id = '1';
        $user->name = 'Admin';
        $user->email = 'a@a';
        $user->password = 'aaaa';
$user->phone_number = '2134567';
        $user->cccd = '2134345567';
        $user->address = '34';
        $user->birthday = '2003-4-24';
        $user->save();
    }
}
