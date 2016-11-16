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
        DB::table('users')->insert([
            'name' => 'Super Admin',
            'email' => 'superadmin@mail.com',
            'username' => 'superadmin',
            'password' => bcrypt('abc123'),
            'p_superuser' => '0',
            'p_superadmin' => '1',
            'p_admin' => '0',
            'p_document' => '0',
        ]);
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'username' => 'admin',
            'password' => bcrypt('abc123'),
            'p_superuser' => '0',
            'p_superadmin' => '0',
            'p_admin' => '1',
            'p_document' => '0',
        ]);
        DB::table('users')->insert([
            'name' => 'Documenter',
            'email' => 'documenter@mail.com',
            'username' => 'documenter',
            'password' => bcrypt('abc123'),
            'p_superuser' => '0',
            'p_superadmin' => '0',
            'p_admin' => '0',
            'p_document' => '1',
        ]);
    }
}
