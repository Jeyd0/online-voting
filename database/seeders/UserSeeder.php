<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'jadedajuela96@gmail.com',
            'password' => Hash::make('dodo123'),
            'role' => 'admin',
        ]);

        // Create 50 regular voter users
        $voters = [
            'Alice Anderson', 'Bob Baker', 'Charlie Clark', 'Diana Davis', 'Edward Evans',
            'Fiona Foster', 'George Garcia', 'Hannah Harris', 'Ian Jackson', 'Jessica Jones',
            'Kevin King', 'Laura Lee', 'Matthew Martin', 'Nancy Nelson', 'Oliver Oliver',
            'Patricia Parker', 'Quincy Quinn', 'Rachel Roberts', 'Samuel Scott', 'Teresa Taylor',
            'Ulysses Thompson', 'Victoria Turner', 'William Walker', 'Xena White', 'Yolanda Young',
            'Zachary Adams', 'Amy Allen', 'Benjamin Brooks', 'Catherine Campbell', 'Daniel Collins',
            'Elizabeth Edwards', 'Frank Foster', 'Grace Gray', 'Henry Hall', 'Isabella Hill',
            'Jack Johnson', 'Karen King', 'Leonard Lopez', 'Monica Martinez', 'Nathan Moore',
            'Olivia Phillips', 'Paul Peterson', 'Quinn Robinson', 'Rebecca Rodriguez', 'Steven Smith',
            'Tiffany Thomas', 'Uma Turner', 'Vincent Walker', 'Wendy Wright', 'Xavier Young'
        ];

        foreach ($voters as $index => $name) {
            User::create([
                'name' => $name,
                'email' => strtolower(str_replace(' ', '.', $name)) . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'voter',
            ]);
        }

        $this->command->info('51 users (1 admin + 50 voters) have been seeded successfully!');
    }
}
