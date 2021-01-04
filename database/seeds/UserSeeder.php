<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Model\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Administrator',
            'email' => 'admin@alghifari.org',
            'password' => Hash::make('admin'),
        ]);

        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'STMIK JABAR',
            'email' => 'stmikjabar@alghifari.org',
            'password' => Hash::make('stmikjabar'),
        ]);

        $user->assignRole('user');

        $user = User::create([
            'name' => 'SMP Plus Al-Ghifari',
            'email' => 'smpplus@alghifari.org',
            'password' => Hash::make('smpplus'),
        ]);

        $user->assignRole('user');
    }
}
