<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Shortlink;
use App\Models\UserProfile;


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
        \App\Models\Shortlink::factory(20)->create();

        $admin = new User();
        $admin->name = 'Leonardo Nascimento';
        $admin->email = 'leonardo.nascimento21@gmail.com';
        $admin->password = bcrypt('12345678');
        $admin->status_user = 1;
        $admin->save();
    }
}
