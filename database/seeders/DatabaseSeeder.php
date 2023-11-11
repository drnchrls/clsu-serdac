<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\PrivUser;
use App\Models\Staff;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    // public function run()
    // {
    //     // \App\Models\User::factory(10)->create();

    //     // \App\Models\User::factory()->create([
    //     //     'name' => 'Test User',
    //     //     'email' => 'test@example.com',
    //     // ]);


        
    // }


    public function run()
    {
        $staffs = [
            [
                'staff_fname' => 'Admin',
                'staff_lname' => fake()->lastName(),
                'staff_email' => 'admin@admin.com',
                'staff_password' => bcrypt('12345678'),
                'staff_role' => 'Admin',
                'staff_contact' => fake()->phoneNumber(),
            ],
            [
                'staff_fname' => 'Library',
                'staff_lname' => fake()->lastName(),
                'staff_email' => 'libr@libr.com',
                'staff_password' => bcrypt('12345678'),
                'staff_role' => 'Library Staff',
                'staff_contact' => fake()->phoneNumber(),
            ],
            [
                'staff_fname' => 'Service',
                'staff_lname' => fake()->lastName(),
                'staff_email' => 'serv@serv.com',
                'staff_password' => bcrypt('12345678'),
                'staff_role' => 'Service Staff',
                'staff_contact' => fake()->phoneNumber(),
            ],
        ];
        foreach($staffs as $staff){
            Staff::create($staff);
        }
        
        \App\Models\User::factory(50)->create();
        Staff::factory(10)->create();
    }
}
