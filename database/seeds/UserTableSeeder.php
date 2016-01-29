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
        DB::table('users')->insert(
            [
                [
                'name' => 'Laeti',
                'email' =>'laeti@laeti.fr',
                'password'  => Hash::make('Laeti'),//hash = codage
                'role' => 'administrator'
                 ],
                [
                'name' => 'Romain',
                'email' =>'romain@romain.fr',
                'password'  => Hash::make('Romain'),//hash = codage
                'role' => 'visitor',
                ],
                [
                'name' => 'Sophie',
                'email' =>'sophie@sophie.fr',
                'password'  => Hash::make('Sophie'),//hash = codage
                'role' => 'visitor',
                 ],
                [
                'name' => 'Clement',
                'email' =>'clement@clement.fr',
                'password'  => Hash::make('Clement'),//hash = codage
                'role' => 'visitor',
                ]

            ]);
    }
}
