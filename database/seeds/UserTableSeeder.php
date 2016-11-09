<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Luis Eduardo Callejas',
            'email' => 'lcallejas@fabricadesoluciones.com',
            'username' => 'lcallejas',
            'password' => bcrypt('abc123'),
            'p_superuser' => '1',
            'p_superadmin' => '1',
            'p_admin' => '1',
            'p_document' => '1',
        ]);
    }
}
