<?php
namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name'          => 'Super Admin',
            'email'         => 'superadmin12345@gmail.com',
            'role'          => 'superadmin',
            'postal_code'   => '11041',
            'city'          => 'Yangon',
            'address'       => "No.8834 South Okkalapa",
            'date_of_birth' => '12-10-1999',
            'phone_number'  => '957743821',
            'password'      => Hash::make('superadmin@12345'),
        ]);
    }
}
