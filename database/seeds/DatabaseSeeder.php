<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('users')->insert([
            'name' => 'Hoàng Thị Phương',
            'email' => 'phuonghoang100195@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'admin',
            'gender' => 'Nữ',
            'birthday' => '1995-01-10',
        ]);
    }
}
