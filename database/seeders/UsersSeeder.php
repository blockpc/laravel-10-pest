<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

final class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sudo = new User();
        $sudo->name = "sudo";
        $sudo->email = "sudo@mail.com";
        $sudo->password = Hash::make('sudo1234');
        $sudo->email_verified_at = now();
        $sudo->save();
        $sudo->profile()->create([
            'firstname' => 'Juan', 
            'lastname' => 'Carlos'
        ]);
        $sudo->assignRole('sudo');

        $admin = new User();
        $admin->name = "admin";
        $admin->email = "admin@mail.com";
        $admin->password = Hash::make('admin1234');
        $admin->email_verified_at = now();
        $admin->save();
        $admin->profile()->create([
            'firstname' => 'Jhon', 
            'lastname' => 'Doe'
        ]);
        $admin->assignRole('admin');

        $user = new User();
        $user->name = "user";
        $user->email = "user@mail.com";
        $user->password = Hash::make('user1234');
        $user->email_verified_at = now();
        $user->save();
        $user->profile()->create([
            'firstname' => 'Jane', 
            'lastname' => 'Donovan'
        ]);
        $user->assignRole('user');
    }
}