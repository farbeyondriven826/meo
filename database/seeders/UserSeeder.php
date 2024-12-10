<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $client = Client::factory()->create([
            'fname' => "Admin",
            'mname' => "EDMS",
            'lname' => "MEO Basud",
            'sex' => "male",
            'street' => "NA",
            'brgy' => "NA",
            'municipality' => "Basud",
            'province' => "Camarines Norte"
        ]);

        User::factory()->create([
            'email' => 'admin@gmail.com',
            'client_id' => $client->id,
            'isAdmin' => 1,
            'contact_number' => "09123456789",
            'username' => 'Admin'
        ]);


        $client = Client::factory()->create([
            'fname' => "User",
            'mname' => "EDMS",
            'lname' => "MEO Basud",
            'sex' => "male",
            'street' => "NA",
            'brgy' => "NA",
            'municipality' => "Basud",
            'province' => "Camarines Norte"
        ]);

        User::factory()->create([
            'email' => 'user@gmail.com',
            'client_id' => $client->id,
            'isAdmin' => 0,
            'contact_number' => "09123456789",
            'username' => 'user'
        ]);
    }
}
