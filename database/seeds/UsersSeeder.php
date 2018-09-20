<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $players = [
            ['name' => 'Jeff Basshead', 'email' => '1@gmail.com'],
            //['name' => 'Jacob Landry', 'email' => 'landry.jacob@gmail.com'],
            ['name' => 'Eddie Conway', 'email' => '2@gmail.com'],
            ['name' => 'Dan Stoe', 'email' => '3@gmail.com'],
            ['name' => 'Keegan Nolan', 'email' => '4@gmail.com'],
            ['name' => 'Rebekah Zollman', 'email' => '5@gmail.com'],
            ['name' => 'Rob Wineriter', 'email' => '6@gmail.com'],
            ['name' => 'Juan Gomez', 'email' => '7@gmail.com'],
            ['name' => 'Jon Kubu', 'email' => '8@gmail.com'],
            ['name' => 'Andy Mayfield', 'email' => '9@gmail.com'],
            ['name' => 'James Stoe', 'email' => '10@gmail.com'],
            ['name' => 'Shelbi Wilkin', 'email' => '11@gmail.com'],
            ['name' => 'Tanner Wilkin', 'email' => '12@gmail.com'],
            ['name' => 'Ethan Souers', 'email' => '13@gmail.com'],
            ['name' => 'Jeremy Zollman', 'email' => '14@gmail.com'],
            ['name' => 'Jake Rolfe', 'email' => '15@gmail.com'],
            ['name' => 'Ryan O\'Sullivan', 'email' => '16@gmail.com'],
            ['name' => 'Steph Wilson', 'email' => '17@gmail.com'],
            ['name' => 'Jeff Kemen', 'email' => '18@gmail.com'],
            ['name' => 'Matt Autry', 'email' => '19@gmail.com'],
            ['name' => 'Dave Burgin', 'email' => '20@gmail.com'],
            ['name' => 'Bobby Herrera', 'email' => '21@gmail.com'],
            ['name' => 'Nolan Deburger', 'email' => '22@gmail.com'],
            ['name' => 'Shawn Carman', 'email' => '23@gmail.com'],
            ['name' => 'Jared Ortman', 'email' => '24@gmail.com'],
            ['name' => 'Ryan Charbonneau', 'email' => '25@gmail.com'],
            ['name' => 'Tom Nevin', 'email' => '26@gmail.com'],
            ['name' => 'Tony Delcastillo', 'email' => '27@gmail.com'],
            ['name' => 'Ben Molin', 'email' => '28@gmail.com'],
            ['name' => 'Andrew Dix', 'email' => '29@gmail.com'],
            ['name' => 'Krista Larson', 'email' => '30@gmail.com'],
            ['name' => 'Matt Larson', 'email' => '31@gmail.com'],
            ['name' => 'Saurabh Lall', 'email' => '32@gmail.com'],
            ['name' => 'Kevin Sittner', 'email' => '33@gmail.com'],
            ['name' => 'Justin Beardsworth', 'email' => '34@gmail.com'],
            ['name' => 'Ben Clark', 'email' => '35@gmail.com'],
            ['name' => 'Joel Martin', 'email' => '36@gmail.com'],
            ['name' => 'Brandon Frost', 'email' => '37@gmail.com'],
            ['name' => 'Scott Miller', 'email' => '38@gmail.com'],
            ['name' => 'Matt Shockley', 'email' => '39@gmail.com'],
            ['name' => 'Steve Such', 'email' => '40@gmail.com'],
            ['name' => 'Justin Bradley', 'email' => '41@gmail.com'],
            ['name' => 'Steve Mann', 'email' => '42@gmail.com']
        ];

        foreach($players as $player) {
            // User
            $user = \App\User::create([
                'name' => $player['name'],
                'email' => $player['email'],
                'password' => '$2y$10$Ewcxdr1XDT.2ewPSzJw.NeqC62VPQNVnAaIc6e136gYNU4YGYVq3.'
            ]);
        }
    }
}
