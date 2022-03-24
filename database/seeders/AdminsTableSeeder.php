<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = new Admin();
        $admin->name = 'Guillaume Ventura';
        $admin->email = 'guillaume.ventura@my-digital-school.org';
        $admin->password = Hash::make('3ihJED$tyxo!Fs46');
        $admin->save();

        $admin = new Admin();
        $admin->name = 'Elia Perdriaud';
        $admin->email = 'elia.perdriaud@my-digital-school.org';
        $admin->password = Hash::make('m#RKY&jx97SBQ5jR');
        $admin->save();

        $admin = new Admin();
        $admin->name = 'Alissone Brandao';
        $admin->email = 'alissone.brandao@my-digital-school.org';
        $admin->password = Hash::make('mkGKt8t9&4f9PNCi');
        $admin->save();

        $admin = new Admin();
        $admin->name = 'Alexie Arsac';
        $admin->email = 'alexie.arsac@my-digital-school.org';
        $admin->password = Hash::make('E7nijxEH8@@m4Rx$');
        $admin->save();
    }
}
