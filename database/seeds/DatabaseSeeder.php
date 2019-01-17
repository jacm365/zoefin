<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('roles')->insert([
            ['role' => 'Agents', 'slug' => 'agent'],
            ['role' => 'Contacts', 'slug' => 'contact']
        ]);

        DB::table('professions')->insert([
            ['profession' => 'Corporate Finance', 'code' => 'cfin'],
            ['profession' => 'Commercial Banking', 'code' => 'cbkn'],
            ['profession' => 'Investment Banking', 'code' => 'ibkn'],
            ['profession' => 'Hedge Funds', 'code' => 'hfun'],
            ['profession' => 'Financial Planning', 'code' => 'fpla']
        ]);

        DB::table('users')->insert([
            //AGENTS
            ['role_id' => 1,
            'profession_id' => 5,
            'first_name' => 'Robert',
            'last_name' => 'Smith',
            'age' => 50,
            'gender' => 'M',
            'zip_code' => '90071',
            'email' => 'robert.smith@zoefin.com',
            'password' => bcrypt('zoefin')
            ],
            ['role_id' => 1,
            'profession_id' => 1,
            'first_name' => 'John',
            'last_name' => 'Smith',
            'age' => 48,
            'gender' => 'M',
            'zip_code' => '94108',
            'email' => 'robert.smith@zoefin.com',
            'password' => bcrypt('zoefin')
            ],
            //CONTACTS
            ['role_id' => 2,
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'age' => 38,
            'gender' => 'F',
            'zip_code' => '94126',
            'email' => 'jane.doe@gmail.com',
            'password' => bcrypt('zoefin')
            ],
            ['role_id' => 2,
            'first_name' => 'John',
            'last_name' => 'Doe',
            'age' => 33,
            'gender' => 'M',
            'zip_code' => '94301',
            'email' => 'john.doe@gmail.com',
            'password' => bcrypt('zoefin')
            ],
            ['role_id' => 2,
            'first_name' => 'Mary',
            'last_name' => 'Doe',
            'age' => 35,
            'gender' => 'F',
            'zip_code' => '95112',
            'email' => 'mary.doe@gmail.com',
            'password' => bcrypt('zoefin')
            ],
            ['role_id' => 2,
            'first_name' => 'David',
            'last_name' => 'Doe',
            'age' => 38,
            'gender' => 'M',
            'zip_code' => '95404',
            'email' => 'david.doe@gmail.com',
            'password' => bcrypt('zoefin')
            ],
            ['role_id' => 2,
            'first_name' => 'James',
            'last_name' => 'Doe',
            'age' => 45,
            'gender' => 'M',
            'zip_code' => '93120',
            'email' => 'james.doe@gmail.com',
            'password' => bcrypt('zoefin')
            ],
            ['role_id' => 2,
            'first_name' => 'Michael',
            'last_name' => 'Doe',
            'age' => 33,
            'gender' => 'M',
            'zip_code' => '93454',
            'email' => 'micheal.doe@gmail.com',
            'password' => bcrypt('zoefin')
            ],
            ['role_id' => 2,
            'first_name' => 'Alexander',
            'last_name' => 'Doe',
            'age' => 39,
            'gender' => 'M',
            'zip_code' => '93702',
            'email' => 'alexander.doe@gmail.com',
            'password' => bcrypt('zoefin')
            ],
            ['role_id' => 2,
            'first_name' => 'Paul',
            'last_name' => 'Doe',
            'age' => 39,
            'gender' => 'M',
            'zip_code' => '93702',
            'email' => 'paul.doe@gmail.com',
            'password' => bcrypt('zoefin')
            ]
        ]);

    }
}
